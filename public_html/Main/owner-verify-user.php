<?php

include './php/connection.php';
require './php-owner/Classes/Hostel_details.php';//My generic class
require './php-owner/Classes/Bookings.php';//My generic class

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];

//!Muy importante!-->Kill autommit
$con->autocommit(false);
$error = array();//Array to store error messages

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $room_assigned = $_POST['room_assigned'];
    $no_sharing = $_POST['no_sharing'];
    
    
    /*
     * TABLES AFFECTED: users table, tenant_history table and user_hostel_bridge table 
     */
    
    
    /*
    * USERS table 
    */
    
    $select = "SELECT * FROM users WHERE email = ?";
    
    $select_stmt = $con->prepare($select); 
    $select_stmt->bind_param("s", $email);
    $select_stmt->execute();
    
    $select_rst  = $select_stmt->get_result();
    
    //If the user is found ...
    if(mysqli_num_rows($select_rst)>0){
    
        $get = $select_rst->fetch_array();
           
        $status = $get['user_status'];
        $user_id = $get['user_id'];
        $name = $get['first_name']." ".$get['last_name'];
        $user_type = $get['user_type'];

        
        /*Check status and user_hostel_bridge table to ensure they are not already a tenant in the current  
        nor in another hostel and that they are of "student" type */
       
        $row = checkIfTenant($con, $user_id); 
        
        $hostel_reg = $row['hostel_no'];
        $hostel_name = $row['hostel_name'];        
        
        //To ensure the user was not already a tenant either in another hostel or your hostel
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
        }
        
        //If they had made a booking -->remove them
        if(userBooked($con, $user_id, $error)){
            
            $get = new Bookings();
            $get->delBooking($con, $user_id, $error);
            //echo 'Deleted from booking table';
        }else{
            //check whether vacncy is present
            $vacant = vacancyPresent($con, $hostel_no, $no_sharing, $error);
            
            if(!$vacant){
                echo 'No more vacancies available for '.$no_sharing.' sharing';
            }else{
                //Reduce the number of available slots in the hostel
                updateVacancies($con, $hostel_no, $no_sharing, $error);
           
                echo '';//Cleared for insert into database
            }
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

function checkIfTenant($con, $user_id){
    
    $query = 'SELECT * FROM user_hostel_bridge JOIN hostels ON user_hostel_bridge.hostel_no = hostels.hostel_no '
            . 'WHERE user_hostel_bridge.user_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
    return $row;
}

function userBooked($con, $user_id, &$error){
    
    $query = 'SELECT * FROM bookings WHERE user_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();
    
    if(!$bool){
        array_push($error, $con->error);
    }
    
    $result = $stmt->get_result();
    if(mysqli_num_rows($result)>0){
        return true;
    }
    
    return false;
    
}

function vacancyPresent($con, $hostel_no, $no_sharing, &$error){
    $query = 'SELECT * FROM rooms WHERE hostel_no = ? AND no_sharing = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $hostel_no, $no_sharing);
    $bool = $stmt->execute();
    
    if(!$bool){
        array_push($error, $con->error);
    }
    
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
    $current_capacity = $row['current_capacity'];
    $total_capacity  = $row['total_capacity'];
    
    if($current_capacity == $total_capacity){
        return false;
    }
    
    return true;
}



function updateVacancies($con, $hostel_no, $no_sharing, &$error){
    
    /*
     * Get the current hostel details -->methods from class: owner_get_vacancy_details()
     */
    $get = new Hostel_details();
    
    $hostel = $get->getHostelDetails($con, $hostel_no, $error);
    $room = $get->getRoomDetails($con, $hostel_no, $no_sharing, $error);
    
    //Hostels table
    $total_occupied = $hostel['total_occupied'];
    $total_available = $hostel['total_available'];
    
    //Rooms table
    $current_capacity = $room['current_capacity'];
    
    /*
     * Do the decrement
     */
    
    //Hostels table
    $total_occupied += 1;
    $vacancies = $total_available - $total_occupied; 
    
    //Rooms table
    $current_capacity += 1;
    
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
    $query_2 = "UPDATE rooms SET current_capacity = ? WHERE hostel_no = ? AND no_sharing = ?";
    $stmt_2 = $con->prepare($query_2);
    $stmt_2->bind_param("sss", $current_capacity, $hostel_no, $no_sharing);
    $bool_2 = $stmt_2->execute();

    if($bool_2 == false){
        array_push($error, $con->error);
    }
}
