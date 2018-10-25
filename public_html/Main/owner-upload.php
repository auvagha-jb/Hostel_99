<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'links.php'; ?>       
    <!--Generic-->
    <link href="style.css" rel="stylesheet">
<!--    <script src="js/owner-upload.js"></script>-->
</head>
<body>
    
<?php
include_once 'php/connection.php';
$folder_name = 'uploads/';
$hostel_name = $_SESSION['hostel_name']."/";

if(!empty($_FILES))
{
     $temp_file = $_FILES['file']['tmp_name'];

     //Check whether the hostel folder exists
     if(!file_exists($folder_name.$hostel_name)){
         mkdir($folder_name.$hostel_name);
     }

     $location = $folder_name.$hostel_name.$_FILES['file']['name'];

    move_uploaded_file($temp_file, $location);
}

//This is the remove image action
if(isset($_POST["name"]))
{
    $filename = $folder_name.$hostel_name.$_POST["name"];
    unlink($filename);
}

$result = array();

if(file_exists($folder_name.$hostel_name)){
    //Scans the named folder and returns file names
    $files = scandir($folder_name.$hostel_name);

    $output = '<div class="row">';

    //This will check whether there is an error with the scandir() function
    if(false !== $files)
    {
         foreach($files as $file){
             //This condition will ignore a single dot and double dot file
              if('.' !=  $file && '..' != $file){
                $output .= '
                <div class="col-md-2">
                 <img src="'.$folder_name.$hostel_name.$file.'" class="img-thumbnail" width="275" height="275" style="height:175px;" />
                 <button type="button" class="btn btn-outline-danger btn-sm remove_image" id="'.$file.'">Remove</button>
                    <p>'.$file.'</p>
                </div>
                ';
              }
        }
    }
    $output .= '</div>';
    echo $output;
}  
else {
    echo '<center class="lead">No photos posted yet! Click or Drag and drop above</center>';
}
?>

</body>
</html>





































