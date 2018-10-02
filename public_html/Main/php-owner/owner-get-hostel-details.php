<?php
require 'php-owner/Classes/Hostels.php';
//The connection file is in  ../owner-add-hostel.php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
} 
    $hostel_no = $_GET['id'];
    
    $get = new Hostels();

    $row = $get->getHostelInfo($con,$hostel_no);

    $hostel_name = $row['hostel_name'];
    $description = $row['description'];
    $location = $row['location'];
    $county = $row['county'];
    $road = $row['road'];
    $type = $row['type'];
    $folder = "uploads/";
    $image = $row['image'];
    $total_available = $row['total_available']; 
    $total_occupied = $row['total_occupied'];
    $vacancies = $row['vacancies']; 