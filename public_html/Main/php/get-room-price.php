<?php
include_once './connection.php';

if(isset($_POST['no_sharing'])){   
    
    $hostel_no = $_POST['hostel_no'];
    $no_sharing = $_POST['no_sharing'];
    
    $sql_price = "SELECT monthly_rent FROM rooms WHERE hostel_no = ? AND no_sharing = ?";

    $stmt = $con->prepare($sql_price);
    $stmt->bind_param("ss", $hostel_no, $no_sharing);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_object();
    
    $price = $row->monthly_rent;
    
    echo $price;
}