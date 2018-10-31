<?php
include '../php/connection.php';
include '../php-owner/Classes/Bookings.php';
include './Classes/Users.php';
$user_id = $_POST['user_id'];
$error = array();

$book = new Bookings();
$users = new Users();
$user = $users->getData($con, $user_id);


 $status = $user['user_status'];
 $user_type= $user['user_type'];
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
            echo "You are already a tenant";
            exit();

        }else if($user_type !="Student"){
            echo "You need a student account for this feature";
            exit();    
        //To ensure the person is of the right gender
        }else{
            echo '';
        }
        
        /*
         * Actions to take if they had made a booking 
         * 
         */
        $booked = false;
        $booking_row = $book->userBooked($con, $user_id, $error);
        if(isset($booking_row)){
            $booked = true;
            echo "You already made a booking";
        }