<?php

 class Hostel_details{
     
    public function getHostelDetails($con, $hostel_no, &$error){
        $query = "SELECT * FROM hostels WHERE hostel_no = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $bool = $stmt->execute();

        if($bool == false){
            array_push($error, $con->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array();

        return $row;
    }
    
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
    
    public function getHostelInfo($con,$hostel_no){
       $query = "SELECT * FROM hostels JOIN rooms on hostels.hostel_no = rooms.hostel_no "
        . "JOIN rules ON rooms.hostel_no = rules.hostel_no "
        . "JOIN amenities ON amenities.hostel_no = rules.hostel_no "
        . "WHERE hostels.hostel_no = ? GROUP BY hostels.hostel_no";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array();
        
        return $row;
    }

 }
