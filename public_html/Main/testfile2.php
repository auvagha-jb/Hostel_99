<?php
session_start();

//push($bool);

$a = 1;

$a -=1;

echo $a;

function push(&$bool){
    array_push($bool, "Hello from file 2 again");
}