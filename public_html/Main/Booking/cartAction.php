<?php 
// initialize shopping cart class
include './Cart.php';
$cart = new Cart;

// include database configuration file
include './php/connection.php';
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
        $productID = $_REQUEST['id'];
        // get product details
        $query = $con->query("SELECT * FROM hostel WHERE hostel_id = ".$productID);
        $row = $query->fetch_assoc();
        $itemData = array(
            'id' => $row['hostel_id'],
            'name' => $row['hostel_name'],
            'price' => $row['unitprice'],
            'qty' => 1
        );
        
        $insertItem = $cart->insert($itemData);
        $redirectLoc = $insertItem?'./viewCart.php':'./student-booking-page.php';
        header("Location: ".$redirectLoc);
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
        $itemData = array(
            'rowid' => $_REQUEST['id'],
            'qty' => $_REQUEST['qty']
        );
        $updateItem = $cart->update($itemData);
        echo $updateItem?'ok':'err';die;
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
        $deleteItem = $cart->remove($_REQUEST['id']);
        header("Location: ./viewCart.php");
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['sessCustomerID'])){
        // insert order details into database
        $insertOrder = $con->query("INSERT INTO orders (customer_id, total_price, created, modified) VALUES ('".$_SESSION['sessCustomerID']."', '".$cart->total()."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')");
        
        if($insertOrder){
            $orderID = $con->insert_id;
            $sql = '';
            // get cart items
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
                $sql .= "INSERT INTO order_items (order_id, product_id, quantity) VALUES ('".$orderID."', '".$item['id']."', '".$item['qty']."');";
            }
            // insert order items into database
            $insertOrderItems = $con->multi_query($sql);
            
            if($insertOrderItems){
                $cart->destroy();
                header("Location: ./orderSuccess.php?id=$orderID");
            }else{
                header("Location: ./checkout.php");
            }
        }else{
            header("Location: ./checkout.php");
        }
    }else{
        header("Location: ./booking-page.php");
    }
}else{
    header("Location: ./booking-page.php"); 
}