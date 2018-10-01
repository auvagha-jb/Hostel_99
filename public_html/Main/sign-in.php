<!DOCTYPE html>
<html>
    <head>
        <title>Sign in</title>
        <?php include './links.php';?>
        <link rel="stylesheet" href="css/forms.css">
        <script src="js/forms.js"></script>
    </head>
    <body class="sign-in">
    <!--Navigation bar-->
    <?php include './nav-bar.php';?>
    
    <!--Form-->
    <div class="container-fluid padding">
        <form method="post" action="php/sign-in-action.php" class="sign-in">
            
            <div class="lead form-text">Sign in</div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="text" name="email" id="email" class="form-control" required="">
                <div class="invalid-feedback">Invalid email address</div>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pwd" id="pwd" class="form-control" required="">
                <div class="invalid-feedback">Incorrect password</div>
            </div>
            <button class="btn btn-secondary">Sign in</button>
            
            <br>
            <small class="form-text">
                Don't have an account?<a href='sign-up.php'>Sign up</a>
            </small>
        </form>
        
    </div>
    
    
    
</body>
</html>
