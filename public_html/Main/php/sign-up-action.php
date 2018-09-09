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
    $phone_no = "+".$country_code.$no;
    //***************
    $gender = $_POST['gender'];
    $user_type = $_POST['user_type'];
    
     
        //Adding a user
        $add_user = $con->prepare("INSERT INTO `users`(`first_name`, `last_name`, `email`, `pwd`, `phone_no`, `gender`, `user_type`)"
                . "VALUES (?,?,?,?,?,?,?)");

        $add_user->bind_param("sssssss", $first_name, $last_name, $email, $pwd_hash, $phone_no, $gender, $user_type);
        $add_user->execute();

        
        //Session variables        
        $_SESSION['first_name'] = $first_name;        
        $_SESSION['last_name'] = $last_name;  
        $_SESSION['email'] = $email;
        $_SESSION['phone_no'] = $phone_no;
        $_SESSION['gender'] =  $gender;
        $_SESSION['user_type'] = $user_type; 
        
        //Get the user's id 
        $get_id = $con->prepare("SELECT * FROM users WHERE email = ?");
        $get_id->bind_param("s", $email);
        $get_id->execute();
        
        $result = $get_id->get_result();
        $row = $result->fetch_array();
        
        $_SESSION['user_id'] = $row['user_id'];
        
        //Determine where to redirect based on what user
        if($user_type == "Student"){
            header("location:../home.php");
        }else if($user_type == "Hostel Owner"){
            header("location: ../owner-add-hostel.php");
        }
        
}
