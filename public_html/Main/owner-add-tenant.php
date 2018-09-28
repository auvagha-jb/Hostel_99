<?php

include './php/connection.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];

if(isset($_POST['email'])){
    
    /*
     * Turn off autocommit
     */
    $con->autocommit(false);
    
    
    //Form data
    $email = $_POST['email'];
    $room_assigned = $_POST['room_assigned'];
  
    //Get the user data from the db
    $get = getUser_id($con, $email); 
    $user_id = $get['user_id'];
    $name = $get['first_name']." ".$get['last_name'];
    
    $error = array();

    //Change user_status from NULL to Tenant
    changeStatus($con, $email, $room_assigned, $error);

    //Insert data into respective tables: tenants_history and 
    insertQueries($con, $user_id, $hostel_no, $error);

    //Commit the queries if there were no errors encountered
    if(count($error)==0){
        $con->commit();
        echo $name.' has been added';
    }else{
        echo var_dump($error);
        exit();
        //$con->rollback();
    }
    
    //header("location:owner-view-tenants.php?id=".$hostel_no." ");
    
}

function insertQueries($con, $user_id, $hostel_no, &$error){
    
    /*
     * TENANT_HISTORY 
     */
    $record_id = get_id($con);
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_in = date('Y-m-d H:i:s');
    
    $insert_1 = "INSERT INTO `tenant_history`(`record_id`, `date_checked_in`) VALUES (?,?)";
    $stmt_1 = $con->prepare($insert_1);
    $stmt_1->bind_param("ss", $record_id, $date_checked_in);
    $bool_1 = $stmt_1->execute();
    
    if($bool_1 == false){
        array_push($error, "Error in insert_1");
    }
    /*
     * USER_HOSTEL_BRIDGE table
     * INSERT user_id and hostel_no 
     */
    
    $insert_2 = "INSERT INTO user_hostel_bridge (hostel_no, user_id, record_id) VALUES(?,?,?)";
    $stmt_2 = $con->prepare($insert_2);
    $stmt_2->bind_param("sss", $hostel_no, $user_id, $record_id);
    $bool_2 = $stmt_2->execute();
   
    if($bool_2 == false){
        array_push($error, "Error in insert_2");
    }
    
}

function changeStatus($con, $email, $room_assigned, &$error){
    
    $query  = 'UPDATE users SET user_status = "Tenant", room_assigned = ? WHERE email = ?';
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $room_assigned, $email);
    $bool = $stmt->execute();
    
    if($bool == false){
        array_push($error, "Error in changeStatus query");
    }
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
function getUser_id($con, $email){
    $select = "SELECT * FROM users WHERE email = ?";
    
    $select_stmt = $con->prepare($select); 
    $select_stmt->bind_param("s", $email);
    $select_stmt->execute();
    
    $select_rst  = $select_stmt->get_result();
    $result_array = $select_rst->fetch_array();
    
    return $result_array;
}
