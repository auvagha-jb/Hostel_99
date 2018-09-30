$(document).ready(function(){   
   
   /*
    * On load...
    */
   //Display table records
   showTable();
   getNoSharing();
   getVacancies();
   
   $("#add_tenant").click(function(e){
      e.preventDefault();
      
      var email = $("#email").val();
      var room_assigned = $("#room_assigned").val();
      var no_sharing = $("#no_sharing").val();
      verifyUser(email,room_assigned,no_sharing);
   });

    $(document).on("click","#remove_tenant", function(){
        
        var user_id = $(this).closest("tr").children().eq(0).text();
        var name = $(this).closest("tr").children().eq(1).text();
        var no_sharing = $(this).closest("tr").children().eq(6).text();
        
    
        if(deleteConfirmed(name)){
            removeTenant(user_id,name,no_sharing);
        } 
    });
    
    $("#no_sharing").change(function(){ 
        var no_sharing = $("#no_sharing").val();
        getRent(no_sharing); 
    });
    
    function verifyUser(email, room_assigned,no_sharing){
       
       $.post("owner-verify-user.php", {email:email, room_assigned:room_assigned, no_sharing:no_sharing}, function(data, status){
          
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
      var no_sharing = $("#no_sharing").val();
      
      $.post("owner-add-tenant.php", {email:email, room_assigned:room_assigned,no_sharing:no_sharing}, function(data, status){
          
          if(data != ""){
              //Display succes message
              $("#feedback").removeClass("alert alert-danger");
              $("#feedback").addClass("alert alert-success");
              $("#feedback").html(data);
              
              $("#no-tenants-msg").hide();//Remove no-tenants message
              clearTable();//To avoid duplicate rows
              showTable();//Display the updated table
              getVacancies();//Update vacancies
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
    
    function removeTenant(user_id,name,no_sharing){
       $.post("owner-remove-tenant.php", {user_id:user_id, name:name, no_sharing:no_sharing}, function(data){
            $("#feedback").addClass("alert alert-success");
            $("#feedback").html(data);
            clearTable();
            showTable();
            getVacancies();//Update vacancies
       });
       
    }//End of function
    
    
   function getNoSharing(){
       var select = "select";
       
       $.post("php-owner/owner-get-room-details.php", {select:select} ,function(data){
            $("#no_sharing").append(data);
       });
   }//End of function 
   
   function getRent(no_sharing){
     $.post("php-owner/owner-get-room-details.php", {no_sharing:no_sharing} ,function(data){
            $("#monthly_rent").val(data);
       });  
   }
   
   function getVacancies(){
      $.post("php-owner/owner-update-vacancies.php",function(data){
            $("#vacancies").html(data);
       }); 
   }
   
});