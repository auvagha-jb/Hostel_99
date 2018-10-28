<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add images</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once './links.php'; ?>       
        <!--Generic-->
    <link href="css/owner-forms.css" rel="stylesheet">
    <script src="js/owner-upload.js"></script>
</head>
<body>
    <div id="upload_error" class="alert alert-warning fixed-top" style="top: 85px; text-align: center; display: none;">Only image files can be uploaded</div>
    <?php 
        $hostel_name = $_GET['hostel_name'];
        $_SESSION['hostel_name'] = $hostel_name;
    ?>
    <p class="title-centered">My photos</p>
    
    <form action="owner-upload.php" class="dropzone" id="dropzoneFrom">
    </form>
    <br>
<!--    <center>
        <button id="submit-all" class="btn btn-primary">Upload</button>
    </center>-->
    <br>
    <div id="preview">
        
    </div>
    <br>
    <br>
    
</body>
</html>