<?php

class Rooms{
    public function getRoomDetails($con, $hostel_no, $no_sharing, &$error){
        $query = "SELECT * FROM rooms WHERE hostel_no = ? AND no_sharing = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $hostel_no, $no_sharing);
        $bool = $stmt->execute();

        if($bool == false){
            array_push($error, $con->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array();

        return $row;
    }
    
    //Get room details for that specific room
        function thisRoomDetails($con, $hostel_no, $room_assigned, &$error){
        
        $query = 'SELECT * FROM room_allocation WHERE hostel_no = ? AND room_no = ?';
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $hostel_no, $room_assigned);
        $bool = $stmt->execute();

        if($bool == false){
            array_push($error, $con->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array();

        return $row;
    }
}