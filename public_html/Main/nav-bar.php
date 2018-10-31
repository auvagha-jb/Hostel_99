<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include_once './links.php'; ?>
    <link href="style.css" rel="stylesheet">
    <script src="js/nav-bar.js"></script>
    <script src="js/main.js"></script>
</head>
<body>
<?php
function toggleNav(){
    //If the user is logged in
    if(isset($_SESSION['user_id'])){
        $id= $_SESSION['user_id'];
        $first_name = $_SESSION['first_name'];
        $user_type = $_SESSION['user_type'];


        if($user_type == "Student"){
            echo '
                    <li class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#">'.$first_name.'</a>
                        <div class="dropdown-content">
                            <a class="nav-link" href="student-view-details.php">My Details</a>
                            <a class="btn btn-danger" href="php/logout.php">Sign out</a>
                        </div>
                    </li>
                    ';
        }else if($user_type == "Hostel Owner"){
            echo '
                <li class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle dropdown-toggle" href="#">My Hostels</a>
                        <div class="dropdown-content">
                            <a class="nav-link" href="owner-add-hostel.php">Add</a>
                            <a class="nav-link" href="owner-view-hostels.php">View</a>
                        </div>
                    </li>
                <li class="dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#">'.$first_name.'</a>
                    <div class="dropdown-content">
                        <a class="btn btn-danger" href="php/logout.php">Sign out</a>
                    </div>
                </li>
                ';
        }
    }else{
        echo '
            <li class="nav-item">
                <a class="btn btn-dark" href="sign-up.php">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="btn btn-outline-primary" href="sign-in.php">Sign in</a>
            </li>   
            ';
    }
}
?>
<!-- Navigation -->
<!--We're referencing md because that's the breakpoint-->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid"> <!--So it takes up 100% of the screen-->
        <a class="navbar-brand" href="#"><img src="img/hostel-logo.png" style="height: 60px; width: 60px;" alt="">Hostel 99</a>
        
        <!--Navigation button The id is here is generic-->
        <button type="button" class="navbar-toggler" id="nav-btn" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span><!--The nav button icon-->
        </button>

        <!--Class for collapsible nav bar-->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!--Pushes list items to the right as opposed to the middle at full width-->

            <ul class="navbar-nav ml-auto"> 
                <li class="nav-item">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php">Contact us</a>
                </li>
                <?php toggleNav(); ?>
            </ul>
        </div>
    </div>
</nav>
</body>
</html>