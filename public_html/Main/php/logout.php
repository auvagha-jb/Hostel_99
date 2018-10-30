<?php
session_start();

function alert($msg){
    echo '
    <script type="text/javascript">
        alert('.$msg.');
    </script>
    ';
}

session_unset();
session_destroy();


if(empty($_SESSION['user_id'])){
    alert("Logged out");
}

header("refresh:0.1; url=../sign-in.php");