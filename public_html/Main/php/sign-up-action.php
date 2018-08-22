<?php

include './connection.php';
session_start();

//Check whether the email exists
   if(isset($_POST['email'])){
       
        $email = $_POST['email'];
       
        $check_email = $con->prepare("SELECT * FROM users WHERE email = ?");
        $check_email->bind_param("s", $email);
        $check_email->execute();
        $result1 = $check_email->get_result();

        if(mysqli_num_rows($result1)>=1){
            echo'email-exists';
        }else{
            echo 'all-good';
        }
   } 


//Insert 
if(isset($_POST['s-u-submit'])){
    
        //Form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    //***************
    $pwd = $_POST['pwd'];
    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT); 
    //***************
    $country_code = $_POST['country_code'];
    $no = $_POST['no'];
    $phone_no = $country_code.$no;
    //***************
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];

     
        //Adding a user
        $add_user = $con->prepare("INSERT INTO `users`(`first_name`, `last_name`, `email`, `pwd`, `phone_no`, `gender`, `occupation`) "
                . "VALUES (?,?,?,?,?,?,?)");

        $add_user->bind_param("sssssss", $first_name, $last_name, $email, $pwd_hash, $phone_no, $gender, $occupation);
        $add_user->execute();

        
        

}