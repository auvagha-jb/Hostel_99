<?php

class Bookings{
    
    function getBookingsTable($con, $hostel_no){
        $query = "SELECT * FROM users JOIN bookings ON users.user_id = bookings.user_id WHERE hostel_no = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        //Fetch results array and create a lookup object
        $result = $stmt->get_result();

        return $result;
    }
    
    function getNoBooked($con, $hostel_no){
        $query = "SELECT COUNT(*)AS no_booked FROM users JOIN bookings ON users.user_id = bookings.user_id WHERE hostel_no = ?";

        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $hostel_no);
        $stmt->execute();

        //Fetch results array and create a lookup object
        $result = $stmt->get_result();
        
        $row = $result->fetch_array();
        return $row;
    }
    
    
    function delBooking($con, $user_id, &$error){
        $query = 'DELETE FROM `bookings` WHERE user_id = ?';
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $user_id);
        $bool = $stmt->execute();

        if(!$bool){
            array_push($error, $con->error);
        }
    }
}