<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel 99</title>
        <?php include '../links.php'; ?>       
        <!--Generic-->
	<link href="../style.css" rel="stylesheet">
        <script src="../js/main.js"></script>
</head>
<body>
<?php
include_once '../php/connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$folder_name = '../uploads/';
//$hostel_no = $_GET['hostel_no'];
$hostel_name = $_SESSION['hostel_name']."/";

if(!empty($_FILES))
{
 $temp_file = $_FILES['file']['tmp_name'];
 
 //Check whether the hostel folder exists
 if(!file_exists($folder_name.$hostel_name)){
     mkdir($folder_name.$hostel_name);
 }
 
 $location = $folder_name.$hostel_name. $_FILES['file']['name'];
 
move_uploaded_file($temp_file, $location);
}

if(isset($_POST["name"]))
{
 $filename = $folder_name.$_POST["name"];
 unlink($filename);
}

$result = array();

//Scans the named folder and returns file names
$files = scandir($folder_name.$hostel_name);

$output = '<div class="row">';

//This will check whether there is an error with the scandir() function
if(false !== $files)
{
    
 foreach($files as $file)
 {
      if('.' !=  $file && '..' != $file)
      {
        $output .= '
        <div class="col-md-4">
         <img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
         <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
        </div>
        ';
      }
     }
}
$output .= '</div>';
echo $output;

?>

</body>
</html>





































