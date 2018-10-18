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

if(isset($_POST['email']) || isset($_POST['action'])){
    
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
        $row = $book->tenantResidence($con, $user_id);         
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
        }else{//If they hadn't booked...
            //check whether vacancy is present
            $vacant = $book->vacancyPresent($room, $user, $error);

            if(!$vacant){
                echo 'No more vacancies available for '.$no_sharing.' sharing';
            }else{
                //Reduce the number of available slots in the hostel
                $book->updateVacancies($con, $hostel, $room, $user, $error);

                //Allocate rooms
                $book->updateRooms($con, $this_room, $hostel, $data,$error);

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

if(isset($_POST['action']) && $_POST['action'] == "check_booked"){
    $booked = false;
    $booking_row = $book->userBooked($con, $user_id, $error);
    if(isset($booking_row)){
        $booked = true;
    }
}







