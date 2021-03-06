<!DOCTYPE HTMl>
<html>
    <head>
        <title>Edit Hostel</title>
        <?php require './links.php';?>
        <link rel="stylesheet" type="text/css" href="css/owner-forms.css">
        <script src="js/owner/owner-edit.js"></script>
    </head>
<body>  
    <div class="container-fluid">
        <div class="my-2">
            <div id="edit-feedback" class="alert alert-success text-center fixed-top hide" style="top:85px;">Details Updated</div>
            <form method="post" class="add-hostel-form" id="edit-hostel-form" action="php-owner/owner-edit-hostel-action.php" 
                  enctype="multipart/form-data">
                <center>
                    <i class="fa fa-hotel"></i>
                    <div class="lead">My Hostel</div>
                </center>
                
                <div class="form-group">
                    <label>Hostel Name</label>
                    <input type="text" name="hostel_name" id="hostel_name" class="form-control" value="<?php echo $hostel_name;?>" required="" readonly="">
                    <div class="invalid-feedback">Hostel name already exists</div>
                    <small id="hostel_name_feedback" class="hide">Contact the administrator to change the hostel name</small>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" required=""><?php echo $description;?></textarea>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="<?php echo $location;?>" required="">
                    </div>
                    <div class="col-md-6">
                        <label>County</label>
                        <input type="text" name="county" id="county" class="form-control" value="<?php echo $county;?>" required="">
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <label>Road</label>
                        <input type="text" name="road" id="road" class="form-control" value="<?php echo $road;?>" required="">
                    </div>
                    <div class="col-md-6">
                        <label>Type</label>
                        <select class="form-control" name="hostel_type" id="hostel_type" required="">
                            <option value="">Choose One</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Mixed">Mixed</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Main Image</label>
                    <input type="file" name="image" id="image" onchange="ValidateSingleInput(this);" class="form-control" />
                    <img class="display_size" src="<?php echo $folder.$hostel_name.'/'.$image;?>" alt="Choose an image to see the preview" id="image_display">
                    <img src="#" class="display_size hide" alt="Choose an image to see the preview" id="preview_img">
                </div>
                
                <?php // include './owner-add-room.php'; ?>
                <?php // include './owner-add-amenities-and-rules.php';?>
                
                <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
           var type = "<?php echo $type;?>";
           $("#hostel_type").val(type);
           $("#image_display").addClass("display_size"); 
           
           $("#edit-hostel-form").submit(function(event){
                event.preventDefault(); //prevent default action 
                var post_url = $(this).attr("action"); //get form action url
                var request_method = $(this).attr("method"); //get form GET/POST method
                    
                $.ajax({
                    url: post_url, // Url to which the request is send
                    type: request_method,             // Type of request to be send, called as method
                    data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData:false,        // To send DOMDocument or non processed data file it is set to false
                    success: function(data)   // A function to be called if request succeeds
                    {
                       updateSuccess();
                    }
                });
            });
            
            function updateSuccess(){
                $("#edit-feedback").slideDown().delay(1500).slideUp();
            }
           
        });
    </script>
</body>
</html>