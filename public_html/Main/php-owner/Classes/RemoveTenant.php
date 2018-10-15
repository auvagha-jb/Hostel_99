<?php
//Class containing functions that are exexuted when a tenant is removed
class RemoveTenant{
    
    function updateUsers($con, $user_id, &$error){
    
    $query = "UPDATE users SET user_status = NULL, room_assigned = NULL, no_sharing = NULL WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
    
    if(!isset($user_id)){
        array_push($error, "User ID is null");
    }
}

function updateHistory($con, $record_id, $date_checked_out, &$error){
    
    $query = "UPDATE tenant_history SET date_checked_out = ? WHERE record_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $date_checked_out, $record_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
}

function getRecordID($con, $user_id, &$error){
    $query = "SELECT * FROM user_hostel_bridge WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
    
    $result = $stmt->get_result();
    $row = $result->fetch_array();
    
    $record_id = $row['record_id'];
    
    return $record_id;
}

function deleteFromBridge($con, $user_id, &$error){
    
    $query = "DELETE FROM `user_hostel_bridge` WHERE user_id = ?";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $bool = $stmt->execute();

    if($bool == false){
        array_push($error, $con->error);
    }
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
    $total_occupied -= 1;
    $vacancies = $total_available - $total_occupied; 
    
    //Rooms table
    $current_capacity -= 1;
    $gender_count -= 1;
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
    $no_occupied -= 1;
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
    
}