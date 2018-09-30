<?php 

include './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];

//Populate select box
if(isset($_POST['select'])){
    
    $query = "SELECT * FROM rooms WHERE hostel_no = ? ORDER BY no_sharing";

    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $hostel_no);
    $stmt->execute();

    $result = $stmt->get_result();

    $data="";
    //one
    while($row = $result->fetch_array()){
        $no_sharing = $row['no_sharing'];  
        $data .= '<option value="'.$no_sharing.'">'.$no_sharing.'</option>';
    }

    echo $data;
}

//Get monthly_rent
if(isset($_POST['no_sharing'])){
    
   $no_sharing = $_POST['no_sharing'];
    
   $query = "SELECT * FROM rooms WHERE hostel_no = ? AND no_sharing = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $hostel_no, $no_sharing);
    $stmt->execute();

    $result = $stmt->get_result(); 
    $row = $result->fetch_array();
    
    $monthly_rent = $row['monthly_rent'];
    
    echo $monthly_rent;
    
}

