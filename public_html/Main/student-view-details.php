<!DOCTYPE html>
<html>
    <head>
        <title>My Details</title>
         <link rel='shortcut icon' type="image/png" href="img/hostel-logo.png">
         <?php include './links.php';?>
        <link rel="stylesheet" href="css/forms.css">
        <script src="js/forms.js"></script>
    </head>
<body>

    <!--Navigation bar and other important pages-->
    <?php include './nav-bar.php';?>
    <?php include './php/connection.php'?>
    <?php include './php/Classes/Users.php'?>
    <?php include './php/get-student-details.php'?>
    
    <div class="container-fluid">
    <!--Form-->
    <div class="row">
        
        <div class="col-md-6 col-sm-12">
            <img src="img/background2.png" class="img-responsive sign-up-img" >
            <div class="top-left display-4"><p style="color: white;">Keep us up to date</p></div>
        </div>
        
        <div class="col-md-6 col-sm-12">
            <div class="form-data">                       
                <form action="#" method="post" class="sign-up">
                    <h4 class="lead">Sign up</h4>
                    
                    <div class="row">
                        <div class="col-md-6"> 
                        <div class="form-group">
                            <label for='first_name'>First name</label>
                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?= $first_name;?>" required>
                        </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" value="<?= $last_name;?>" required>
                            </div>
                         </div>
                     </div>
                     
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="email" id="email" class="form-control" required value="<?= $email;?>">
                        <div class="invalid-feedback">Email address already exists</div>
                    </div>
                        
                     
                    <div class="form-group">
                        <label>Phone Number</label>          
                            <div class="input-group">
                                <?php include './php/country-codes.php';?>
                                <div class="input-group-append">
                                    <input type="number" name="no" id="no" class="form-control" required>
                                </div>
                            </div>
                        <small class="form-small-text">e.g 0722 123 456 will be +254 722 123 456</small>    
                    </div>
                     <button type="submit" name="s-u-submit" id="s-u-submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            
        </div>
        
    </div>
    
    </div>
    <script>
    $(document).ready(function(){
       var country_code = "<?= $country_code;?>";
       var no = "<?= $phone_no; ?>";
        setPhoneNo(country_code,no);
       
       function setPhoneNo(country_code,no){
           $("#country_code").val(country_code);
           $("#no").val(no);
       }
       
    });
    </script>
    
</body>
</html>
