<!DOCTYPE>
<html>
    <head>
        <title>Search</title>
        <?php include './links.php';?>
        <script src="js/main.js"></script>
        <link rel="stylesheet" href="css/forms.css">
    </head>
<body>
    
    <?php include './nav-bar.php';?>
    
    <div class="container-fluid padding">
    <div class="row padding">
        
    <?php
    include_once './php/connection.php';
    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }
    
        $user_id = $_SESSION['user_id'];
    
        $query = "SELECT * FROM `users` JOIN user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id "
                . "JOIN hostels ON hostels.hostel_no = user_hostel_bridge.hostel_no WHERE users.user_id = ?";
        
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $no_rows = mysqli_num_rows($result);
        
        if($no_rows>0){
            showHeader($result);
            showCards($result);
        }else{
            noHostelsMsg();
        }
        
        function showHeader($result){            
            echo '
                <div class="col-12">
                    <div class="section-title">
                         <div class="lead">My Hostels</div>
                    </div>
                </div>
            ';
            
        }
        
        function showCards($result){
            while($row = $result->fetch_array()){
                $folder = "uploads/";
                $image = $row['image'];
                
                $id = $row['hostel_no'];
                $hostel_name = $row['hostel_name'];
                $location = $row['location']; 
                $road = $row['road'];
                $type = $row['type'];
                $path = $folder.$hostel_name."/".$image;
                
                echo '
                <div class="col-md-4 special-offers"> 
                    <div class="card">
                        <img class="card-img-top" src="'.$path.'"> <!--Since the image is at the top-->
                        <div class="card-body">
                            <h4 class="card-title">'.$hostel_name.'</h4>
                            <p class="card-text">'.$road.', '.$location.'</p>   
                            <p><a class="btn btn-outline-dark card-btn" href="owner-view-tenants.php?id='.$id.'&type='.$type.'">View tenants</a>
                            <a class="btn btn-outline-dark card-btn" href="owner-view-bookings.php?id='.$id.'">View bookings</a></p>
                            <a href="owner-edit-hostel.php?id='.$id.'" class="btn btn-outline-primary card-btn">Edit details</a>
                            <a href="owner-add-images.php?hostel_name='.$hostel_name.'" class="btn btn-outline-primary card-btn">Edit photos</a>
                        </div>
                    </div>
                </div>
                ';
            }
        }
        
        function noHostelsMsg(){
            echo '
            <div class="lead m-auto pb-3">
                Nothing to see here yet!
                Add a hostel 
                    <a href="owner-add-hostel.php">here</a>
            </div>
            ';
        } 
        
    ?>    
        </div>
    </div>
</body>
</html>