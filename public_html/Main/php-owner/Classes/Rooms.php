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
}