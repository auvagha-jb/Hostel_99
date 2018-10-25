$(document).ready(function(){
   
    /*
     * On load
     */
    showBookingsTable();
    
    function showBookingsTable(){    
        $.post("php-owner/owner-get-bookings-table.php", function(data, status){
          
          if(data != ""){
              $("no-bookings-msg").hide();
              $("#bookings-table tbody").append(data);
          }else{
              $("#no-bookings-msg").show();
          }
          $('#bookings-table').DataTable();
       });
       
   }//End of function

    $(document).on("click","#add-tenant", function(){
        var email = $(this).closest("tr").children().eq(4).text();
        var name = $(this).closest("tr").children().eq(1).text();
        var room_assigned = $(this).closest("tr").children().eq(5).text();
        var no_sharing = $(this).closest("tr").children().eq(6).text();
        showModal(email, name, room_assigned,no_sharing);
    });
    
    $(document).on("click","#confirm_add", function(){
        addTenant();
    });
    
    function showModal(email, name, room_assigned,no_sharing){
       var msg = '';
        msg += '<form id="modal_form">';
        msg += '<input type="hidden" id="email" value="'+email+'">';
        msg += '<input type="hidden" id="name" value="'+name+'">';
        msg += '<input type="hidden" id="no_sharing" value="'+no_sharing+'">';
        msg += '<input type="hidden" id="room_assigned" value="'+room_assigned+'">';
        msg += '</form>';
        
        msg += '<span>Add '+name+' as a tenant?</span>';
        $("#add_dialog").html(msg);
        $("#confirmAddModal").modal('show');
   }
   
   function addTenant(){
      var form = "#modal_form";
      var email = $(form+" #email").val();
      var room_assigned = $(form+" #room_assigned").val();
      var no_sharing = $(form+" #no_sharing").val();
            
      $.post("owner-add-tenant.php", {email:email, room_assigned:room_assigned,no_sharing:no_sharing}, function(data, status){
          if(data != ""){
              $("#no-tenants-msg").hide();//Remove no-tenants message
                showSuccess(data);
                refreshTable();
          }else{
              alert("Not executed");
          }
       });
   }//End of function
   
   function showSuccess(data){
      //Display success message
      $("#feedback").removeClass("alert alert-danger");
      $("#feedback").addClass("alert alert-success");
      $("#feedback").html(data);
   }
    
   function refreshTable(){
      $("#hostel_overview").slideUp();
      clearTable();
      showBookingsTable();//Display the updated table
   }
   
   function clearTable(){
       $("#bookings-table").find("tr:not(:first)").remove();
   }//End of function
   
});