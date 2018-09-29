<?php
session_start();

push($bool);


function push(&$bool){
    array_push($bool, "Hello from file 2 again");
}