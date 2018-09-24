<?php
include_once './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}


if(isset($_POST['submit'])){
    
    //Previous form data
    $prev_name = $_SESSION['hostel_name'];
    $hostel_no = $_SESSION['hostel_no'];
    $prev_image_name = $_SESSION['prev_image_name'];
    
    
    //Get form data
    $hostel_name = $_POST['hostel_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $road = $_POST['road'];
    $county = $_POST['county'];
    $type = $_POST['hostel_type'];
    $total_rooms = $_POST['total_rooms'];
    
    //Image Upload
    $folder = "../uploads/";
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $path = $folder.$hostel_name."/".$file_name;
    $prev_path = $folder.$hostel_name."/".$prev_image_name;
    
    echo "File: ".$file_name."<br>".$hostel_no."<br>".$prev_path."<br>Current: ".$path;
    
    //Update the image uploaded -->if an image is chosen
    if(!empty($file_name)){
        
        //UNLINK previous image-->If it was present
        if(!empty($prev_image_name)){
            echo 'in unlink';
            unlink($prev_path);
        }
        
        //Move the uploaded image into the correct folder
        $msg = "";
        if(move_uploaded_file($file_tmp, $path)){
            $msg = "Image uploaded";
            //Execute this query-->With image
            echo 'Updating...';
             $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,`type`= ?,`image`= ?,'
            . '`total_rooms`= ? WHERE hostel_no = ?';
            $stmt= $con->prepare($query);
            $stmt->bind_param("sssssssss", $hostel_name, $description, $location, $road, $county, $type, 
                    $file_name, $total_rooms, $hostel_no);
            $stmt->execute();
        }else{
            $msg = "Problem uploading image";
            echo $msg;
        }
    
    }else{
        //Query to execute-->When a new image hasn't been chosen
         $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,`type`= ?, '
            . '`total_rooms`= ? WHERE hostel_no = ?';
        $stmt= $con->prepare($query);
        $stmt->bind_param("ssssssss", $hostel_name, $description, $location, $road, $county, $type, 
                $total_rooms, $hostel_no);
        $stmt->execute();
    }
    
    
    
    $folder = "uploads";
    $old_name = "../".$folder."/".$prev_name;
    $new_name = "../".$folder."/".$hostel_name;
    //If the hostel_name has changed, rename the folder
    if($hostel_name != $prev_name){         
        rename($old_name, $new_name);
    }
    
    header("location:../owner-edit-hostel.php?id=".$hostel_no."");
}

function queryWithImage($con){
    $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,`type`= ?,`image`= ?,'
            . '`total_rooms`= ? WHERE hostel_no = ?';
    $stmt= $con->prepare($query);
    $stmt->bind_param("sssssssss", $hostel_name, $description, $location, $road, $county, $type, 
            $file_name, $total_rooms, $hostel_no);
    $stmt->execute();
}

function queryWithoutImage($con){
    $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,`type`= ?,'
            . '`total_rooms`=? WHERE hostel_no = ?';
    $stmt= $con->prepare($query);
    $stmt->bind_param("ssssssss", $hostel_name, $description, $location, $road, $county, $type, 
            $total_rooms, $hostel_no);
    $stmt->execute();
}