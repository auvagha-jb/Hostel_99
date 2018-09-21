<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once './links.php'; ?>       
        <!--Generic-->
        <link href="css/owner-forms.css" rel="stylesheet">
    <script src="js/owner-forms.js"></script>
    <script>
        
        $(document).ready(function(){
            Dropzone.options.dropzoneFrom = {
            autoProcessQueue: false,
            acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
            init: function(){
             var submitButton = document.querySelector('#submit-all');
             myDropzone = this;
             submitButton.addEventListener("click", function(){
              myDropzone.processQueue();
             });
             this.on("complete", function(){
              if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
              {
               var _this = this;
               _this.removeAllFiles();
              }
              //list_image();
             });
            },
           };
           
           
       function list_image(){
        $.ajax({
         url:"upload.php",
         success:function(data){
            $('#preview').html(data);
         }
        });
       }
       
       $(document).on('click', '.remove_image', function(){
            var name = $(this).attr('id');
            $.ajax({
             url:"upload.php",
             method:"POST",
             data:{name:name},
             success:function(data)
             {
                list_image();
             }
            })
           });
       
           
        });
        
    </script>
</head>

<?php 

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    $hostel_name = $_GET['hostel_name'];
    $_SESSION['hostel_name'] = $hostel_name;
?>

<body>
    <form action="php-owner/owner-upload.php?hostel_name=<?php echo $hostel_name;?>" class="dropzone" id="dropzoneFrom">
        <center>
            <button type="submit" class="btn btn-info" id="submit-all">Upload</button>
        </center>
    </form>
    <br>
    <br>
    
    <div id="preview">
        
    </div>
    <br>
    <br>
</body>
</html>