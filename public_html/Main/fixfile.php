<?php

if(isset($_POST['email'])){
    //Check status to ensure they are not already a tenant
    $check_query = "SELECT * FROM users WHERE email = ?";
    
    $check_stmt = $con->prepare($check_query); 
    $check_stmt->bind_param("s", $email);
    
    if($check_stmt->execute()==false){
        echo 'check_query failed';
    }
    
    $check_rst  = $check_stmt->get_result();
    
    if(mysqli_num_rows($check_rst)>0){
        //echo 'Tenant found';
        
        $row  = $check_rst->fetch_array();
        
        $status = $row['user_status'];
        $user_id = $row['user_id'];
        $name = $row['first_name']." ".$row['last_name'];
        $user_type = $row['user_type'];
        
        if($status == "Tenant"){
            echo $name." is still is registered as a tenant in another hostel";
            exit();
        }else if($user_type !="Student"){
            echo $name." is is not a student. User type: ".$user_type;
            exit();    
        }else{
            //Change user_status from NULL to Tenant
            changeStatus($con, $status);
        }
        
    }else{
        echo "User email does not exist";
        exit();
    }

}

function changeStatus($con, $email){
    
    $query  = 'UPDATE users SET user_status = "Tenant" WHERE email = ?';
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    if($stmt->execute()==true){
        echo 'Done';
    }  
   
    
}