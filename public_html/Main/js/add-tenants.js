$(document).ready(function(){   
   
   $("#add_tenant").click(function(e){
       
       //IMPORTANT to prevent form submission
       e.preventDefault();
       
       var email = $("#email").val();
       updateTable(email);
   });
   
   function updateTable(email){
       $.post("php-owner/owner-add-tenants.php", {email: email}, function(data, status){
          
       });
   }
   
});