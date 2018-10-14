<?php

include './php/connection.php';
include './php/Classes/Users.php';
require './php-owner/Classes/Hostels.php';//My generic class
require './php-owner/Classes/Rooms.php';//My generic class
require './php-owner/Classes/Bookings.php';//My generic class

$users = new Users();
$hostels = new Hostels();
$rooms = new Rooms();
$book = new Bookings();


if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];
$type = $_SESSION['type'];

//!Muy importante!-->Kill autommit
$con->autocommit(false);
$error = array();//Array to store error messages

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $room_assigned = $_POST['room_assigned'];
    $no_sharing = $_POST['no_sharing'];
    
    $data = array(
      'email'=> $email,
      'room_assigned' => $room_assigned,
      'no_sharing' => $no_sharing
    );
    
    /*
     * Get the current hostel details -->methods from classes: Hostels and Rooms
     */
    $hostel = $hostels->getHostelDetails($con, $hostel_no, $error);
    $room = $rooms->getRoomDetails($con, $hostel_no, $no_sharing, $error);
    $this_room = $rooms->thisRoomDetails($con, $hostel_no, $room_assigned, $error);
    
    /*
     * TABLES AFFECTED: users table, tenant_history table and user_hostel_bridge table 
     */    
    
    //1. USERS table 
    $user = $users->getData($con, $email);
    
    //If the user is found ...
    if(isset($user)){  
        $status = $user['user_status'];
        $user_id = $user['user_id'];
        $name = $user['first_name']." ".$user['last_name'];
        $user_type = $user['user_type'];
        $gender = $user['gender'];
  
        /*
         * Check status and user_hostel_bridge table to ensure they are not already a tenant in the current  
         * nor in another hostel and that they are of "student" type 
         */       
        $row = tenantResidence($con, $user_id);         
        $hostel_reg = $row['hostel_no'];
        $hostel_name = $row['hostel_name'];        
        
        /*
         * if 1-To ensure the user was not already a tenant either in another hostel or your hostel
         * if-2 to ensure the user is registered as a student
         * if 3 - to ensure the user is of the right gender
         */
        if($status == "Tenant"){
            if($hostel_no != $hostel_reg && $hostel_reg !=""){
                echo $name." is still registered as a tenant in ".$hostel_name;
                exit();
            }else{
                echo $name." is already registered as a tenant in your hostel";
                exit();
            }
            //To ensure that the user registered as a student 
        }else if($user_type !="Student"){
            echo $name." is is not a student. User type: ".$user_type;
            exit();    
        //To ensure the person is of the right gender
        }else if($type != $gender && $type != "Mixed"){
            echo $name." is ".$gender.". If you admit both genders change hostel type to mixed";
            exit();
        }
        
        /*
         * Actions to take if they had made a booking 
         * if 1 -->when adding a tenant
         * if 2 -->when tenant is making a booking
         */
        $booked = false;
        $booking_row = $book->userBooked($con, $user_id, $error);
        if(isset($booking_row)){
            $booked = true;
        }
        
        if($booked && $_POST['action']=="add_tenant"){
            $book->delBooking($con, $user_id, $error);
        }else if($booked && $_POST['action']=="booking"){
            echo 'You have already made a booking in '.$booking_row['hostel_name'];
            exit();
        }
        
        //check whether vacancy is present
        $vacant = vacancyPresent($room, $user, $error);

        if(!$vacant){
            echo 'No more vacancies available for '.$no_sharing.' sharing';
        }else{
            //Reduce the number of available slots in the hostel
            updateVacancies($con, $hostel, $room, $user, $error);
            
            //Allocate rooms
            updateRooms($con, $this_room, $hostel, $data,$error);
            
            echo '';//Cleared for insert into database
        }

    }else{
        echo "User email does not exist";
        exit();
    }
    
    //Output any log errors
    if(count($error)!=0){
        echo var_dump($error);
    }else{
        //Make any commits if necessary
        $con->commit();
    }
    
}

if(isset($_POST['action']) && $_POST['action'] == "check_booked"){
    $booked = false;
    $booking_row = $book->userBooked($con, $user_id, $error);
    if(isset($booking_row)){
        $booked = true;
    }
}

function tenantResidence($con, $user_id){
    
    $query = 'SELECT * FROM user_hostel_bridge JOIN hostels ON user_hostel_bridge.hostel_no = hostels.hostel_no '
            . 'WHERE user_hostel_bridge.user_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
    return $row;
}


function vacancyPresent(&$room, &$user, &$error){
    //User data
    $gender = $user['gender'];

    //Rooms table
    $no_sharing = $room['no_sharing'];
    $gender_count = $room[$gender.'_count'];
    $total = $room['total_capacity'];
    $blocked_m = $room['blocked_male'];
    $blocked_f = $room['blocked_female'];
    
    $spaces = $total - ($blocked_m + $blocked_f);
    
    /*
     * if condition 1 - Check if there are any rooms left to spare
     * if condition 2 - Check that there is space in the last room for that particular gender
     */
    if($spaces==0 && ($gender_count % $no_sharing) == 0){
        return false;
    }
    
    return true;
}


function updateVacancies($con, &$hostel, &$room, &$user, &$error){
    //User data
    $gender = $user['gender'];

    //Hostels table
    $hostel_no = $hostel['hostel_no'];
    $total_occupied = $hostel['total_occupied'];
    $total_available = $hostel['total_available'];
    
    //Rooms table
    $no_sharing = $room['no_sharing'];
    $current_capacity = $room['current_capacity'];
    $gender_count = $room[$gender.'_count'];//Reinitialization done due to calculation
    
    
    /*
     * Do the increment on total occupied and current capacity
     */
    
    //Hostels table
    $total_occupied += 1;
    $vacancies = $total_available - $total_occupied; 
    
    //Rooms table
    $current_capacity += 1;
    $gender_count += 1;
    $block_gender = ceil($gender_count/$no_sharing)*$no_sharing;
    
    /*
     * UPDATE tables
     */
    
    //Hostels
    $query_1 = "UPDATE hostels SET total_occupied = ?, vacancies = ? WHERE hostel_no = ?";
    $stmt_1 = $con->prepare($query_1);
    $stmt_1->bind_param("sss", $total_occupied, $vacancies,$hostel_no);
    $bool_1 = $stmt_1->execute();

    if($bool_1 == false){
        array_push($error, $con->error);
    }
   
    
    //Rooms
    $query_2 = 'UPDATE rooms SET current_capacity = ?, '.$gender.'_count = ?, blocked_'.$gender.' = ? '
            . 'WHERE hostel_no = ? AND no_sharing = ?';
    $stmt_2 = $con->prepare($query_2);
    $stmt_2->bind_param("sssss", $current_capacity, $gender_count, $block_gender,$hostel_no, $no_sharing);
    $bool_2 = $stmt_2->execute();

    if($bool_2 == false){
        array_push($error, $con->error);
    }
}


function updateRooms($con, $this_room, $hostel, $data, &$error){
    //Get the current details for this room 
    $no_sharing = $data['no_sharing'];
    $hostel_no = $hostel['hostel_no'];
    
    $no_sharing_db = $this_room['no_sharing'];
    $no_occupied = $this_room['no_occupied'];//Is incremented
    $room_no = $this_room['room_no'];
    
    /*
     * The math
     */
    $no_occupied += 1;
    
    $query="";
    $stmt="";
    
    if($no_sharing_db == 0){
        $spaces = $no_sharing -$no_occupied;
        $query = 'UPDATE `room_allocation` SET `no_sharing`= ?, `no_occupied`= ? ,`spaces`= ? '
            . 'WHERE room_no = ? AND hostel_no = ? ';
        $stmt = $con->prepare($query);
        $stmt->bind_param("sssss", $no_sharing, $no_occupied, $spaces, $room_no, $hostel_no);
    }else{
        $spaces = $no_sharing_db - $no_occupied; //No of spaces left in that room
        $query = 'UPDATE `room_allocation` SET `no_occupied`= ? ,`spaces`= ? '
            . 'WHERE room_no = ? AND hostel_no = ? ';
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssss", $no_occupied, $spaces, $room_no, $hostel_no);
    }
     
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
    
}