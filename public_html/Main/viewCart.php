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
    <title>Booking</title>
    <meta charset="utf-8">
    <?php 
    include './links.php';
    ?>
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
        
        #checkout{
            display: none;
        }
    </style>
    <script src="js/student-booking.js"></script>
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
            <th>Hostel</th>
            <th>No sharing</th>
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
        foreach($cartItems as $item){?>
        <?php
            $_SESSION['no_sharing'] = $item["no_sharing"]; 
        ?>
        <tr>
            <td><?php echo $item["hostel_name"]; ?></td>
            <td><?php echo $item["no_sharing"]; ?></td>
            <td><?php echo 'Ksh'.$item["price"]; ?></td>
            <td><input type="number" class="form-control text-center" value="<?php echo $item["qty"]; ?>" readonly="" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"></td>
            <td><?php echo 'Ksh'.$item["subtotal"]; ?></td>
            <td>
                <!--<a href="cartAction.php?action=updateCartItem&id=" class="btn btn-info"><i class="glyphicon glyphicon-refresh"></i></a>-->
                <a href="cartAction.php?action=removeCartItem&id=<?php echo $item["rowid"];?>" class="btn btn-danger" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
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
            $type= $_SESSION['type'];    
        ?>
        <tr>
            <?= '<td><a href="student-booking-page.php?id='.$hostel_no.'&hostel_name='.$hostel_name.'&type='.$type.'"'
                . 'class="btn btn-warning"><i class="fa fa-arrow-left"></i> Continue Booking</a></td>'; ?> 
            <td colspan="3"></td>
            <td><button id="pick_room" class="btn btn-success">Pick room <i class="fa fa-bed"></i></button></td>
        </tr>
    </tfoot>
    </table>
    <a class="btn btn-success" id="checkout">Checkout <i class="fa fa-arrow-right"></i></a>

<!--Assign room modal-->
    <div class="modal fade" id="pickRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Choose a room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body" id="pick-rm-dialog">
              <div class="row">
                  
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" id="no_sharing">
    <input type="hidden" id="gender">
</div>
   
    <script>
    $(document).ready(function(){
       //Onload... 
       var no_sharing = "<?php echo $_SESSION['no_sharing'];?>";
       var gender = "<?php echo $_SESSION['gender'];?>";
       
       $("#no_sharing").val(no_sharing);
       $("#gender").val(gender);
    });
    </script>
</body>
</html>