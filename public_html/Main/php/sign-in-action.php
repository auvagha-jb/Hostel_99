<?php

include './connection.php';
session_start();

if(isset($_POST['email'])){
    //Get the post data
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    
    //Check whether email exits
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_object();
    
    //If we get a reult
    if(mysqli_num_rows($result)==1){
        //Check whether password is correct
        $hash = $row->pwd;
        
        if(password_verify($pwd, $hash)){
            //Store session variables upon successful login
            $_SESSION['user_id'] = $row->user_id;
            $_SESSION['email'] = $row->email;
            $_SESSION['first_name'] = $row->first_name;
            $_SESSION['last_name'] = $row->last_name;
            $_SESSION['gender'] = $row->gender;
            $_SESSION['user_type'] = $row->user_type;

            $user_type = $row->user_type;
            
            //Redirect to certain page
            if(isset($_SESSION['user_id'])){
                echo 'login-success'; 
                include '';
                if($user_type == "Student"){
                    header("location: ../home.php");
                }else if($user_type == "Hostel Owner"){
                    header("location: ../sign-up.php");
                }else if($user_type == "Admin"){
                    header("location:../admin-home.php");
                }
               
            }   
        
        }else{
            //return error message
            echo 'invalid-pwd';
            exit();
        }
    
        
    }else{
        //return error message
        echo 'invalid-email';
        exit();
    }
    
    //if we don't get a reult
    
    
    
    
}