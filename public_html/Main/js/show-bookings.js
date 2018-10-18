$(document).ready(function(){
   
    /*
     * On load
     */
    showTable();
    
    function showTable(){    
        $.post("php-owner/owner-get-bookings-table.php", function(data, status){
          
          if(data != ""){
              $("no-bookings-msg").hide();
              $("#bookings-table tbody").append(data);
          }else{
              $("#no-bookings-msg").show();
          }
       });
       
   }//End of function
    
});