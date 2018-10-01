<?php

include './connection.php';
require './Classes/Bookings.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['hostel_no'])){
    
    $hostel_no = $_SESSION['hostel_no'];
    
    $get = new Bookings();

    $row = $get->getNoBooked($con, $hostel_no);
    
    $no_booked = $row['no_booked'];
    
    echo $no_booked;
}
