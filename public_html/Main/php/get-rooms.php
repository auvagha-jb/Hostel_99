<?php
//Connection in ../student.booking.php

$hostel_no = $_GET['id'];

$query = "SELECT * FROM rooms WHERE hostel_no = ? ORDER BY no_sharing";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $hostel_no);
$stmt->execute();

//Fetch results array and create a lookup object
$result = $stmt->get_result();


while($row = $result->fetch_array()){
    $no_sharing = $row['no_sharing'];
    $monthly_rent = $row['monthly_rent'];
    
    echo '<li><strong>'.$no_sharing.' sharing:</strong> Kshs. '.$monthly_rent.' per month</li>';
}