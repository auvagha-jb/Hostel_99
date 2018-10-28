<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE>
<html>
    <head>
        <title>Search</title>
        <?php include './links.php';?>
        <script src="js/main.js"></script>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
    
    <?php include './nav-bar.php';?>
    
    <div class="container-fluid padding">
    <div class="row padding">
        <!--Since it's changing at the 768px mark-->
    <?php
    include './php/connection.php';
    
        if(isset($_POST['search_submit'])){
            
            //Get form data
            $location_home = $_POST['location_home'];
            $hostel_type = $_POST['hostel_type'];
            $max_price = $_POST['max_price'];
           
            //reinitialize hostel_type  --->The query will get all hostels that are NOT opposite gender 
            if($hostel_type == "male"){
                $opposite = "female";
            }else {
               $opposite = "male"; 
            }
            
            //SELECT hostels.hostel_no, hostels.hostel_name, hostels.image, hostels.description, hostels.location, hostels.road, MIN(rooms.monthly_rent) AS monthly_rent, 
            //MAX(rooms.no_sharing) AS no_sharing 
            //FROM hostels JOIN rooms ON hostels.hostel_no = rooms.hostel_no WHERE location = "Nairobi" AND monthly_rent <= 10000 AND NOT type = "male" 
            //OR county = "Nairobi" AND monthly_rent <= 10000 AND NOT type = "male" OR road = "Nairobi" AND monthly_rent <= 10000 AND NOT type = "male" 
            //GROUP BY hostels.hostel_no ORDER BY rooms.monthly_rent 

            //First query
            $query = 'SELECT hostels.hostel_no, hostels.hostel_name, hostels.image, hostels.description, hostels.location, '
                    . 'hostels.road, hostels.vacancies, MIN(rooms.monthly_rent)AS monthly_rent, MAX(rooms.no_sharing) AS no_sharing, '
                    . 'hostels.type '
                    . 'FROM hostels JOIN rooms ON hostels.hostel_no = rooms.hostel_no '
                    . 'WHERE location = ? AND monthly_rent <= ? AND NOT type = ? AND hostels.blacklist = 0 '
                    . 'OR county = ? AND monthly_rent <= ? AND NOT type = ? AND hostels.blacklist = 0 '
                    . 'OR road = ? AND monthly_rent <= ? AND NOT type = ? AND hostels.blacklist = 0 '
                    . 'GROUP BY hostels.hostel_no ORDER BY rooms.monthly_rent';
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("sssssssss", $location_home, $max_price, $opposite,$location_home, $max_price, $opposite,$location_home, $max_price, $opposite);
            $stmt->execute();
            $result = $stmt->get_result();
            $no_results = mysqli_num_rows($result);
            
            
            //If at least one result is found 
            if($no_results>0){
                
                resultsFeedback($no_results);
                showCards($result);
                
            //If no result is found, and the user had selected Male or Female, try mixed
            }else{
                noResults();
            }
            
        }
        
        
        function resultsFeedback($no_results){
            echo '
                <div class="col-12">
                    <div class="section-title">
                         <div class="lead">'.$no_results.' results found</div>
                    </div>
                </div>
            ';
        }
        
        function showCards($result){
            while($row = $result->fetch_array()){
                
                $id = $row['hostel_no'];
                $hostel_name = $row['hostel_name'];
                $folder = "uploads/";
                $image = $row['image'];
                $description = $row['description'];
                $location = $row['location']; 
                $road = $row['road'];
                $monthly_rent = $row['monthly_rent'];
                $type = $row['type'];
//                $no_sharing = $row['no_sharing'];
                $vacancies = $row['vacancies'];
                $vacancy_msg;
                if($vacancies == 0){
                    $vacancy_msg = "FULLY BOOKED";
                }else{
                    $vacancy_msg = 'Vacancies <span class="border px-2">'.$vacancies.'</span>';  
                }
                
                echo '
                <div class="col-md-4 special-offers"> 
                    <div class="card">
                        <img class="card-img-top" src="'.$folder.$hostel_name."/".$image.'"> <!--Since the image is at the top-->
                        <div class="card-body">
                            <h4 class="card-title">'.$hostel_name.'</h4>
                            <p class="card-text">'.$road.', '.$location.'</p>
                            <p class="card-text">Rent from: Kshs '.$monthly_rent.' Per Month</p>
                            <p class="card-text">'.$vacancy_msg.'</p>
                            <a href="student-booking-page.php?id='.$id.'&hostel_name='.$hostel_name.'&type='.$type.'" class="btn btn-outline-primary">Book Now</a>
                        </div>
                    </div>
                </div>
                ';
                
            }
        }
        
        function noResults(){
            echo '
                <div class="lead m-auto pb-3">No results found! Try more general searches like counties(on Location) or Mixed(on Type)</div>
            ';
            include './search-form.php';
        }
    ?>
            
        </div>
    </div>
</body>
</html>