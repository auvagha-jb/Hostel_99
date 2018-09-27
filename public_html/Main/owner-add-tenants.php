<?php

include './php/connection.php';

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$hostel_no = $_SESSION['hostel_no'];

/*
 * Turn off autocommit
 */
$con->autocommit(false);

if(isset($_POST['email'])){
    
    $email = $_POST['email'];
    $room_assigned = $_POST['room_assigned'];
    /*
     * TABLES AFFECTED: users table, tenant_history table and user_hostel_bridge table 
     */
    
    
    /*
    * USERS table 
    */
    
    $select = "SELECT * FROM users WHERE email = ?";
    
    $select_stmt = $con->prepare($select); 
    $select_stmt->bind_param("s", $email);
    $select_stmt->execute();
    
    $select_rst  = $select_stmt->get_result();
    
    //If the user is found ...
    if(mysqli_num_rows($select_rst)>0){
    
        $get = $select_rst->fetch_array();
           
        $status = $get['user_status'];
        $user_id = $get['user_id'];
        $name = $get['first_name']." ".$get['last_name'];
        $user_type = $get['user_type'];

        
        /*Check status and user_hostel_bridge table to ensure they are not already a tenant in the current  
        nor in another hostel and that they are of "student" type */
       
        $result = checkIfTenant($con, $user_id); 
        $row = $result->fetch_array();
        
        $hostel_reg = $row['hostel_no'];
        $hostel_name = $row['hostel_name'];        
        
        if($status == "Tenant"){
            if($hostel_no != $hostel_reg && $hostel_reg !=""){
                echo $name." is still registered as a tenant in ".$hostel_name;
                exit();
            }else{
                echo $name." is already registered as a tenant in your hostel";
                exit();
            }
        }else if($user_type !="Student"){
            echo $name." is is not a student. User type: ".$user_type;
            exit();    
        }else{
            
            $error = array();
            
            //Change user_status from NULL to Tenant
            changeStatus($con, $email, $room_assigned, $error);
            
            //Insert data into respective tables: tenants_history and 
            insertQueries($con, $user_id, $hostel_no, $error);
            
            //Commit the queries if there were no errors encountered
            if(isset($error)){
                echo var_dump($error);
                $con->commit();
            }
            
        }
        
    }else{
        echo "User email does not exist";
        exit();
    }
    

}
    
function insertQueries($con, $user_id, $hostel_no, $error){
    
    /*
     * TENANT_HISTORY 
     */
    $record_id = get_id($con);
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_in = date('Y-m-d H:i:s');
    
    $insert_1 = "INSERT INTO `tenant_history`(`record_id`, `date_checked_in`) VALUES (?,?)";
    $stmt_1 = $con->prepare($insert_1);
    $stmt_1->bind_param("ss", $record_id, $date_checked_in);
    $bool = $stmt_1->execute();
    
    if($bool){
        array_push($error, "Works");
    }
    /*
     * USER_HOSTEL_BRIDGE table
     * INSERT user_id and hostel_no 
     */
    
    $insert_2 = "INSERT INTO user_hostel_bridge (hostel_no, user_id, record_id) VALUES(?,?,?)";
    $stmt_2 = $con->prepare($insert_2);
    $stmt_2->bind_param("sss", $hostel_no, $user_id, $record_id);
    $stmt_2->execute();
   
    //header("location:owner-view-tenants.php?id=".$hostel_no." ");
}

function changeStatus($con, $email, $room_assigned, $error){
    
    $query  = 'UPDATE users SET user_status = "Tenant", room_assigned = ? WHERE email = ?';
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $room_assigned, $email);
    $bool = $stmt->execute();
    
    if($bool){
        array_push($error, "Works");
    }
}

function get_id($con){
     $record_id = mt_rand();
    
    do{
        
        $select = "SELECT * FROM `tenant_history` WHERE record_id = ?";
        $stmt = $con->prepare($select);
        $stmt->bind_param("s", $record_id);
        $stmt->execute();
        
        $result = $stmt->get_result();
       
        $row_count = mysqli_num_rows($result);
        
    }while($row_count>0);
    
    return $record_id;
}

function checkIfTenant($con, $user_id){
    
    $query = 'SELECT * FROM user_hostel_bridge JOIN hostels ON user_hostel_bridge.hostel_no = hostels.hostel_no '
            . 'WHERE user_hostel_bridge.user_id = ?';
    $stmt = $con->prepare($query);
    $stmt->bind_param("s", $user_id);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    return $result;
}


