<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View</title>
    <link rel='shortcut icon' type="image/png" href="./img/hostel-logo.png">
    <?php include './links.php';?>
    <!--Generic-->
    <script src="./js/main.js"></script>
    <link rel="stylesheet" href="../css/">
</head>
<body>
<!--Navigation-->
<?php include './nav-bar.php';?>
<?php include './php/connection.php';?>
<?php include_once './php-owner/owner-get-hostel-details.php';?>

<!--Hostel header-->
<div class="hostel-title">
    <h4><?php echo $hostel_name; ?></h4>
</div>

<!--Image Slider-->
<div id="slides" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
        <li data-target="#booking-page-slides" data-slide-to="0" class="active"></li>
        <li data-target="#booking-page-slides" data-slide-to="1"></li>
        <li data-target="#booking-page-slides" data-slide-to="2"></li>
        <li data-target="#booking-page-slides" data-slide-to="3"></li>
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="uploads/Travelers%20Oasis/travelers-oasis.jpg">
        </div>
        <div class="carousel-item">
            <img src="uploads/Travelers%20Oasis/travelers-oasis-two.jpg">
        </div>
        <div class="carousel-item">
            <img src="uploads/Travelers%20Oasis/travelers-oasis-three.jpg">
        </div>
        <div class="carousel-item">
            <img src="uploads/Travelers%20Oasis/travelers-oasis-four.jpg">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#slides" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#slides" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>

<div class="hostel-description">
    <hr>
    <div id="about">
        <h4>About this hostel</h4>
    </div>
    <p><?php echo $description; ?></p>
</div>

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
                <!--        <li>Wifi</li>
                        <li>Shower</li>
                        <li>TV Room</li>
                        <li>24 Hours Security</li>
                        <li>Clean and constant water supply</li>
                        <li>Customer friendly and caring staff</li>
                        <li>Lunch (Weekend and Public Holidays)</li>
                        <li>Dining area</li>
                        <li>Laundry area</li>
                        <li>Breakfast and dinner</li>-->
            </ul>
        </div>
    </div>
</div>

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
                <!--        <li>No drugs</li>
                        <li>Any act of culminate in breach of peace and order, damage of property are prohibited</li>
                        <li>Visitors are not allowed in the compound after 6:00p.m</li>
                        <li>Gates closed at 10 pm on weekdays and 11 pm on weekends</li>-->
                <?php include_once './php/get-rules.php';?>
            </ul>
        </div>
    </div>
</div>

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
                $query = $con->query("SELECT * FROM hostel WHERE status = 1");
                if($query->num_rows > 0){
                    while($row = $query->fetch_assoc()){
                        ?>
                        <li><strong><?php echo $row['hostel_name']; ?>:</strong> Kshs. <?php echo $row['unitprice']?> per month
                            <a href="cartAction.php?action=addToCart&id=<?php echo $row['hostel_id']?>" style="margin-left:350px;margin-bottom:5px;" class="btn btn-success"><i class="fas fa-bookmark"></i> Book this hostel</a>
                        </li>
                    <?php } }else { ?>
                        
                    <p>Product(s) not found.....</p>
                <?php }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php include './footer.php';?>
<?php include './php/connection.php';?>