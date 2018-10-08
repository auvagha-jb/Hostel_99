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
}