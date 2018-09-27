<?php

include_once './php/connection.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

/*SELECT ->To display the tenants
     * 
     * Sample Query: 
     * SELECT * FROM users join user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id WHERE 
     * user_hostel_bridge.hostel_no = 1 AND users.user_status = "Tenant" AND users.user_type = "Student"   
     */
    
function showTableRows($con){
    
    $hostel_no = $_SESSION['hostel_no'];
    
    $select = 'SELECT * FROM users JOIN user_hostel_bridge ON users.user_id = user_hostel_bridge.user_id '
            . 'WHERE user_hostel_bridge.hostel_no = ? AND users.user_status = "Tenant" AND users.user_type = "Student" ';
    
    $stmt_3 = $con->prepare($select);
    $stmt_3->bind_param("s",$hostel_no);
    $stmt_3->execute();
    
    $result_3 = $stmt_3->get_result();
    if(mysqli_num_rows($result_3)<1){
        noTenantsMsg();
    }else{
        
        while($row = $result_3->fetch_array()){
            
            $name = $row['first_name']." ".$row['last_name'];
            $email = $row['email'];
            $phone_no = $row['phone_no'];
            $gender = $row['gender'];
            $room_assigned =$row['room_assigned'];  
            
            echo '
            <tr>
                <td>'.$name.'</td>
                <td>'.$email.'</td>
                <td>'.$phone_no.'</td>
                <td>'.$gender.'</td>
                <td>'.$room_assigned.'</td>
                <td><button type="button" class="btn btn-danger btn-sm remove-room" id="first_row"><i class="fa fa-minus-circle"></i></button></td>
            </tr>  
            ';
        }
        
//        header("location: owner-view-tenants.php?id=".$hostel_no." ");
    }
}
    
    
    function noTenantsMsg(){
        echo '
            <center class="lead my-3">
                No tenants added yet! Add them above.
            </center>
        ';
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>My tenants</title>
        <?php include_once './links.php';?>
        <link rel="stylesheet" href="css/owner-forms.css">
        <script src="js/add-tenants.js"></script>
    </head>
<body>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Gender</th>
                    <th>Room Assigned</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <?php showTableRows($con);?>
        </table>
    </div>
    
</body>
</html>