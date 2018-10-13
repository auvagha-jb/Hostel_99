$(document).ready(function(){   

    //Styling
    $(".inline-text").addClass("mr-3");
    $(".inline-text").addClass("my-3");
    
   /*
    * On load...
    */
   //Display table records
   showTable();
   getNoSharing();
   getVacancies();
   getBookings();
   
   $("#add_tenant").click(function(e){
      e.preventDefault();
      
      var email = $("#email").val();
      var room_assigned = $("#room_assigned").val();
      var no_sharing = $("#no_sharing").val();
      verifyUser(email,room_assigned,no_sharing);
   });

    $(document).on("click","#show_modal", function(){
        
        var user_id = $(this).closest("tr").children().eq(0).text();
        var name = $(this).closest("tr").children().eq(1).text();
        var no_sharing = $(this).closest("tr").children().eq(6).text();
        
        var msg = '';
        msg += '<form id="modal_form">';
        msg += '<input type="hidden" id="user_id" value="'+user_id+'">';
        msg += '<input type="hidden" id="name" value="'+name+'">';
        msg += '<input type="hidden" id="no_sharing" value="'+no_sharing+'">';
        msg += '</form>';
        
        msg += '<span>Remove '+name+' as a tenant?</span>';
        $("#delete_dialog").html(msg);

    });
    
    $(document).on("click","#remove_tenant", function(){
        var user_id = $("#modal_form #user_id").val();
        var name = $("#modal_form #name").val();
        var no_sharing = $("#modal_form #no_sharing").val();
        removeTenant(user_id,name,no_sharing); 
    });
    
    
    $("#no_sharing").change(function(){ 
        var no_sharing = $("#no_sharing").val();
        getRent(no_sharing); 
    });
    
    function verifyUser(email, room_assigned,no_sharing){
       
       $.post("owner-verify-user.php", {email:email, room_assigned:room_assigned, no_sharing:no_sharing,action:"add_tenant"},
        function(data, status){  
          if(data !== ""){
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
                refreshTable();
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
   
   
    function removeTenant(user_id,name,no_sharing){
       $.post("owner-remove-tenant.php", {user_id:user_id, name:name, no_sharing:no_sharing}, function(data){
            $("#feedback").addClass("alert alert-success");
            $("#feedback").html(data);
            refreshTable();
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
   
   function getBookings(){
      $.post("php-owner/owner-get-no-booked.php",function(data){
            $("#bookings").html(data);
       }); 
   }
   
   function refreshTable(){
      clearTable();//To avoid duplicate rows
      showTable();//Display the updated table
      getVacancies();//Update vacancies
      getBookings();//Update no-booked
   }
     
});