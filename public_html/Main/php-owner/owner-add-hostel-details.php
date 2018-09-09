<?php 
//Preliminaries
require_once './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_POST['hostel_name'])){
       
        $hostel_name = $_POST['hostel_name'];
       
        $check_email = $con->prepare("SELECT * FROM hostels WHERE hostel_name = ?");
        $check_email->bind_param("s", $hostel_name);
        $check_email->execute();
        $result1 = $check_email->get_result();

        if(mysqli_num_rows($result1)>=1){
            echo 'name-exists';
        }else{
            echo 'all-good';
        }
   } 

if(isset($_POST['description'])){
    //Generate a hostel_no randomly
    $hostel_no = get_hostel_no($con);
    $_SESSION['hostel_no'] = $hostel_no;
    
    //Get form data
    $hostel_name = $_POST['hostel_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $road = $_POST['road'];
    $county = $_POST['county'];
    $hostel_type = $_POST['hostel_type'];
    
    //Image Upload
    $folder = "../uploads/";
    $file_name = $_FILES['image']['name'];
    
    //The path to store the uploaded file
    $target = $folder.basename($file_name);
    
    //Get all submitted data from the form
    $image = $_FILES['image']['name'];
    
    
    //Insert data into database
    $add_hostel = "INSERT INTO `hostels`(`hostel_no`, `hostel_name`, `description`, `location`, `road`, `county`, `type`, "
            . "`image`) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($add_hostel);
    $stmt->bind_param("ssssssss",$hostel_no, $hostel_name, $description,$location, $road, $county, $hostel_type, $image);
    $stmt->execute();
    
    //Move the uploaded image into folder images
    $file_tmp = $_FILES['image']['tmp_name'];
    
    $msg = "";
    if(move_uploaded_file($file_tmp, $target)){
        $msg = "Image uploaded";
    }else{
        $msg = "Problem uploading image";
        echo $msg;
    }
       
}


function get_hostel_no($con){
    
    $hostel_no = mt_rand();
    
    do{
        
        $select = "SELECT * FROM hostels WHERE hostel_no = ?";
        $stmt = $con->prepare($select);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();
        
        $result = $stmt->get_result();
       
        $row_count = mysqli_num_rows($result);
        
    }while($row_count>0);
    
    return $hostel_no;
}