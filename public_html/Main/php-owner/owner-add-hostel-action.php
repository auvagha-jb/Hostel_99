<?php
    include_once './connection.php';
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
    //What is common among the files  
    $con->autocommit(false);
    $error = array();//Array to store any errors that may be encountered
    
    //General details
    include './owner-add-hostel-details.php';
    
    //Room details
    include './owner-add-room-details.php';
    
    //Rules and amenties
    include './owner-add-rules-and-amenities-action.php';
    
    //Update the junction table: user_hostel_bridge
    $user_id = $_SESSION['user_id'];
    $hostel_no = $_SESSION['hostel_no'];
    $hostel_name = $_SESSION['hostel_name'];
    $type = $_SESSION['type'];
    
    $query = "INSERT INTO `user_hostel_bridge`(`user_id`, `hostel_no`) VALUES(?,?)";
    
    $stmt= $con->prepare($query);
    $stmt->bind_param("ss", $user_id, $hostel_no);
    $bool = $stmt->execute();
    
    if(!$bool){
        array_push($error, $con->error);
    }
    
    if(count($error)==0){
        //commit changes to database
        $con->commit();
        header("location:../owner-dashboard.php?id=".$hostel_no."&type=".$type."&hostel_name=".$hostel_name);
    }else{
        echo var_dump($error);
    }