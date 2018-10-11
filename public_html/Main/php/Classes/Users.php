<?php

class Users{
    function getData($con,$user_id){
        $query = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("s",$user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $row = $result->fetch_array();
        return $row;
    }
    
    //Checks whether the users is currently a tenant -->Note data is an array
    function presentTenant($con,$data){
        $query = "SELECT * FROM users JOIN user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id "
                . "WHERE users.user_id = ? AND hostel_no = ? AND user_status = 'Tenant'";
        $stmt= $con->prepare($query);
        $stmt->bind_param("ss", $data['user_id'],$data['hostel_no']);
        $stmt->execute();

       $result = $stmt->get_result();
        if(mysqli_num_rows($result)>0){
            return true;
        }
        return false;
    }
    
    //Checks whether the users was a tenant at a certain point  and had not been blacklisted
    function pastTenant($con, $user_id){
        $query = "SELECT * FROM users JOIN tenant_history_bridge ON users.user_id = tenant_history_bridge.user_id "
                . "JOIN tenant_history ON tenant_history_bridge.record_id = tenant_history.record_id "
                . "JOIN hostels ON tenant_history.hostel_no = hostels.hostel_no "
                . "WHERE users.user_id = ? AND tenant_history.blacklist = 0";
        $stmt= $con->prepare($query);
        $stmt->bind_param("s",$user_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if(mysqli_num_rows($result)>0){
            return true;
        }
        return false;
    }
    
    
    function updateDetails($con, $data){
        $query = 'UPDATE `users` SET `first_name`= ?,`last_name`= ?,`email`= ? , `country_code`= ? ,'
                . '`phone_no`= ?  WHERE user_id = ?';
        $stmt= $con->prepare($query);
        $stmt->bind_param("ssssss", $data['first_name'],$data['last_name'], $data['email'],$data['country_code'],
                $data['phone_no'],$data['user_id']);
        $stmt->execute();
        
    }
    
}