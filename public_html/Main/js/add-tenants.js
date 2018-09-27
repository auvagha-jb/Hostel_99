$(document).ready(function(){   
   
   
   if(window.history.replaceState()){
       window.history.replaceState(null, null, window.location.href); 
    }
    
   
   $("#add-tenant-form").submit(function(e){
      e.preventDefault();
      
      var email = $("#email").val();
      updateTable(email);
      

   });
   
   function updateTable(email){
       
       $.post("owner-add-tenants.php", {email:email}, function(data, status){
//          $("#feedback").html(data);
//          if(data !== ""){
//              
//          }else{
////             $("#add-tenant-form").ajaxSubmit({url: 'fixfile.php', type: 'post'});
//          }
           alert(status);
       });
   }
   
});