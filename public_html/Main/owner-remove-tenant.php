<?php 
include './php-owner/connection.php';

$con->autocommit(false);

if(isset($_POST['user_id'])){
    
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    
    //Get the record id 
    $record_id = getRecordID($con, $user_id, &$error);
    
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_out = date('Y-m-d H:i:s');
    
    $error = array();
    
    //Update users table
    updateUsers($con, $user_id, $error);
    
    //Update tenant history table
    updateHistory($con, $record_id, $date_checked_out, &$error);
    
    //Delete user_id from user_tenant_bridge
    deleteFromBridge($con, $user_id, $error);
    
    
    if(count($error)==0){
        $con->commit();
        echo $name.' has been removed as a tenant';
    }else{
        echo var_dump($error);
    }
}

function updateUsers($con, $user_id, &$error){
    $query = "UPDATE users SET user_status = NULL, room_assigned = NULL WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
}

function updateHistory($con, $record_id, $date_checked_out, &$error){
    
    $query = "UPDATE tenant_history SET date_checked_out = ? WHERE record_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $date_checked_out, $record_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
}

function getRecordID($con, $user_id, &$error){
    $query = "SELECT * FROM user_hostel_bridge WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
    
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
    $record_id = $row['record_id'];
    
    return $record_id;
}

function deleteFromBridge($con, $user_id, &$error){
    
    $query = "DELETE FROM `user_hostel_bridge` WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
}


