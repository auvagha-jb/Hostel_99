<?php

include './connection.php';
require './Classes/Bookings.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['hostel_no'])){
   $hostel_no = $_SESSION['hostel_no'];
   
   $get = new Bookings();
   $result = $get->getBookingsTable($con, $hostel_no);  
   
   $data=""; 
   
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $name = $row['first_name']." ".$row['last_name'];
        $gender = $row['gender']; 
        $phone_no = '+'.$row['country_code'].' '.$row['phone_no'];
        $email = $row['email'];
        $room_chosen = $row['room_chosen'];  
        $no_sharing = $row['no_sharing'];  
        //$check_in_date = $row['check_in_date'];

        $data.='
        <tr>
            <td>'.$user_id.'</td>
            <td>'.$name.'</td>
            <td>'.$gender.'</td>
            <td>'.$phone_no.'</td>
            <td>'.$email.'</td>
            <td>'.$room_chosen.'</td>
            <td>'.$no_sharing.'</td>
            <td><a href="#" class="btn btn-success btn-sm add-tenant" id="add-tenant"><i class="fa fa-plus-circle"></i></a></td>
            <td><a href="#" class="btn btn-danger btn-sm remove-booking" id="remove_booking"><i class="fa fa-minus-circle"></i></a></td>
        </tr>  
        ';
    }
    echo $data;
}
