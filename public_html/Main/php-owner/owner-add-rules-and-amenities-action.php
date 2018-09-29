<?php
include_once './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}


if(isset($_POST['amenities'])){
        //on form submission....
        
        //Find the number of items to insert
        $array_size= count($_POST['amenities']);
        
        $hostel_no = $_SESSION['hostel_no'];
        
        for($count = 0; $count<$array_size; $count++){
            
            $query = "INSERT INTO `amenities`(`hostel_no`, `amenity`) VALUES (?,?)";
            
            $amenities = $_POST['amenities'][$count]; 
            
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("ss", $hostel_no, $amenities);
            $bool = $stmt->execute();
            
            if(!$bool){
                array_push($error, $con->error);
            }
            
        }
        
        $result = $stmt->get_result();
            
            if(isset($result)){
                echo 'ok';
            }
        
    }
    
   
    if(isset($_POST['rules'])){
        //on form submission....
        
        //Find the number of items to insert
        $array_size= count($_POST['rules']);
        
        $hostel_no = $_SESSION['hostel_no'];
        
        for($count = 0; $count<$array_size; $count++){
            
            $query = "INSERT INTO `rules`(`hostel_no`, `rule`) VALUES (?,?)";
            
            $rules = $_POST['rules'][$count]; 
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("ss", $hostel_no, $rules);
            $bool = $stmt->execute();
            
            if(!$bool){
                array_push($error, $con->error);
            }
        }
        
    }