$(document).ready(function(){   
   
     
   //Display table records
   showTable();
   
   $("#add_tenant").click(function(e){
      e.preventDefault();
      
      var email = $("#email").val();
      var room_assigned = $("#room_assigned").val();
      verifyUser(email,room_assigned);
   });

    $(document).on("click","#remove_tenant", function(){
        
        var user_id = $(this).closest("tr").children().eq(0).text();
        var name = $(this).closest("tr").children().eq(1).text();
        
    
        if(deleteConfirmed(name)){
            removeTenant(user_id,name);
        } 
    });
    
    function verifyUser(email, room_assigned){
       
       $.post("owner-verify-user.php", {email:email, room_assigned:room_assigned}, function(data, status){
          
          if(data != ""){
              //Display error message
              $("#feedback").addClass("alert alert-danger");
              $("#feedback").html(data);
          }else{
              addTenant();
         }
       });
   }//End of function
   
   
   function addTenant(){
       
      var email = $("#email").val();
      var room_assigned = $("#room_assigned").val();
      
      $.post("owner-add-tenant.php", {email:email, room_assigned:room_assigned}, function(data, status){
          
          if(data != ""){
              //Display error message
              $("#feedback").removeClass("alert alert-danger");
              $("#feedback").addClass("alert alert-success");
              $("#feedback").html(data);
    
              clearTable();//To avoid duplicate rows
              showTable();//Display the updated table
          }else{
              alert("Not executed");
          }
       });
       
   }//End of function
   
   function showTable(){
      
      $.post("owner-get-tenants-table.php", function(data, status){
          
          if(data != ""){
              $("no-tenants-msg").hide();
              $("#tenants-table tbody").append(data);
          }else{
              $("#no-tenants-msg").show();
          }
       });
       
   }//End of function
   
   function clearTable(){
       $("#tenants-table").find("tr:not(:first)").remove();
   }//End of function
   
   
   function deleteConfirmed(name){   
    var del = confirm("Remove "+name+" as a tenant?");
        
        if(!del){
            return false;
        }
        else{
            return true;
        }
    }
    
    function removeTenant(user_id,name){
       $.post("owner-remove-tenant.php", {user_id:user_id, name:name}, function(data){
            $("#feedback").addClass("alert alert-success");
            $("#feedback").html(data);
            clearTable();
            showTable();
       });
       
    }//End of function
    
    
    
});