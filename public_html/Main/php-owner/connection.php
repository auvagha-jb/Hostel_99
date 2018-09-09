<?php

$host = "localhost"; $user = "root"; $pwd = ""; $db = "hostel_99";

$con = new mysqli($host, $user, $pwd, $db);

if(!$con){
    echo 'Connection error'.$con->connect_error;
}else{
    
}


