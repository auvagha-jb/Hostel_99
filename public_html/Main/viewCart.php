<?php
// initializE shopping cart class 
include './php/Classes/Cart.php';
$cart = new Cart;
if(session_status() == PHP_SESSION_NONE){
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Hostel99 - Bookings</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        h1 {
            color: white;
            font-family: Helvetica;
        }

        tr {
            color: white;
            font-family: Arial;
            font-size: 20px;
        }

        th {
            color: white;
        }

        .container {
            padding: 50px;
            background-image:url("./img/fruit1.jpg");
            min-width: 100%;
            height:800px;

            .topnav a:hover:before {
                visibility: visible;
                -webkit-transform:scaleX(1);
                transform: scaleX(1);
            }
        }

        input[type="number"] {
            width: 20%;
        }
    </style>
    <script>
    function updateCartItem(obj,id){
        $.get("./cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
            if(data == 'ok'){
                location.reload();
            }else{
                alert('Cart update failed, please try again.');
            }
        });
    }
    </script>
</head>

<body>
<div class="container">
<!-- Top links -->
<!--End top links-->
<br>
<br>
    <h1>Bookings</h1>
    <table class="table" style="color:black;">
    <thead>
        <tr>
            <th>Hostel Type</th>
            <th>Rent Price</th>
            <th>No. of units</th>
            <th>Subtotal</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if($cart->total_items() > 0){
            //get cart items from session
            $cartItems = $cart->contents();
            foreach($cartItems as $item){
        ?>
        <tr>
            <td><?php echo $item["name"]; ?></td>
            <td><?php echo 'Ksh'.$item["price"]; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo 'Ksh'.$item["subtotal"]; ?></td>
            <td>
                <!--<a href="cartAction.php?action=updateCartItem&id=" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></a>-->
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="glyphicon glyphicon-trash"></i></a>
            </td>
        </tr>
        <?php } }else{ ?>
        <tr><td colspan="5"><p>Your cart is empty.....</p></td>
        <?php } ?>
    </tbody>
    <tfoot>
        <?php
            $hostel_no = $_SESSION['hostel_no'];
            $hostel_name = $_SESSION['hostel_name'];
            
        ?>
        <tr>
            <?= '<td><a href="student-booking-page.php?id='.$hostel_no.'&hostel_name='.$hostel_name.'" class="btn btn-warning"><i class="glyphicon glyphicon-menu-left"></i> Continue Booking</a></td>'; ?> 
            <td colspan="2"></td>
            <?php if($cart->total_items() > 0){ ?>
            <td class="text-center"><strong>Total <?php echo 'Ksh'.$cart->total(); ?></strong></td>
            <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="glyphicon glyphicon-menu-right"></i></a></td>
            <?php } ?>
        </tr>
    </tfoot>
    </table>
</div>
</body>
</html>