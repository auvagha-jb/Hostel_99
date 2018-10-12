<?php
 class Hostels{
     
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
    
    
    public function getRooms($con, $hostel_no){
        $query = "SELECT * FROM hostels JOIN rooms ON hostels.hostel_no = rooms.hostel_no WHERE hostels.hostel_no = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        $result = $stmt->get_result();
        
        return $result;
    }
    
    
    public function notRated($con, $data){
        $query = "SELECT * FROM ratings WHERE user_id = ? AND hostel_no = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ss", $data['user_id'],$data['hostel_no']);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        //If they had rated that hostel..
        if(mysqli_num_rows($result) > 0){
            return false;
        }
        
        return true;
    }
    
    
    public function countRated($con,$hostel_no){
        $query = "SELECT COUNT(*) AS no_ratings FROM `ratings` WHERE hostel_no = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_array();
        
        return $row['no_ratings'];
    }

 }
