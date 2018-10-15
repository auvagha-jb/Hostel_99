<?php
include './php/connection.php';
include './php-owner/Classes/Hostels.php';
include './php/Classes/Users.php';


$hostel = new Hostels();
//$user = new Users();
        
        $data = array(
          'rating' => 4,
           'review' =>'Quite good',
           'hostel_no' => '1',
            'user_id' => '10'
        );
        
?>

<form method="post" action="php/get-gender.php">
    <input type="hidden" value="jerrybenjamin007@gmail.com" name="email">
    <input type="hidden" value="get_gender" name="action">
    <button type="submit">Test</button>
</form>

<form method="post" action="php-owner/owner-get-room-details.php">
    <input type="hidden" value="jerrybenjamin007@gmail.com" name="email">
    <input type="hidden" value="show_rooms" name="action">
    <button type="submit">Test</button>
</form>

        
