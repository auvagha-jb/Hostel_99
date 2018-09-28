<?php

include './php/connection.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];

//!Muy importante!
$con->autocommit(false);

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $room_assigned = $_POST['room_assigned'];
    /*
     * TABLES AFFECTED: users table, tenant_history table and user_hostel_bridge table 
     */
    
    
    /*
    * USERS table 
    */
    
    $select = "SELECT * FROM users WHERE email = ?";
    
    $select_stmt = $con->prepare($select); 
    $select_stmt->bind_param("s", $email);
    $select_stmt->execute();
    
    $select_rst  = $select_stmt->get_result();
    
    //If the user is found ...
    if(mysqli_num_rows($select_rst)>0){
    
        $get = $select_rst->fetch_array();
           
        $status = $get['user_status'];
        $user_id = $get['user_id'];
        $name = $get['first_name']." ".$get['last_name'];
        $user_type = $get['user_type'];

        
        /*Check status and user_hostel_bridge table to ensure they are not already a tenant in the current  
        nor in another hostel and that they are of "student" type */
       
        $result = checkIfTenant($con, $user_id); 
        $row = $result->fetch_array();
        
        $hostel_reg = $row['hostel_no'];
        $hostel_name = $row['hostel_name'];        
        
        if($status == "Tenant"){
            if($hostel_no != $hostel_reg && $hostel_reg !=""){
                echo $name." is still registered as a tenant in ".$hostel_name;
                exit();
            }else{
                echo $name." is already registered as a tenant in your hostel";
                exit();
            }
        }else if($user_type !="Student"){
            echo $name." is is not a student. User type: ".$user_type;
            exit();    
        }else{
            
            //Cleared for insert into database
            echo '';       
        }
        
    }else{
        echo "User email does not exist";
        exit();
    }
    
}

function checkIfTenant($con, $user_id){
    
    $query = 'SELECT * FROM user_hostel_bridge JOIN hostels ON user_hostel_bridge.hostel_no = hostels.hostel_no '
            . 'WHERE user_hostel_bridge.user_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    return $result;
}


