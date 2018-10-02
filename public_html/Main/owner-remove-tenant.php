<?php 
include './php-owner/connection.php';
require './php-owner/Classes/Hostels.php';//My generic class
require './php-owner/Classes/Rooms.php';//My generic class

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$con->autocommit(false);

$hostel_no = $_SESSION['hostel_no'];

if(isset($_POST['user_id'])){
    
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $no_sharing = $_POST['no_sharing'];
    
    //Get the record id 
    $record_id = getRecordID($con, $user_id, $error);
    
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_out = date('Y-m-d H:i:s');
    
    $error = array();
    
    //Update users table
    updateUsers($con, $user_id, $error);
    
    //Update tenant history table
    updateHistory($con, $record_id, $date_checked_out, $error);
    
    //Delete user_id from user_tenant_bridge
    deleteFromBridge($con, $user_id, $error);
    
    //Free up one slot the database
    updateVacancies($con, $hostel_no, $no_sharing, $error);
    
    if(count($error)==0){
        $con->commit();
        echo $name.' has been removed as a tenant';
    }else{
        echo var_dump($error);
    }
}

function updateUsers($con, $user_id, &$error){
    $query = "UPDATE users SET user_status = NULL, room_assigned = NULL, no_sharing = NULL WHERE user_id = ?";
    
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


function updateVacancies($con, $hostel_no, $no_sharing, &$error){
    
    /*
     * Get the current hostel details -->methods from class: owner_get_vacancy_details()
     */
    
    $hostels = new Hostels();
    $rooms = new Rooms();
    
    $hostel = $hostels->getHostelDetails($con, $hostel_no, $error);
    $room = $rooms->getRoomDetails($con, $hostel_no, $no_sharing, $error);
    
    //Hostels table
    $total_occupied = $hostel['total_occupied'];
    $total_available = $hostel['total_available'];
    
    //Rooms table
    $current_capacity = $room['current_capacity'];
    
    /*
     * Do the decrement
     */
    
    //Hostels table
    $total_occupied -= 1;
    $vacancies = $total_available - $total_occupied; 
    
    //Rooms table
    $current_capacity -= 1;
    
    /*
     * UPDATE tables
     */
    
    //Hostels
    $query_1 = "UPDATE hostels SET total_occupied = ?, vacancies = ? WHERE hostel_no = ?";
    $stmt_1 = $con->prepare($query_1);
    $stmt_1->bind_param("sss", $total_occupied, $vacancies,$hostel_no);
    $bool_1 = $stmt_1->execute();

    
    if($bool_1 == false){
        array_push($error, $con->error);
    }
    
    
    //Rooms
    $query_2 = "UPDATE rooms SET current_capacity = ? WHERE hostel_no = ? AND no_sharing = ?";
    $stmt_2 = $con->prepare($query_2);
    $stmt_2->bind_param("sss", $current_capacity, $hostel_no, $no_sharing);
    $bool_2 = $stmt_2->execute();

    if($bool_2 == false){
        array_push($error, $con->error);
    }
    
}

