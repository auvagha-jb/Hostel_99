<?php    
        include_once './php/connection.php';
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['hostel_no'] = $_GET['id'];
        $_SESSION['type'] = $_GET['type'];
    ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My tenants</title>
        <?php include_once './links.php';?>
        <link rel="stylesheet" href="css/owner-forms.css">
        <script src="js/manage-tenants.js"></script>
        <script src="js/manage-tenants-extended.js"></script>
    </head>
<body>

    <!--Navigation bar-->
    <?php include './nav-bar.php'; ?>
    
    <!--The session was started at the very start-->
    <div class="add-tenant-form">
        
    <center class="lead my-3" id="no-tenants-msg">
        No tenants added yet! Add them below.
    </center>
        
    <form class="form-inline justify-content-center" method="post" id="add-tenant-form">
        <input class="form-control mx-2" name="email" id="email" placeholder="Email address" required="">
        <input type="hidden" name="gender" id="gender" value="">
        <select class="form-control mx-2" name="no_sharing" id="no_sharing" required="">
            <option value="">No. sharing</option>
        </select>
        <div class="input-group mx-2">
            <input class="form-control" name="room_assigned" id="room_assigned" placeholder="Room assigned" required="" readonly="">
            <div class="input-group-append">
                <button type="submit" class="btn btn-success form-control" name="search_submit" id="add_tenant">
                    <i class="fa fa-plus-circle"></i>
                </button>
            </div>
        </div>
        <input class="form-control mx-2" id="monthly_rent" placeholder="Monthly rent" required="" readonly="">
    </form>
    
        <center id="feedback"></center>
        <!--NOTE: Margin styling added in manage-tenants.js-->
        <div class="mt-3 ml-3" >
            <span class="lead inline-text mx-3">
            Vacancies:
            <span class="border px-2" id="vacancies"></span>
            </span>
            <span class="lead inline-text mx-3">
                Pending Bookings:
                <span class="border px-2" id="bookings"></span>
            </span>
            <div class="my-3">
                <div id="hostel_overview">
                
                </div>
            </div>
        </div>
        
        
       <!--User show tenants table-->
       <div class="table-responsive mx-3 my-3">
        <table class="table table-bordered" id="tenants-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Room Assigned</th>
                    <th>No sharing</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div> 
        
</div>

    <!-- Confirm delete Modal -->
    <div class="modal fade" id="confirmDelModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirm delete</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="delete_dialog">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-dark" id="blacklist_tenant" data-dismiss="modal">Remove and blacklist</button>
            <button type="button" class="btn btn-danger" id="remove_tenant" data-dismiss="modal">Remove</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
    <!--Assign room modal-->
    <div class="modal fade" id="assignRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose a room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body" id="assign-rm-dialog">
              <div class="row">
                  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    
    
</body>
</html>