<?php
include_once './php/connection.php';
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        //Get the details about the hostel to populate the values with
        include_once './php-owner/owner-get-hostel-details.php'; 
        
    //values obtained from owner-get-hostel-details.php
        $_SESSION['hostel_name'] = $hostel_name;
        $_SESSION['hostel_no'] = $hostel_no;
        if(isset($image)){
            $_SESSION['prev_image_name'] = $image;
        }else{
            $_SESSION['prev_image_name'] = "";
        }    
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <?php include './links.php'; ?>
    <script src="js/owner-forms.js"></script>
    <title>Mock Hostel</title>
</head>
<body>
    <script>
    $(function(){
        $('.sidebar-nav a').not('#home-tab').addClass('border-bottom border-dark');
    });
</script>
    <?php include './nav-bar.php'; ?>
    <div id="wrapper" class="toggled">
        
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="nav flex-column sidebar-nav" id="myTab" role="tablist">
                <li class="sidebar-brand">
                  <a href="#" id="home-tab"><?= $row['hostel_name'];?></a>
                </li>
                <li>
                  <a class="active" id="community-tab" data-toggle="tab" href="#community" role="tab" aria-controls="community" aria-selected="true">
                      <i class="fas fa-users"></i> My Community</a>
                </li>
                <li>
                  <a class="" id="edit-details-tab" data-toggle="tab" href="#edit-details" role="tab" aria-controls="edit-details" aria-selected="false">
                     <i class="fa fa-pencil-alt"></i> Edit Details</a>
                </li>
                <li>
                  <a class="" id="edit-photos-tab" data-toggle="tab" href="#edit-photos" role="tab" aria-controls="edit-photos" aria-selected="false">
                     <i class="fa fa-camera"></i> Edit photos</a>
                </li>
              </ul>
                      </div>
                <!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <a href="#menu-toggle" class="btn btn-secondary" id="menu-toggle"><i class="fas fa-bars"></i></a>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="community" role="tabpanel" aria-labelledby="community-tab"><?php include './owner-community.php'; ?></div>
                    <div class="tab-pane fade" id="edit-details" role="tabpanel" aria-labelledby="edit-details"><?php include './owner-edit-hostel.php';?></div>
                    <div class="tab-pane fade" id="edit-photos" role="tabpanel" aria-labelledby="edit-photos"><?php include './owner-add-images.php';?></div>
                  </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

</body>

</html>
