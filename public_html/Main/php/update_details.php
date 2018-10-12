<?php

include './connection.php';
include './Classes/Users.php';//Class containing functions that modify the users table
include './Classes/Helpers.php';//Class containing alert function
session_start();

//Object of class Users and Helpers 
$user = new Users();
$help = new Helpers();

//If the update button is clicked ...
if(isset($_POST['update_submit'])){
    
    $data = array(
      'first_name'=>$_POST['first_name'],  
      'last_name'=>$_POST['last_name'],  
      'email'=>$_POST['email'],  
      'country_code'=>$_POST['country_code'],  
      'phone_no'=>$_POST['phone_no'],  
      'user_id'=>$_SESSION['user_id']  
    );
    
    $user->updateDetails($con, $data);
    
    $help->alert("Update succesful");
    header("refresh:0.1; url=../student-view-details.php");
}

//Triggered on #email .change()
if(isset($_POST['email'])){
    
    $data = array( 
      'email'=>$_POST['email'],   
      'user_id'=>$_SESSION['user_id']  
    );
    
    $user->emailAvailable($con,$data);
}
