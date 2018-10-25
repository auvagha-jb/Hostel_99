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
    $query = 'SELECT * FROM `room_allocation` WHERE wing = ? AND no_sharing = ? AND spaces > 0';
    $stmt = $con->prepare($query);
    $stmt->bind_param("ss", $wing, $no_sharing);
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


if(isset($_POST['action']) && $_POST['action'] == "show_rooms"){
    $query_1 = "SELECT no_sharing FROM rooms WHERE hostel_no = ?";
    $stmt_1 = $con->prepare($query_1);
    $stmt_1->bind_param("s", $hostel_no);
    $bool = $stmt_1->execute();
    $data = "";//What is to be echoed
    $result_1= $stmt_1->get_result();
    
    while($room = $result_1->fetch_array()){
        $no_sharing = $room['no_sharing'];
        
        if(isset($_POST['gender'])){//room information for a specific wing
            
            $wing = $_POST['gender'];    
            $query = 'SELECT COUNT(*) AS count FROM room_allocation WHERE spaces > 0 '
                    . 'AND wing = ? AND no_sharing = ? AND hostel_no = ?';
            $stmt = $con->prepare($query);
            $stmt->bind_param("sss", $wing, $no_sharing,$hostel_no);
            $bool = $stmt->execute();

            $result= $stmt->get_result();
            while($row = $result->fetch_array()){
                $count = $row['count'];
                echo'
                    <span class="lead inline-text mx-3">
                        '.$no_sharing.' Sharing:
                        <span class="border px-2">'.$count.'</span>
                    </span>
                        ';
            }
            
        }else{//General room information 
            $query = 'SELECT COUNT(*) AS count FROM room_allocation WHERE spaces > 0 '
                    . 'AND no_sharing = ? AND hostel_no = ?';
            $stmt = $con->prepare($query);
            $stmt->bind_param("ss",$no_sharing,$hostel_no);
            $bool = $stmt->execute();

            $result= $stmt->get_result();
            while($row = $result->fetch_array()){
                $count = $row['count'];
                echo'
                    <span class="lead inline-text mx-3 mx-3">
                        '.$no_sharing.' Sharing:
                        <span class="border border-dark px-2">'.$count.'</span>
                    </span>
                        ';
            }
        }
       
        
    }
    //echo $data;
}
