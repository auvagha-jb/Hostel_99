<?php 
include './php-owner/connection.php';
require './php-owner/Classes/RemoveTenant.php';  //contains all the functions that are executed when a tenant is removed
include './php/Classes/Users.php';
include 'php-owner/Classes/Hostels.php'; //Gets hostel details
include './php-owner/Classes/Rooms.php';//Gets room details
require './php-owner/Classes/Bookings.php';//My generic class


$users = new Users();
$hostels = new Hostels();
$rooms = new Rooms();
$remove = new RemoveTenant();
$book = new Bookings();
$error = array();//Array to store any errors in query execution

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

$con->autocommit(false);

$hostel_no = $_SESSION['hostel_no'];

if(isset($_POST['user_id'])){
    
    $no_sharing = $_POST['no_sharing'];
    $room_assigned = $_POST['room_assigned'];
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    
     $data = array(
      'user_id'=> $user_id,
      'room_assigned' => $room_assigned,
      'no_sharing' => $no_sharing
    );
    
    //Get data from different tables
    $hostel = $hostels->getHostelDetails($con, $hostel_no, $error);
    $room = $rooms->getRoomDetails($con, $hostel_no, $no_sharing, $error);
    $this_room = $rooms->thisRoomDetails($con, $hostel_no, $room_assigned, $error);
    $user = $users->getData($con, $user_id);
    
    //Get the record id 
    $record_id = $remove->getRecordID($con, $user_id, $error);
    
    date_default_timezone_set('Africa/Nairobi');
    $date_checked_out = date('Y-m-d H:i:s');
    
    $error = array();
    
    //Update users table
    $remove->updateUsers($con, $user_id, $error);
    
    //Update tenant history table
    $remove->updateHistory($con, $record_id, $date_checked_out, $error);
    
    //Delete user_id from user_tenant_bridge
    $remove->deleteFromBridge($con, $user_id, $error);
    
    //Free up one slot on the database
    $remove->updateVacancies($con, $hostel, $room, $user, $error);
    
    //Update the room_allocation
    $remove->updateRooms($con, $this_room, $hostel, $data, $error);
    
    //Remove them from 
    $book->delBooking($con, $user_id, $error);
    
    if(count($error)==0){
        $con->commit();
        echo $name.' has been removed as a tenant';
    }else{
        echo var_dump($error);
    }
}
