<?php

include_once './php/connection.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['hostel_no'])){
    showTableRows($con);
}

/*SELECT ->To display the tenants
     * 
     * Sample Query: 
     * SELECT * FROM users join user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id WHERE 
     * user_hostel_bridge.hostel_no = 1 AND users.user_status = "Tenant" AND users.user_type = "Student"   
     */
    
function showTableRows($con){
    
    $hostel_no = $_SESSION['hostel_no'];
    $data="";
    
    $select = 'SELECT * FROM users JOIN user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id '
            . 'WHERE user_hostel_bridge.hostel_no = ? AND users.user_status = "Tenant" AND users.user_type = "Student" '
            . 'ORDER BY room_assigned';
    
    $stmt_3 = $con->prepare($select);
    $stmt_3->bind_param("s",$hostel_no);
    $stmt_3->execute();
    
    $result_3 = $stmt_3->get_result();
    if(mysqli_num_rows($result_3)<1){
        echo '';
    }else{
        
        while($row = $result_3->fetch_array()){
            
            $user_id = $row['user_id'];
            $name = $row['first_name']." ".$row['last_name'];
            $email = $row['email'];
            $phone_no = $row['phone_no'];
            $gender = $row['gender'];
            $room_assigned =$row['room_assigned'];  
            
            $data.='
            <tr>
                <td>'.$user_id.'</td>
                <td>'.$name.'</td>
                <td>'.$email.'</td>
                <td>'.$phone_no.'</td>
                <td>'.$gender.'</td>
                <td>'.$room_assigned.'</td>
                <td><a href="#" class="btn btn-danger btn-sm remove-room" id="remove_tenant"><i class="fa fa-minus-circle"></i></a></td>
            </tr>  
            ';
            
        }
        
        echo $data;
    }
    
}
?>