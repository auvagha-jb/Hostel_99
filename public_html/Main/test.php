<?php
include './php/connection.php';
include './php-owner/Classes/Hostels.php';


$test = new Hostels();
        
        $data = array(
          'rating' => 4,
           'review' =>'Quite good',
           'hostel_no' => '1',
            'user_id' => '10'
        );

        $test->notRated($con, $data);
