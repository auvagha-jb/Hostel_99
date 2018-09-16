<?php
//The connection file is in  ../owner-add-hostel.php 
if(session_status() == PHP_SESSION_NONE){
    session_start();
} 

$hostel_no = $_GET['id'];

$query = "SELECT * FROM hostels JOIN rooms on hostels.hostel_no = rooms.hostel_no "
        . "JOIN rules ON rooms.hostel_no = rules.hostel_no "
        . "JOIN amenities ON amenities.hostel_no = rules.hostel_no "
        . "WHERE hostels.hostel_no = ? GROUP BY hostels.hostel_no";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $hostel_no);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_array();

$hostel_name = $row['hostel_name'];
$description = $row['description'];
$location = $row['location'];
$county = $row['county'];
$road = $row['road'];
$type = $row['type'];
$folder = "uploads/";
$image = $row['image'];
