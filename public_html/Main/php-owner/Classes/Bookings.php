<?php

class Bookings{
    function insertBooking($con, &$data, &$error){
        $user_id =$data['user_id']; $hostel_no = $data['hostel_no']; $no_sharing = $data['no_sharing'];//Set to id cause of the 
        
        $query = "INSERT INTO `bookings`(`user_id`, `hostel_no`, `no_sharing`) VALUES (?,?,?)";
        $stmt = $con->prepare($query);
        $stmt->bind_param("sss", $user_id, $hostel_no, $no_sharing);
        $bool = $stmt->execute();
        
        if(!$bool){
            array_push($error, $con->error);
        }
        $orderID = $stmt->insert_id;
       
        return $orderID;
    }
    
    
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
    
    function userBooked($con, $user_id, &$error){
        $query = 'SELECT * FROM bookings JOIN hostels ON bookings.hostel_no = hostels.hostel_no WHERE bookings.user_id = ?';
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $user_id);
        $bool = $stmt->execute();

        if(!$bool){
            array_push($error, $con->error);
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array();

        return $row;
    }
    
    function updateVacancies($con, &$hostel, &$room, &$user, &$error){
        //User data
        $gender = $user['gender'];

        //Hostels table
        $hostel_no = $hostel['hostel_no'];
        $total_occupied = $hostel['total_occupied'];
        $total_available = $hostel['total_available'];

        //Rooms table
        $no_sharing = $room['no_sharing'];
        $current_capacity = $room['current_capacity'];
        $gender_count = $room[$gender.'_count'];//Reinitialization done due to calculation


        /*
         * Do the increment on total occupied and current capacity
         */

        //Hostels table
        $total_occupied += 1;
        $vacancies = $total_available - $total_occupied; 

        //Rooms table
        $current_capacity += 1;
        $gender_count += 1;
        $block_gender = ceil($gender_count/$no_sharing)*$no_sharing;

        /*
         * UPDATE tables
         */

        //Hostels
        $query_1 = "UPDATE hostels SET total_occupied = ?, vacancies = ? WHERE hostel_no = ?";
        $stmt_1 = $con->prepare($query_1);
        $stmt_1->bind_param("sss", $total_occupied, $vacancies,$hostel_no);
        $bool_1 = $stmt_1->execute();

        if($bool_1 == false){
            array_push($error, $con->error);
        }


        //Rooms
        $query_2 = 'UPDATE rooms SET current_capacity = ?, '.$gender.'_count = ?, blocked_'.$gender.' = ? '
                . 'WHERE hostel_no = ? AND no_sharing = ?';
        $stmt_2 = $con->prepare($query_2);
        $stmt_2->bind_param("sssss", $current_capacity, $gender_count, $block_gender,$hostel_no, $no_sharing);
        $bool_2 = $stmt_2->execute();

        if($bool_2 == false){
            array_push($error, $con->error);
        }
    }


    function updateRooms($con, $this_room, $hostel, $data, &$error){
        //Get the current details for this room 
        $no_sharing = $data['no_sharing'];
        $hostel_no = $hostel['hostel_no'];

        $no_occupied = $this_room['no_occupied'];//Is incremented
        $room_no = $this_room['room_no'];

        /*
         * The math
         */
        $no_occupied += 1;
        $spaces = $no_sharing - $no_occupied;

        $query = 'UPDATE `room_allocation` SET `no_occupied`= ? ,`spaces`= ? '
            . 'WHERE room_no = ? AND hostel_no = ? ';
        $stmt = $con->prepare($query);
        $stmt->bind_param("ssss", $no_occupied, $spaces, $room_no, $hostel_no);

        $bool = $stmt->execute();

        if($bool == false){
            array_push($error, $con->error);
        }

    }
    
    function vacancyPresent(&$room, &$user, &$error){
        //User data
        $gender = $user['gender'];

        //Rooms table
        $no_sharing = $room['no_sharing'];
        $gender_count = $room[$gender.'_count'];
        $total = $room['total_capacity'];
        $blocked_m = $room['blocked_male'];
        $blocked_f = $room['blocked_female'];

        $spaces = $total - ($blocked_m + $blocked_f);

        /*
         * if condition 1 - Check if there are any rooms left to spare
         * if condition 2 - Check that there is space in the last room for that particular gender
         */
        if($spaces==0 && ($gender_count % $no_sharing) == 0){
            return false;
        }

        return true;
    }
    
    function tenantResidence($con, $user_id){    
        $query = 'SELECT * FROM user_hostel_bridge JOIN hostels ON user_hostel_bridge.hostel_no = hostels.hostel_no '
                . 'WHERE user_hostel_bridge.user_id = ?';
        $stmt = $con->prepare($query);
        $stmt->bind_param("s", $user_id);
        $stmt->execute();

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