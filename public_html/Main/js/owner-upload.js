function goBack(){
   window.history.back();
}


$(document).ready(function(){
    list_image();
    
    Dropzone.options.dropzoneFrom = {
        autoProcessQueue: true,//Stops immediate file upload
        acceptedFiles:".png,.jpg,.gif,.bmp,.jpeg",
        init: function(){
            var submitButton = document.querySelector('#submit-all');
            myDropzone = this;
            submitButton.addEventListener("click", function(){
            myDropzone.processQueue();
        });
         //What exectutes when the uploads are complete
        this.on("complete", function(){
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0){
                var _this = this;
                _this.removeAllFiles();//Remove files from dropzone
                console.log("complete");
            }
            list_image();
         });
        }
    };
           
           
           
       function list_image(){
            $.ajax({
             url:"owner-upload.php",
             success:function(data){
                $('#preview').html(data);
             }
            });
       }
      
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