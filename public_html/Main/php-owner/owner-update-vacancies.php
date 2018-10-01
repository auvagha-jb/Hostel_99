<?php
include './connection.php';
require './Classes/Hostels.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
} 

$hostel_no = $_SESSION['hostel_no'];

$get = new Hostels();

$row = $get->getHostelInfo($con,$hostel_no);
$vacancies = $row['vacancies'];
  
echo $vacancies;