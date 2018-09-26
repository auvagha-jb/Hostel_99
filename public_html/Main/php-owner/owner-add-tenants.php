<?php

include_once './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    
    /*
     * TABLES AFFECTED: users and user_hostel_bridge 
     */
    
    
    /*
    * USERS table 
    */
    
    //Check status to ensure they are not already a tenant
    $check_query = "SELECT * FROM users WHERE email = ?";
    
    $check_stmt = $con->prepare($check_query); 
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    
    $check_rst  = $check_stmt->get_result();
    
    if(mysqli_num_rows($check_rst)>0){
        echo 'Tenant found';
        
        $row  = $check_rst->fetch_array();
        
        $status = $row['user_status'];
        $user_id = $row['user_id'];
        
        if($status == "Tenant"){
            echo 'Already a tenant';#
            EXIT();
        }else{
            //Change user_status from NULL to Tenant
            changeStatus($con, $status);
        }
        
    }else{
        echo "Invalid tenant";
    }
    

    /*
     * TENANT_HISTORY 
     */
    $hostel_no = $_SESSION['hostel_no'];
    $record_id = get_id($con);
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_in = date('Y-m-d H:i:s');
    
    $insert_1 = "INSERT INTO `tenant_history`(`record_id`, `date_checked_in`) VALUES (?,?)";
    $stmt_1 = $con->prepare($insert_1);
    $stmt_1->bind_param("ss", $record_id, $date_checked_in);
    $stmt_1->execute();
    /*
     * USER_HOSTEL_BRIDGE table
     * INSERT user_id and hostel_no 
     */
    
    $insert_2 = "INSERT INTO user_hostel_bridge (hostel_no, user_id, record_id) VALUES(?,?,?)";
    $stmt_2 = $con->prepare($insert_2);
    $stmt_2->bind_param("sss", $user_id, $hostel_no, $record_id);
    $stmt_2->execute();
    
    
    /*SELECT ->To display the tenants
     * 
     * Sample Query: 
     * SELECT * FROM users join user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id WHERE 
     * user_hostel_bridge.hostel_no = 1 AND users.user_status = "Tenant" AND users.user_type = "Student"   
     */
    
    echo 'Done';
}


function changeStatus($con, $email){
    
    $query  = 'UPDATE users SET user_status = "Tenant" WHERE email = ?';
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();    
}

function get_id($con){
     $record_id = mt_rand();
    
    do{
        
        $select = "SELECT * FROM `tenant_history` WHERE record_id = ?";
        $stmt = $con->prepare($select);
        $stmt->bind_param("s", $record_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
       
        $row_count = mysqli_num_rows($result);
        
    }while($row_count>0);
    
    return $record_id;
}

