<?php
include './php/connection.php';
include './php-owner/Classes/Hostels.php';
include './php/Classes/Users.php';


$hostel = new Hostels();
$user = new Users();
        
        $data = array(
          'rating' => 4,
           'review' =>'Quite good',
           'hostel_no' => '1',
            'user_id' => '10'
        );
        
        echo ceil(0.5);

        
