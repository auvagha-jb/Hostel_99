function goBack(){
   window.history.back();
}

Dropzone.options.dropzoneFrom = {
        autoProcessQueue: true,//Stops immediate file upload
        acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg"
    };

Dropzone.autoDiscover = false;

$(document).ready(function(){
    list_image();

       function list_image(){
            $.ajax({
             url:"owner-upload.php",
             success:function(data){
                $('#preview').html(data);
             }
            });
       }
      
      var dropzone = new Dropzone('#dropzoneFrom');
           
           dropzone.on('complete', function(){
              setTimeout(function(){
                list_image();
                dropzone.removeAllFiles();   
              },2000);
           });
           
           dropzone.on('error', function(){
               $("#upload_error").slideDown().delay(1500).slideUp();
           });
           
       //To remove uploaded image 
        $(document).on('click', '.remove_image', function(){
            var name = $(this).attr('id');
                        
            $.ajax({
             url:"owner-upload.php",
             method:"POST",
             data:{name:name},
             success:function(data)
             {
                //Fetch images and uploads on image
                list_image();
             }
            });
        });
               
});