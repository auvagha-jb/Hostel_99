<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View</title>
    <link rel='shortcut icon' type="image/png" href="./img/hostel-logo.png">
    <?php include './links.php';?>
    <link rel="stylesheet" href="css/booking-page.css">
    <!--Generic-->
</head>
<body>
    <?php
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        $_SESSION['hostel_no'] = $_GET['id']; 
        $_SESSION['hostel_name'] = $_GET['hostel_name'];
    ?>
    
<!--Navigation bar-->
<?php include './nav-bar.php';?>
<?php include './php/connection.php';?>
<?php include_once './php-owner/owner-get-hostel-details.php';?>
<!--Hostel header-->
<div class="hostel-title">
    <h4><?php echo $hostel_name; ?></h4>
</div>

<!--Image Slider-->
<div id="slides" class="carousel slide" data-ride="carousel">
    <!-- The slideshow -->
    <?php include './php/carousel.php';?>
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#slides" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#slides" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<!--==Hostel Amenities==-->
<div class="hostel-description">
    <hr>
    <div id="about">
        <h4 class="text-muted">About this hostel</h4>
    </div>
    <p><?php echo $description; ?></p>
</div>

<!--==Hostel Amenities==-->
<div class="hostel-ammenities">
    <hr>
    <div class="col-sm-3">
    <span class="text-muted">
      <i class="fas fa-tv" aria-expanded="true"></i>
      Amenities
    </span>
    </div>
    <div class="col-sm-9">
        <div>
            <ul class="hostel-data">
                <?php include './php/get-amenities.php'?>
            </ul>
        </div>
    </div>
</div>

<!--==Hostel Rules==-->
<div class="hostel-rules">
    <hr>
    <div class="col-sm-3">
        <span class="text-muted">
          <i class="fas fa-check" aria-expanded="true"></i>
          House Rules
        </span>
    </div>
    <div class="col-sm-9">
        <div>
            <ul class="hostel-data">
                <?php include_once './php/get-rules.php';?>
            </ul>
        </div>
    </div>
</div>

<!--==Hostel Room pricing==-->
<div class="hostel-pricing">
    <hr>
    <div class="col-sm-3">
        <span class="text-muted">
          <i class="fas fa-money-bill-alt" aria-expanded="true"></i>
          Pricing
        </span>
    </div>
    <div class="col-sm-9">
        <div>
            <ul class="pricing-list">
                <?php
                    $room = new Hostels();
                    $result = $room->getRooms($con, $hostel_no);    
                    while($row = $result->fetch_array()){
                        echo '<li><strong>'.$row['no_sharing'].' Sharing </strong> Kshs. '.$row['monthly_rent'].' per month
                                <a href="cartAction.php?action=addToCart&id='.$row['hostel_no'].'&no='.$row['no_sharing'].'" style="margin-left:350px;margin-bottom:5px;" class="btn btn-success">
                                    <i class="fas fa-bookmark"></i>Book this room
                                </a>
                            </li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php include './footer.php';?>