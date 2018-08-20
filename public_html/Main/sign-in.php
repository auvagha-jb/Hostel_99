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

        <link rel="stylesheet" href="css/forms.css">
        <script src="js/forms.js"></script>
    </head>
    <body class="sign-in">

    <!--Navigation bar-->
    <?php include './nav-bar.php';?>
    
    <!--Form-->
    <div class="container-fluid padding">
        <form class="sign-in">
            
            <div class="lead">Sign in</div>
            <div class="form-group">
                <label>Username or Email</label>
                <input type="text" name="username" id="username" class="form-control" required="">
                <div class="invalid-feedback">Invalid username or email</div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" class="form-control" required="">
                <div class="invalid-feedback">Incorrect password</div>
            </div>
            <button class="btn btn-secondary">Sign in</button>
            
        </form>
        
    </div>
    
    
    
</body>
</html>
