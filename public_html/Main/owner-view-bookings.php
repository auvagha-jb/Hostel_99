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
        <script src="js/bookings.js"></script>
    </head>
<body>

    <!--Navigation bar-->
    <?php include './nav-bar.php'; ?>
    
    <!--The session was started at the very start-->
        
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
                    <th>No sharing</th>
                    <th>Check-in date</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
    </div> 
    
</body>
</html>