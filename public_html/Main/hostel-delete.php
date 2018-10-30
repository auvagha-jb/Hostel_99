<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01/07/2018
 * Time: 06:55
 */
//including the database connection file
include_once 'php/connection.php';

if (isset($_GET['id'])) {


    $id = $_GET['id'];

//deleting the row from table
    $stmt = $con->prepare("DELETE FROM hostels WHERE hostel_no='$id' LIMIT 1");
    $stmt->bind_param("s", $id);
    $stmt->execute();

//redirect
    header("location:admin-hostels.php");
}