<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once './links.php'; ?>       
        <!--Generic-->
    <link href="css/owner-forms.css" rel="stylesheet">
    <script src="js/owner-forms.js"></script>
    <script src="js/owner-upload.js"></script>
</head>
<body>
    
    <?php include './nav-bar.php';?>
    
    <?php 
        $hostel_name = $_GET['hostel_name'];
        $_SESSION['hostel_name'] = $hostel_name;
    ?>
    <form action="owner-upload.php" class="dropzone" id="dropzoneFrom">
    </form>
<!--    <center>
        <button type="button" class="btn btn-info" id="submit-all">Upload</button>
    </center>-->
    <br>
    <br>
    
    
    <div id="preview">
        
    </div>
    <br>
    <br>
</body>
</html>