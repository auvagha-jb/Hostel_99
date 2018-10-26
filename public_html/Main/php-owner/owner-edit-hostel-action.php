<?php
include_once './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

//kill autocommit
$con->autocommit(false);

    //Previous form data
    $prev_name = $_SESSION['hostel_name'];
    $hostel_no = $_SESSION['hostel_no'];
    $prev_image_name = $_SESSION['prev_image_name'];
    $error = array();
    
    // $prev_name."<br>";
    
    //Get form data
    $hostel_name = $_POST['hostel_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $road = $_POST['road'];
    $county = $_POST['county'];
    $type = $_POST['hostel_type'];
    
    
    //Image Upload
    $folder = './../uploads/'.$hostel_name.'/';
    $file_name = $_FILES['image']['name'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $path = $folder.$file_name;
    $prev_path = $folder.$prev_image_name;
    
    if(!file_exists($folder)){
        mkdir($folder);
    }
    
    // "File: ".$file_name."<br>".$hostel_no."<br>".$prev_path."<br>Current: ".$path."<br>";
    
    //Update the image uploaded -->if an image is chosen
    if(!empty($file_name)){
        
        //UNLINK previous image-->If it was present
        if(!empty($prev_image_name)&& file_exists($prev_path)){
            
            unlink($prev_path);
        }
        
        //Move the uploaded image into the correct folder
        $msg = "";
        if(move_uploaded_file($file_tmp, $path)){
            $msg = "Image uploaded";
            //Execute this query-->With image
            // 'Updating...';
             $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,'
                     . '`type`= ?,`image`= ? WHERE hostel_no = ?';
            $stmt= $con->prepare($query);
            $stmt->bind_param("ssssssss", $hostel_name, $description, $location, $road, $county, $type, $file_name, $hostel_no);
            $bool = $stmt->execute();
            
            if(!$bool){
                array_push($error, $con->error);
            }
            
        }else{
            $msg = "Problem uploading image";
            array_push($error, $con->error);
        }
    
    }else{
        /*
         * HAS ONE LESS PARAMETER
         * Query to execute-->When a new image hasn't been chosen
         */
         $query ='UPDATE `hostels` SET `hostel_name`= ?,`description`= ?,`location`= ?,`road`= ?,`county`= ?,`type`= ? '
            . 'WHERE hostel_no = ?';
        $stmt= $con->prepare($query);
        $stmt->bind_param("sssssss", $hostel_name, $description, $location, $road, $county, $type, $hostel_no);
        $bool = $stmt->execute();
        
        if(!$bool){
                array_push($error, $con->error);
            }
    }
    
    
    
    //Rename folder in case the hostel name changes
    $folder_name = "uploads";
    $old_path = "../".$folder_name."/".$prev_name;
    $new_path = "../".$folder_name."/".$hostel_name;
    
    $old_name = realpath(dirname($old_path))."\\".$prev_name;
    $new_name = realpath(dirname($old_path))."\\".$hostel_name;
    
    
    
    //echo '<br>Old name: '.$old_name.'<br> New name: '.$new_name.'<br>';
    

    /*NOT FUNCTIONAL AT THE MOMENT
     * If the hostel_name has changed, rename the folder
     */
    if($hostel_name != $prev_name && file_exists($old_path)){         
        //rename($old_name, $new_name);
    }
    
    if(count($error)==0){
        $con->commit();
        echo 'Updated';   
    }