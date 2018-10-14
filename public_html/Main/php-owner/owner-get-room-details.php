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
if(isset($_POST['action']) && $_POST['action'] == "get_rent"){
    
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

//Get the available rooms 
if(isset($_POST['action']) && $_POST['action'] == "get_available"){
    $wing = $_POST['gender']; //Because there is either a male or female wing
    $no_sharing = $_POST['no_sharing'];
    
    $data="";
    $query = 'SELECT * FROM `room_allocation` WHERE wing = ? AND no_sharing = ? AND spaces > 0 '
            . 'OR wing = ? AND no_occupied = 0';
    $stmt = $con->prepare($query);
    $stmt->bind_param("sss", $wing, $no_sharing, $wing);
    $stmt->execute();

    $result = $stmt->get_result(); 
    
    while($row = $result->fetch_array()){
        $no_occupied = $row['no_occupied'];
        $spaces = $row['spaces'];
        $room_no = $row['room_no'];
        $bg; 
        //Choose status message
        if($no_occupied == 0){
            $status = "Empty";
        }else{
            $status = "Room for ".$spaces;
        }
        
        //Choose background an
        if($no_occupied == 0){
            $bg = "bg-secondary";
        }else {
            if($wing == "male"){
                $bg = "bg-primary";
            }else{
                $bg= "bg-danger";
            }
        }
        
        $data.='
                <div data-dismiss="modal">
                    <div class="card text-white mx-3 my-3 '.$bg.'" id="'.$room_no.'">
                      <div class="card-header">Room '.$room_no.'</div>
                      <div class="card-body">
                          <div class="card-title">'.$status.'</div>
                      </div>
                    </div>
                </div>
                ';
    }
    echo $data;
}



