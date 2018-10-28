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
        $bool = $check_email->execute();
        
        if(!$bool){
            array_push($error, $con->error);
        }
        
        $result1 = $check_email->get_result();

        if(mysqli_num_rows($result1)>=1){
            echo 'name-exists';
        }else{
            echo 'all-good';
        }
   } 

if(isset($_POST['description'])){
    //Generate a hostel_no randomly -->Then store it in a session variable
    $hostel_no = get_hostel_no($con, $error);
    
    //Get form data
    $hostel_name = $_POST['hostel_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $road = $_POST['road'];
    $county = $_POST['county'];
    $hostel_type = $_POST['hostel_type'];
    
    //Set session variables
    $_SESSION['hostel_no'] = $hostel_no;
    $_SESSION['hostel_name'] = $hostel_name;
    $_SESSION['type'] = $hostel_type;
    
    //Image Upload
    $folder = "./../uploads/".$hostel_name."/";
    $file_name = $_FILES['image']['name'];
    $path = $folder.$file_name;
    
    //Create a folder for that hoostel
    if(!file_exists($folder)){
        if(!mkdir($folder)){//Verify the mkdir works
            array_push($error, $con->error);
        }
    }
    
    
    //Get all submitted data from the form
    $image = $_FILES['image']['name'];
    
    
    //Insert data into database
    $add_hostel = "INSERT INTO `hostels`(`hostel_no`, `hostel_name`, `description`, `location`, `road`, `county`, `type`, "
            . "`image`) VALUES(?,?,?,?,?,?,?,?)";
    $stmt = $con->prepare($add_hostel);
    $stmt->bind_param("ssssssss",$hostel_no, $hostel_name, $description,$location, $road, $county, $hostel_type, $image);
    $bool = $stmt->execute();
    
    if(!$bool){
        array_push($error, $con->error);
    }
    
    //Move the uploaded image into folder images
    $file_tmp = $_FILES['image']['tmp_name'];
    
    $msg = "";
    if(move_uploaded_file($file_tmp, $path)){
        $msg = "Image uploaded";
    }else{
        $msg = "Problem uploading image";
        echo $msg;
    }
       
}


function get_hostel_no($con, &$error){
    
    $hostel_no = mt_rand();
    
    do{
        
        $select = "SELECT * FROM hostels WHERE hostel_no = ?";
        $stmt = $con->prepare($select);
        $stmt->bind_param("s", $hostel_no);
        $bool = $stmt->execute();
        
        if(!$bool){
            array_push($error, $con->error);
        }
        
        $result = $stmt->get_result();
       
        $row_count = mysqli_num_rows($result);
        
    }while($row_count>0);
    
    return $hostel_no;
}