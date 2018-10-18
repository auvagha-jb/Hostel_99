<?php 
// initialize classes
include 'php/connection.php';
include './php/Classes/Cart.php';
include './php/Classes/Users.php';
require './php-owner/Classes/Hostels.php';//My generic class
require './php-owner/Classes/Rooms.php';//My generic class
require './php-owner/Classes/Bookings.php';//My generic class

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

    $users = new Users();
    $hostels = new Hostels();
    $rooms = new Rooms();
    $book = new Bookings();
    $cart = new Cart();
    $error = array();
 

// include database configuration file
include './php/connection.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        //Reset the cart to prevent multiple selection of items
        $cart->destroy();
        $hostel_no = $_REQUEST['id'];
        $no_sharing = $_REQUEST['no'];
        $_SESSION['no_sharing'] = $no_sharing;
        $data = array( 
            'hostel_no' => $hostel_no,
            'no_sharing' => $no_sharing
        );
        
        $row = $hostels->getRoomDetails($con,$data);
        
        $itemData = array(
            'hostel_name' => $_SESSION['hostel_name'],
            'no_sharing' => $no_sharing,
            'id' => $hostel_no."-".$row['no_sharing'],
            'name' => $row['no_sharing']." Sharing",
            'price' => $row['monthly_rent'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'./viewCart.php':'./student-booking-page.php';
        header("Location: ".$redirectLoc);
    }else if($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
        
    }else if($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: ./viewCart.php");
   
    }else if($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){
        
        $data = array(
            'user_id' => $_SESSION['user_id'],
            'hostel_no' => $_SESSION['hostel_no'],
            'no_sharing' => $_SESSION['no_sharing']
        );
        
        /*
        * Get the current hostel details -->methods from classes: Hostels and Rooms
        */
        $hostel_no = $data['hostel_no'];
        $no_sharing = $data['no_sharing'];
        $user_id = $data['user_id'];
        $room_chosen = $_POST['room_chosen'];
        
        $hostel = $hostels->getHostelDetails($con, $hostel_no, $error);
        $room = $rooms->getRoomDetails($con, $hostel_no, $no_sharing, $error);
        $user = $users->getData($con, $user_id);
        $this_room = $rooms->thisRoomDetails($con, $hostel_no, $room_chosen, $error);
    
        $cartItems = $cart->contents();
        foreach($cartItems as $item){
            $orderID = $book->insertBooking($con, $data, $error);              
        }

        if(isset($orderID)){
            $cart->destroy();
            //header("Location: ./orderSuccess.php?id=$orderID");
            echo 'Success! Uncomment - header';
        }else{
            echo $con->error;
            header("Location: ./checkout.php");
        }
    }else{
        header('Location: ./student-booking-page.php?id='.$row['id'].'&hostel_name='.$row['hostel_name'].'&type='.$row['type']);
    }
}else{
    header('Location: ./student-booking-page.php?id='.$row['id'].'&hostel_name='.$row['hostel_name'].'&type='.$row['type']); 
}