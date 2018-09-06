<?php 
//Preliminaries
require './connection.php';


if(isset($_POST['submit'])){
    
    $folder = "../images/";
    $file_name = $_FILES['image']['name'];
    
    //The path to store the uploaded file
    $target = $folder.basename($file_name);
    
    //Get all submitted data from the form
    $image = $_FILES['image']['name'];
    $text = $_POST['text'];
    
    $stmt = $con->prepare("INSERT INTO test_image_upload (image, text) VALUES (?,?)");
    $stmt->bind_param("ss", $image, $text);
    $stmt->execute();
    
    //Move the uploaded image into folder images
    $file_tmp = $_FILES['image']['tmp_name'];
    
    $msg = "";
    if(move_uploaded_file($file_tmp, $target)){
        $msg = "Image uploaded";
    }else{
        $msg = "Problem uploading image";
    }
    echo $msg;
    
}