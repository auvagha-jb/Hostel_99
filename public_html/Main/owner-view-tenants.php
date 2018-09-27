<!DOCTYPE HTML>
<html>
    <head>
        <title>My tenants</title>
        <?php include_once './links.php';?>
        <link rel="stylesheet" href="css/owner-forms.css">
<!--        <script src="js/add-tenants.js"></script>-->
        <script>
 $(document).ready(function(){   
   
   $("#add_tenant").click(function(e){
      e.preventDefault();
      
      var email = $("#email").val();
      var room_assigned = $("#room_assigned").val();
      updateTable(email,room_assigned);

   });

    function updateTable(email, room_assigned){
       
       $.post("owner-add-tenants.php", {email:email, room_assigned:room_assigned}, function(data, status){
          
          if(data != ""){
              //Display error message
              $("#feedback").addClass("alert alert-danger");
              $("#feedback").html(data);
          }else{
              //Submit form
//              $("#add-tenant-form").ajaxSubmit({url:"owner-add-tenants.php", type:"post"})
             location.reload();
         }
       });
   }
});
        </script>
    </head>
<body>
    
    <?php    
        include_once './php/connection.php';
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['hostel_no'] = $_GET['id'];
    ?>
    
    <div class="add-tenant-form">
        
    <form class="form-inline justify-content-center" method="post" id="add-tenant-form">
        <input class="form-control mx-2" name="email" id="email" placeholder="Email address" required="">
        <div class="input-group mx-2">
            <input class="form-control" name="room_assigned" id="room_assigned" placeholder="Room assigned" required="">
            <div class="input-group-append">
                <button type="button" class="btn btn-success form-control" name="search_submit" id="add_tenant">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
    </form>
    
        <center id="feedback"></center>
        <?php include './owner-get-tenants-table.php'; ?>  
</div>
    
</body>
</html>