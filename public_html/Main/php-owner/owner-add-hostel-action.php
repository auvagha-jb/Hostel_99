<?php
    include_once './connection.php';
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    //General details
    include './owner-add-hostel-details.php';
    
    //Room details
    include './owner-add-room-details.php';
    
    //Rules and amenties
    include './owner-add-rules-and-amenities-action.php';
    
    //Update the junction table
    $user_id = $_SESSION['user_id'];
    $hostel_no = $_SESSION['hostel_no'];
    
    $query = "INSERT INTO `user_hostel_bridge`(`user_id`, `hostel_no`) VALUES(?,?)";
    
    $stmt= $con->prepare($query);
    $stmt->bind_param("ss", $user_id, $hostel_no);
    $stmt->execute();
    
    $result= $stmt->get_result();
    
    if(isset($result)){
        echo 'ok';
        header("location:../owner-add-images.php?hostel_name=".$hostel_name."");
    }