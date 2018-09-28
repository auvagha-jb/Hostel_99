<?php
include './php/connection.php';

$bool = true;

if($bool){
    
    $arr = array();
    echo "Before: ".var_dump($arr)."<br>";
    
    if(count($arr)==0){
        echo 'NOTHING AT ALL';
    }
}

function changeArray(&$arr){
    array_push($arr, "Value");
}


function insertQueries($con, $user_id, $hostel_no){
    
    /*
     * TENANT_HISTORY 
     */
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
   
    //header("location:owner-view-tenants.php?id=".$hostel_no." ");
}