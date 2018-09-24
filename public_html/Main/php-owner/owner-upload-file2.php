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
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include_once '../php/connection.php';
$hostel_name = $_SESSION['hostel_name'];

//Folder where we are posting our uploads
$folder_name = '../uploads/';

if(!empty($_FILES))
{
 $temp_file = $_FILES['file']['tmp_name'];
 $location = $folder_name . $_FILES['file']['name'];
 move_uploaded_file($temp_file, $location);
 
 //INSERT file name into the images table 
 $insert_query = "INSERT INTO images (hostel_no, image_name)";
 
}

//Get all the hostel images uploaded 
$query = "SELECT * FROM images WHERE hostel_no = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("s", $hostel_no);

$result = $stmt->get_result();

$output = '<div class="row">';
    
 while($row = $result->fetxh_array())
 {
     $file = $row['image_name'];
     
        $output .= '
        <div class="col-md-6">
         <img src="'.$folder_name.$file.'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
         <button type="button" class="btn btn-link remove_image" id="'.$file.'">Remove</button>
        </div>
        ';
  }

$output .= '</div>';
echo $output;

?>

</body>
</html>





























