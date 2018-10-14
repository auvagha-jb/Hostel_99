<?php
include './connection.php';
include './Classes/Users.php';

$get = new Users();

if(isset($_POST['action']) && $_POST['action'] == "get_gender"){
    $email = $_POST['email'];
    $row = $get->getData($con,$email);
    if(isset($row['gender'])){
        echo $row['gender'];
    }
} 