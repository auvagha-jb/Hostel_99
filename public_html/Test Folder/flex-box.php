<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Hostel 99</title>
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
        <script>
            $(document).ready(function(){
               flex_cards();
        
        
                function flex_cards(){
//                   $(".card-body").addClass("d-flex"); 
//                   $(".card-body").addClass("p-2");
               } 
               
//               $(".card-text").addClass("align-items-center");
//               $(".card").addClass("align-items-stretch");
               
               
            });
        </script>
	
        <!--Generic-->
        <link href="../Main/style.css" rel="stylesheet">
        <script src="../Main/js/main.js"></script>
</head>
<body>
    <!--- Cards -->
<div class="container-fluid padding">
    <div class="row padding">
        <div class="col-12">
            <div class="section-title">
                 <div class="display-4">Special Offers</div>
            </div>
        </div>
        <div class="col-md-4 d-flex p-2"> <!--Since it's changing at the 768px mark-->
            <div class="card">
                <img class="card-img-top" src="../Main/img/travelers-oasis.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Travelers oasis</h4>
                    <p class="card-text">
                        Located in Nairobi, within 8 km of Kenyatta International Conference Centre and 
                        10 km of Nairobi National Museum, Travelers oasis offers accommodation with a shared 
                        lounge. Located around 1.8 km from Century Cinemax Junction, the hostel is also 1.8 
                        km away from Junction Mall Nairobi. The property is a 17-minute walk from Adams 
                        Arcade Shopping Centre.
                    </p>
                    <a href="#" class="btn btn-outline-primary align-items-end">Book Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 d-flex p-2"> <!--Since it's changing at the 768px mark-->
            <div class="card">
                <img class="card-img-top" src="../Main/img/westlands-backpackers.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Westlands Backpackers</h4>
                    <p class="card-text">
                        Featuring a garden, Westlands Backpackers in Nairobi is set 3.5 km from Nairobi 
                        National Museum. Among the various facilities of this property are a terrace and a 
                        shared lounge. Kenyatta International Conference Centre is 5 km from the hostel.
                    </p>
                    <a href="#" class="btn btn-outline-primary align-items-end">Book Now</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 d-flex p-2"> <!--Since it's changing at the 768px mark-->
            <div class="card align-items-lg-stretch">
                <img class="card-img-top" src="../Main/img/KG-ladies-hostel.jpg"> <!--Since the image is at the top-->
                <div class="card-body">
                    <h4 class="card-title">Karen Gardens Ladies Hostel</h4>
                    <p class="card-text">
        Located in Nairobi, within 11 km of Kenyatta International Conference Centre and 12 km of Nairobi 
        National Museum, Karen Gardens Ladies Hostel offers accommodation with a garden, free WiFi. Boasting a 
        24-hour front desk, this property also provides students with a restaurant. The property is 2.8 km from 
        Hardy Shopping Centre Karen.
                    </p>
                    <a href="#" class="btn btn-outline-primary align-items-end">Book Now</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

</body>
</html>