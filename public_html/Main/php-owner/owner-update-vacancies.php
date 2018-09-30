<?php
include './connection.php';
require './Classes/Hostel_details.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
} 

$hostel_no = $_SESSION['hostel_no'];

$get = new Hostel_details();

$row = $get->getHostelInfo($con,$hostel_no);
$vacancies = $row['vacancies'];
  
echo $vacancies;