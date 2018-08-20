<!DOCTYPE html>
<html>
<head>
         <link rel='shortcut icon' type="image/png" href="img/hostel-logo.png">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
        
        <link rel="stylesheet" href="../Web Dev Tools/bootstrap-4.0.0-dist/css/bootstrap.min.css">
        <script src="../Web Dev Tools/Jquery/jquery-3.3.1.js"></script>
        <script src="../Web Dev Tools/popper.min.js"></script>
        <script src="../Web Dev Tools/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>
        <script src="../Web Dev Tools/all.js"></script>
        
        <link rel="stylesheet" href="style.css">
        <script src="js/main.js"></script>
</head>
<body>

    <!-- Navigation -->
<!--We're referencing md because that's the breakpoint-->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
    <div class="container-fluid"> <!--So it takes up 100% of the screen-->
        <a class="navbar-brand" href="#"><img src="img/hostel-logo.png" style="height: 15%; width: 15%;" alt="">Hostel 99</a>
        
        <!--Navigation button The id is here is generic-->
        <button type="button" class="navbar-toggler" id="nav-btn" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span><!--The nav button icon-->
        </button>
        
        <!--Class for collapsible nav bar-->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <!--Pushes list items to the right as opposed to the middle at full width-->
            <ul class="navbar-nav ml-auto"> 
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact-us.php">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-primary" href="sign-up.php">Sign up</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-dark" href="sign-in.php">Sign in</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</body>
</html>