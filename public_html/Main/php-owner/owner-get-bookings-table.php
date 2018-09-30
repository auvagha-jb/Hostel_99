<?php

include './connection.php';
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['hostel_no'])){
   $hostel_no = $_SESSION['hostel_no'];
   $result = getBookings($con, $hostel_no);  
   
   $data=""; 
   
    while($row = $result->fetch_array()){
        $user_id = $row['user_id'];
        $name = $row['first_name']." ".$row['last_name'];
        $gender = $row['gender']; 
        $phone_no = $row['phone_no'];
        $email = $row['email'];
        $no_sharing = $row['no_sharing'];  
        $check_in_date = $row['check_in_date'];

        $data.='
        <tr>
            <td>'.$user_id.'</td>
            <td>'.$name.'</td>
            <td>'.$gender.'</td>
            <td>'.$phone_no.'</td>
            <td>'.$email.'</td>
            <td>'.$no_sharing.'</td>
            <td>'.$check_in_date.'</td>
            <td><a href="#" class="btn btn-danger btn-sm remove-room" id="remove_booking"><i class="fa fa-minus-circle"></i></a></td>
        </tr>  
        ';
    }
    
    
    echo $data;
   
}

function getBookings($con, $hostel_no){
    $query = "SELECT * FROM users JOIN bookings ON users.user_id = bookings.user_id WHERE hostel_no = ?";

    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $hostel_no);
    $stmt->execute();

    //Fetch results array and create a lookup object
    $result = $stmt->get_result();
    
    return $result;
        
}