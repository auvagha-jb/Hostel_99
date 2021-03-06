<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View</title>
    <link rel='shortcut icon' type="image/png" href="src/img/hostel-logo.png">
    <?php include './links.php';?>
    <!--Generic-->
    <link href="css/style.css" rel="stylesheet">
    <script src="js/forms.js"></script>
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


  <!-- The slideshow -->
  <div class="carousel-inner">
      <?php //Set hostel_name session variable
    $_SESSION['hostel_name'] = $_GET['hostel_name'];

    if(session_status()==PHP_SESSION_NONE){
        session_start();
    }


      $folder = "uploads/";
      $hostel_name = $_SESSION['hostel_name']."/";
      
      $path = $folder.$hostel_name;
      
      if(file_exists($path)){
          
          $handle = opendir($path);
          $first = true;
          $counter = 0;

          while($file = readdir($handle)){
              if($file !=='.' && $file !== ".."){

              if($first){
                echo '
                 <div class="carousel-item active">
                    <img src="'.$folder.$hostel_name.$file.'">
                </div>
               ';

                $first = false;
              }  else {
                      echo '
                     <div class="carousel-item">
                        <img src="'.$folder.$hostel_name.$file.'">
                    </div>
                   ';
              }
              $counter++;
          }
          }
    }
      ?>
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
        <?php include './php/get-rooms.php';?>
      </ul>
    </div>
  </div>
</div>

<div class="book-panel-bar col-sm-3-offset">
  <hr>
  <div class="book-panel">
    <h4>Booking Details</h4>
    <p class="hostel-name">
      <span class="hostel-detail"><strong>Hostel:</strong></span>
      <?php echo $hostel_name; ?>
    </p>
    <p class="hostel-type">
      <span class="hostel-detail"><strong>Gender:</strong></span>
      <?php echo $type; ?>
    </p>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailsModal">
      <i class="fas fa-bookmark"></i>
      Book this hostel
    </button>

  <!--The Modal-->
    <div class="modal" id="detailsModal">
      <div class="modal-dialog">
        <div class="modal-content">

          <!--Modal Header-->
          <div class="modal-header">
            <h4 class="modal-title">Booking</h4>
            <button type="button" class="close" data-dismiss="modal">&times;
            </button>
          </div>

          <!--Modal Body-->
          <div class="modal-body">
            <form class="form-control">
              <label>Name:</label><br>
                <input class="form-control" type="text" required><br>
              <br>
              <br>
              <label>Email Address:</label><br>
                <input class="form-control" type="text" required>
              <br>
              <br>
              <label>
                Gender:</label><br>
                <select class="form-control">
                  <option value="female">Female</option>
                  <option value="male">Male</option>
                  <option value="other">Other</option>
                </select>
              <br>
              <br>
              <label>
                Phone Number:<br>
                <input class="form-control" type="number" required>
              </label>
              <br>
              <br>
              <!--Select list for rooms-->
              <?php include 'php/populate-room-select.php';?>
              <br>
              <label>Email Address:</label><br>
                <input class="form-control" type="text" required>
              <br>
            </form>
          </div>

          <!--Modal Footer-->
          <div class="modal-footer">
            <button type="submit" class="btn btn-success" data-dismiss="modal">Make Payment
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include './footer.php';?>