<?php
//on form submission....
if(isset($_POST['no_sharing'])){
        
        //Find the number of items to insert
        $array_size = count($_POST['no_sharing']);
        
        $hostel_no = $_SESSION['hostel_no'];
        $hostel_capacity = 0;//To record the total number of people the hostel can hold
        
        for($count = 0; $count<$array_size; $count++){
            
            $query = "INSERT INTO `rooms`(`hostel_no`, `no_sharing`, `monthly_rent`, `room_limit`, `current_capacity`, `total_capacity`) "
                    . "VALUES(?,?,?,?,?,?)";
            
            //Get the form data
            $no_sharing = $_POST['no_sharing'][$count]; 
            $monthly_rent = $_POST['monthly_rent'][$count];
            $room_limit = $_POST['room_limit'][$count];
         
            $current_capacity = 0;
            $room_capacity = $no_sharing * $room_limit;
            $hostel_capacity = $hostel_capacity + $room_capacity; //This will get the grand total of available slots
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssssss", $hostel_no, $no_sharing, $monthly_rent, $room_limit, $current_capacity, $room_capacity);
            $bool = $stmt->execute();
            
            if(!$bool){
                array_push($error, $con->error);
            }
            
        }
        
        updateVacancies($con, $hostel_no ,$hostel_capacity, $error);
    }
    
    function updateVacancies($con, $hostel_no ,$hostel_capacity, &$error){
        
        $query = "UPDATE hostels SET total_available = ?, total_occupied = ?, vacancies = ? WHERE hostel_no = ?";
        
        $total_occupied = 0;
        $vacancies = $hostel_capacity - $total_occupied;
        
        $stmt = $con->prepare($query);
            $stmt->bind_param("ssss", $hostel_capacity, $total_occupied, $vacancies, $hostel_no);
            $bool = $stmt->execute();
            
            if(!$bool){
                array_push($error, $con->error);
            }
    }
    