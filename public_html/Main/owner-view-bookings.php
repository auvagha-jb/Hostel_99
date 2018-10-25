<?php    
        include_once './php/connection.php';
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['hostel_no'] = $_GET['id'];
    ?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Bookings</title>
        <?php include_once './links.php';?>
        <link rel="stylesheet" href="css/owner-forms.css">
        <script src="js/show-bookings.js"></script>
    </head>
<body>

    <!--Navigation bar-->
    <?php include './nav-bar.php'; ?>
    <?php include './sidebar.php'; ?>
    <!--The session was started at the very start-->
    
<div id="wrapper" class="toggled">        
        <?php include './sidebar.php'; ?>
        <!-- Page Content -->
<div id="page-content-wrapper">
<div class="container-fluid">
                <?php include './php-owner/menu-toggle.php'; ?>
  <center class="lead my-3" id="no-bookings-msg">
        No bookings at the moment.
    </center>
        
        <center id="feedback"></center>
        
       <!--User show tenants table-->
       <div class="table-responsive mx-3 my-3">
        <table class="table table-bordered" id="bookings-table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Phone number</th>
                    <th>Email</th>
                    <th>Room Chosen</th>
                    <th>No sharing</th>
                    <th>Add</th>
                    <th>Cancel</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div> 
    <!-- Confirm delete Modal -->
    <div class="modal fade" id="confirmAddModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new tenant</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="add_dialog">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="confirm_add" data-dismiss="modal">Add</button>
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
</div>
</div>        <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->
        
    
</body>
</html>