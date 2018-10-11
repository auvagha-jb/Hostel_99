<?php

include './connection.php';
include './Classes/Users.php';//Class containing functions that modify the users table
include './Classes/Helpers.php';//Class containing alert function
session_start();

if(isset($_POST['update_submit'])){
    
    $data = array(
      'first_name'=>$_POST['first_name'],  
      'last_name'=>$_POST['last_name'],  
      'email'=>$_POST['email'],  
      'country_code'=>$_POST['country_code'],  
      'phone_no'=>$_POST['phone_no'],  
      'user_id'=>$_SESSION['user_id']  
    );
    
    $user = new Users();
    $user->updateDetails($con, $data);
    
    $help = new Helpers();
    $help->alert("Update succesful");
    header("refresh:0.1; url=../student-view-details.php");
}


