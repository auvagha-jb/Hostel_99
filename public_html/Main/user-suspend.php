<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30/10/2018
 * Time: 05:09
 */
//including the database connection file
include_once 'php/connection.php';

if (isset($_GET['id1'])) {


    $id = $_GET['id1'];

//deleting the row from table
    $stmt = $con->prepare("UPDATE users set user_status=0 where user_id = '$id' ");
    $stmt->bind_param("s", $id);
    $stmt->execute();

//redirect
    header("location:admin-users.php");
}

