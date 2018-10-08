<?php
//Connection included in 

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
    $user_id = $_SESSION['user_id'];
    $get = new Users();
    
    $row = $get->getData($con,$user_id);
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $email = $row['email'];
    $country_code = $row['country_code'];
    $phone_no = $row['phone_no'];
     


    
