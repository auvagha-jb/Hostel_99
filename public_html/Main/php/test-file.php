<?php

if(isset($_POST['submit'])){
    //Image Upload
    $folder = "../uploads/";
    $file_name = $_FILES['image']['name'];
    
    //The path to store the uploaded file
    $target = $folder.basename($file_name);
    
    //Get all submitted data from the form
    $image = $_FILES['image']['name'];
    
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
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Test File</title>
    </head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" name="submit">
        </form>
    </body>
</html>
