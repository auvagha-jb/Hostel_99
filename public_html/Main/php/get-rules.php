<?php
//Connection in ../student.booking.php

$hostel_no = $_GET['id'];

$query = "SELECT * FROM rules WHERE hostel_no = ?";

$stmt = $con->prepare($query);
$stmt->bind_param("s", $hostel_no);
$stmt->execute();

//Fetch results array and create a lookup object
$result = $stmt->get_result();


while($row = $result->fetch_array()){
    $rule = $row['rule'];
    echo "<li>".$rule."</li>";
}