<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
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
<body>

    <!--Navigation bar-->
    <?php include './nav-bar.php';?>
    
    <div class="container-fluid">
    <!--Form-->
    <div class="row">
        
        <div class="col-md-6 col-sm-12">
            <img src="img/team1.png" class="img-responsive sign-up-img" >
            <div class="btm-left display-4"><p>Join the H99 Community! <br>It's free for life</p></div>
        </div>
        
        <div class="col-md-6 col-sm-12">
            <div class="form-data">
                       
                <form action="php/sign-up-action.php" method="post" class="sign-up">
                     <h4 class="lead">Sign up</h4>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        <div class="form-group">
                            <label for='first_name'>First name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" required>
                        </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                            </div>
                         </div>
                     </div>
                     
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                        <div class="invalid-feedback">Email address already exists</div>
                    </div>
                                          
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pwd" id="pwd" class="form-control" required>
                        <div class="invalid-feedback" id="password-feedback"></div>
                    </div>
                     
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" required>
                        <div class="invalid-feedback">The passwords did not match</div>
                    </div>
                     
                    <div class="form-group">
                        <label>Phone Number</label>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <?php include './php/country-codes.php';?>
                            </div>

                            <div class="col-sm-6">
                                <input type="number" name="no" id="no" class="form-control" required>
                            </div>
                        </div>
                        <small class="form-small-text">e.g 0722 123 456 will be +254 722 123 456</small>    
                    </div>
                     
                     <div class="form-group">
                         <label for="gender">Gender</label>
                         <select name="gender" id="gender" class="form-control" required>
                             <option value="">...</option>
                             <option value="Male">Male</option>
                             <option value="Female">Female</option>
                         </select>
                     </div>
                     
                     <div class="form-group">
                         <label for="occupation">Occupation</label>
                         <select name="occupation" id="occupation" class="form-control" required>
                             <option value="">I am a...</option>
                             <option value="Student">Student</option>
                             <option value="Hostel Owner">Hostel Owner</option>
                         </select>
                     </div>
                     
                     <button type="submit" name="s-u-submit" id="s-u-submit" class="btn btn-primary">Join H99</button>
                </form>
            </div>
            
        </div>
        
    </div>
    
    </div>
    
</body>
</html>
