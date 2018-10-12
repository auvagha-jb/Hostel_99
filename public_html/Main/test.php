<?php
include './php/connection.php';
include './php-owner/Classes/Hostels.php';


$g = new Hostels();

$g->getRooms($con, "1");