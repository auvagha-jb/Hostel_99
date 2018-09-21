function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var image = document.getElementById("image_display");
            image.src = e.target.result;
            image.style.display = "block";  
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
    
    //Preliminaries
     //Prevent resubmission on refresh or back
    if(window.history.replaceState){
       window.history.replaceState(null, null, window.location.href); 
    }
    
    //turn off auto-complete
    $(".add-hostel-form").attr("autocomplete", "off");
    
    
    
    //Dynamic input fields
    //Add room table
    $(document).on("click", ".add-room", function(){
       var html = "";
       //Hide the warning message if it had been displayed
       $("#rooms-feedback").hide();
       
       html+="<tr>";
       html+='<td><input type="number" name="no_sharing[]" id="no_sharing" class="form-control" required></td>';
       html+='<td><input type="number" name="monthly_rent[]" id="monthly_rent" class="form-control" required></td>';
       html+='<td><input type="number" name="room_limit[]" id="room_limit" class="form-control" required></td>';
//       html+='<td><input type="number" name="total_occupants[]" id="total_occupants" class="form-control" required></td>';
//       html+='<td><input type="number" name="no_rooms_occupied[]" id="no_rooms_occupied" class="form-control" required></td>';
       html+='<td><button type="button" class="btn btn-success btn-sm add-room"><i class="fa fa-plus"></i></button></td>';
       html+='<td><button type="button" class="btn btn-danger btn-sm remove-room"><i class="fa fa-minus"></i></button></td>';
       html+='</tr>';
       
       $("#add-room-tbl").append(html);
    });
    
    $(document).on('click', '.remove-room',function(){
        var rows = $("#add-room-tbl >tbody >tr").length;
          
        var feedback = "<div class='alert alert-warning'>At least one row is needed</div>";
        
        if(rows>1){
            $("#rooms-feedback").hide();
            $(this).closest("tr").remove(); 
            
        }else{
            $("#rooms-feedback").html(feedback);
            $("#rooms-feedback").show();
        }
    });
    
    
    //Amenities table
    //Add amenities 
    $(document).on("click", ".add-amenity", function(){
         addAmenity();
    });
    
    //Remove amenities
    $(document).on('click', '.remove-amenity',function(){
        var rows = $("#add-amenities-tbl >tbody >tr").length;
          
        var feedback = "<div class='alert alert-warning'>At least one row is needed</div>";
        
        if(rows>1){
            $("#amenities-feedback").hide();
            $(this).closest("tr").remove(); 
            
            
        }else{
            
            $("#amenities-feedback").html(feedback);
            $("#amenities-feedback").show();
        }
        console.log(rows);
    });
    
    //Rules table
    //Add rules
    $(document).on("click", ".add-rule", function(){
         addRule();
    });
    
    //Remove rule
    $(document).on('click', '.remove-rule',function(){
        var rows = $("#add-rules-tbl >tbody >tr").length;
          
        var feedback = "<div class='alert alert-warning'>At least one row is needed</div>";
        
        if(rows>1){
            $("#rules-feedback").hide();
            $(this).closest("tr").remove(); 
        }else{
            $("#rules-feedback").html(feedback);
            $("#rules-feedback").show();
        }
        console.log(rows);
    });

    
    //images 
    $(document).on("click", ".add-image", function(){
       addImage(); 
    });
    
    function addAmenity(){
       //Hide warning message if it had been displayed
        $("#amenities-feedback").hide();
        
        var html="";
        
        html+="<tr>";
        html+='<td><input type="text" name="amenities[]" id="amenities" class="form-control" required></td>';
        html+='<td><button type="button" class="btn btn-success btn-sm add-amenity"><i class="fa fa-plus"></i></button></td>';
        html+='<td><button type="button" class="btn btn-danger btn-sm remove-amenity" id="first_rule"><i class="fa fa-minus"></i></button></td>';
        html+="</tr>";
       
        $("#add-amenities-tbl").append(html);
        
        var rows = $("#add-amenities-tbl >tbody >tr").length;
        console.log(rows);  
   }
    
    function addRule(){
       //Hide warning message if it had been displayed
        $("#rules-feedback").hide();
        
        var html="";
        
        html+="<tr>";
        html+='<td><input type="text" name="rules[]" id="rules" class="form-control" required></td>';
        html+='<td><button type="button" class="btn btn-success btn-sm add-rule"><i class="fa fa-plus"></i></button></td>';
        html+='<td><button type="button" class="btn btn-danger btn-sm remove-rule"><i class="fa fa-minus"></i></button></td>';
        html+="</tr>";
       
        $("#add-rules-tbl").append(html);
        
        var rows = $("#add-rules-tbl >tbody >tr").length;
        console.log(rows);  
   }
   
    function addImage(){
       //Hide warning message if it had been displayed
        $("#add-image-feedback").hide();
        
        var html="";
        
        html+="<tr>";
        html+='<td><input type="file" name="image" id="image" onchange="readURL(this);" class="form-control"/>';
        html+='<img src="#" alt="Choose an image to see the preview" id="image_display">';
        html+='</td>';
        html+='<td><button type="button" class="btn btn-success btn-sm add-image"><i class="fa fa-plus"></i></button></td>';
        html+='<td><button type="button" class="btn btn-danger btn-sm remove-image"><i class="fa fa-minus"></i></button></td>';
        html+="</tr>";
       
        $("#add-image-tbl").append(html);
        
        var rows = $("#add-image-tbl >tbody >tr").length;
        console.log(rows);  
   }
    
    function insert_td(form_data){
        
        $.ajax({
           url: "php-owner/owner-add-hostel-action.php",
           method: "post",
           data: form_data,
           success:function(data){
               if(data === 'ok'){
                   $("#item_table").find("thead").remove(); 
               
                    //Display success message
                    var feedback = '<div class="alert alert-success">Room details saved</div>';

                    $("#feedback").html(feedback);
               }
           }
           
        });
    }
    
   
//    $("#add-hostel-form").submit(function(e){
//       
//       //prevent the default action which in this case is sending the form data  
//        e.preventDefault();
//        
//        var form_data = $(this).serialize();
//        insert_td(form_data);
//    });
    
    
    //Add hostel-details form
    
    //Resize the image preview
    $("#image").change(function(){
       $("#image_display").addClass("display_size"); 
    });
    
    function validName(){
       var hostel_name = $("#hostel_name").val();
       
       $.post("php-owner/owner-add-hostel-details.php", {hostel_name: hostel_name}, function(data){
            console.log(data);
            if(data === "name-exists"){               
                $("#hostel_name").addClass("is-invalid");
                valid = false;
            }else{
                $("#hostel_name").removeClass("is-invalid");
                valid = true;
            }
        });
        
        console.log("Name: "+valid);
        return valid;
   }
    
    
    $("#hostel_name").keyup(function(){
        validName();
    });
    
});



                        
                        
                        
                        
                        
                        
                    