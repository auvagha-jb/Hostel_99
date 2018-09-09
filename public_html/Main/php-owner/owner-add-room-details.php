<?php
if(isset($_POST['no_sharing'])){
        //on form submission....
        
        //Find the number of items to insert
        $array_size= count($_POST['no_sharing']);
        
        $hostel_no = $_SESSION['hostel_no'];
        
        for($count = 0; $count<$array_size; $count++){
            
            $query = "INSERT INTO `rooms`(`hostel_no`, `no_sharing`, `monthly_rent`, `total_occupants`, `no_rooms_occupied`,"
                    . " `room_limit`) VALUES(?,?,?,?,?,?)";
            
                     
            $no_sharing = $_POST['no_sharing'][$count]; 
            $monthly_rent = $_POST['monthly_rent'][$count];
            $total_occupants = $_POST['total_occupants'][$count];
            $no_rooms_occupied = $_POST['no_rooms_occupied'][$count];
            $room_limit = $_POST['room_limit'][$count];
            
            
            $stmt = $con->prepare($query);
            $stmt->bind_param("ssssss", $hostel_no, $no_sharing, $monthly_rent, $total_occupants, $no_rooms_occupied, $room_limit);
            $stmt->execute();
            
        }
        
        $result = $stmt->get_result();
            
            if(isset($result)){
                echo 'ok';
            }
        
    }