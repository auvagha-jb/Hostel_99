<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel 99</title>
        <?php include './links.php'; ?>       
        <!--Generic-->
	<link href="style.css" rel="stylesheet">
        <script src="js/main.js"></script>
</head>
<body>
<!--Navigation-->
<?php include './nav-bar.php';?>

<!--- Image Slider -->
    <div id="slides" class="carousel slide" data-ride="carousel">
        
        <!--Carousel indicators-->
        <ul class="carousel-indicators">
            <li data-target="#slides" data-slide-to="0" class="active"></li>
            <li data-target="#slides" data-slide-to="1"></li>
            <li data-target="#slides" data-slide-to="2"></li>
        </ul>
        
        <div class="carousel-inner">
           <!--Carousel Items-->
            <div class="carousel-item active">
                <img src="img/brown-bg.jpg" alt="" class="img-responsive">
                <div class="intro-carousel">
                    <div class="carousel-caption">
                        <h1 class="display-3">Welcome to Hostel 99!</h1>
                        <h3 class="display-4">The new way to find premium accommodation</h3>
                    <button type="button" class="btn btn-primary btn-lg" onclick='location.href="home.php#search-box"'>Get Started</button>
                    </div>
                </div>
            </div>
            
            <div class="carousel-item">
                <img src="img/students.jpg" alt="" class="img-responsive">
                <div class="carousel-caption">
                    <h1 class="display-3">Made for students</h1>
                </div>
            </div>

            <div class="carousel-item">
                <img src="img/students-reading.jpeg" alt="">
                <div class="carousel-caption">
                    <h1 class="display-3">Ease your college experience</h1>
                </div>
            </div>
          
<!--             Left and right controls -->
            <a class="carousel-control-prev" href="#slides" data-slide="prev">
              <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#slides" data-slide="next">
              <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>

  <!--- Jumbotron -->
    <div class="container-fluid">
        <div class="row jumbotron" id="search-box">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-xl-10">
                <p class="jumbotron-text"><!--Makes light weight text-->
                    The perfect hostel for you is just a few clicks away.
                </p>
            </div>
            <div class="m-auto">
                <form class="form-inline justify-content-center" method="post" id="search-form" action="student-search-hostel.php">
                        <input class="form-control mx-2" name="location_home" id="location_home" placeholder="Where would you like to stay?" required="">
                        <select class="form-control mx-2" name="hostel_type" id="hostel_type" required="">
                            <option value="">What Type?</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Mixed">Mixed</option>
                        </select>

                        <div class="input-group mx-2">
                            <input class="form-control" name="max_price" id="max_price" placeholder="Maximum Price?">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-primary form-control" name="search_submit" id="search_submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                </form>
        </div>
        </div>
    </div>
  
            



<!--- Three Column Section -->
<div class="container-fluid padding">
    <div class="partners">
        
        <!--Title-->
        <div class="col-12">
            <div class="section-title">
                <div class="display-4">
                    Our Esteemed Partners
                </div>
            </div>
        </div>
        
        <!--Partner logos-->
    <div class="row text-center-padding">
            <div class="col-xs-6 col-sm-6 col-md-3">
                <img src="img/partners/strathmore-university.jpg">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <img src="img/partners/uon-logo.png">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <img src="img/partners/jkuat.jpg">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <img src="img/partners/kenyatta-university_Logo.png">
            </div>    
    </div>
    </div> 
</div>

<hr class="my-4">
<!--- Two Column Section -->
 

    

<!--- Fixed background -->


<!--- Emoji Section -->

  
<!--- Meet the team -->


<!--- Cards -->
<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-12">
            <div class="section-title">
                 <div class="display-4">Special Offers</div>
            </div>
        </div>
        <div class="col-md-4 special-offers"> <!--Since it's changing at the 768px mark-->
            <div class="card">
                <img class="card-img-top" src="img/travelers-oasis.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Travelers oasis</h4>
                    <p class="card-text">
                        Located in Nairobi, within 8 km of Kenyatta International Conference Centre and 
                        10 km of Nairobi National Museum, Travelers oasis offers accommodation with a shared 
                        lounge. Located around 1.8 km from Century Cinemax Junction, the hostel is also 1.8 
                        km away from Junction Mall Nairobi. The property is a 17-minute walk from Adams 
                        Arcade Shopping Centre.
                    </p>
                    <a href="#" class="btn btn-outline-primary">Book Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 special-offers"> <!--Since it's changing at the 768px mark-->
            <div class="card">
                <img class="card-img-top" src="img/westlands-backpackers.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Westlands Backpackers</h4>
                    <p class="card-text">
                        Featuring a garden, Westlands Backpackers in Nairobi is set 3.5 km from Nairobi 
                        National Museum. Among the various facilities of this property are a terrace and a 
                        shared lounge. Kenyatta International Conference Centre is 5 km from the hostel.
                    </p>
                    <a href="#" class="btn btn-outline-primary">Book Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 special-offers"> <!--Since it's changing at the 768px mark-->
            <div class="card">
                <img class="card-img-top" src="img/KG-ladies-hostel.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Karen Gardens Ladies Hostel</h4>
                    <p class="card-text">
        Located in Nairobi, within 11 km of Kenyatta International Conference Centre and 12 km of Nairobi 
        National Museum, Karen Gardens Ladies Hostel offers accommodation with a garden, free WiFi. Boasting a 
        24-hour front desk, this property also provides students with a restaurant. The property is 2.8 km from 
        Hardy Shopping Centre Karen.
                    </p>
                    <a href="#" class="btn btn-outline-primary">Book Now</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<!--- Two Column Section -->


<!--- Connect -->


<!--- Footer -->
<?php include './footer.php';?>    

</body>
</html>