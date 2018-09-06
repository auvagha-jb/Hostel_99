<!DOCTYPE HTMl>
<html>
    <head>
        <title>Hostel Edit</title>
        <?php require './links.php';?>
    </head>
<body>
    <div class="container-fluid">

        <?php 
            //Preliminaries
            include './php/connection.php';
            session_start();
            
            //Display the image uploaded
            $stmt = $con->prepare("SELECT * FROM test_image_upload WHERE ");
        
        ?>
        <div>
            <form method="post" action="php/test-action.php" enctype="multipart/form-data">
                <input type="file" name="image" class="form-control">
                <textarea class="form-control" name="text"></textarea>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div> 
</body>    
</html>