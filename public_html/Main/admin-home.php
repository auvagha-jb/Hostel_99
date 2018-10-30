<?php
//dashboard for the admin
?>
<!DOCTYPE html>
<html>
<title>Hostel 99 Admin Panel</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src= "https://cdn.zingchart.com/zingchart.min.js"></script>
<script> zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9","ee6b7db5b51705a13dc2339db3edaf6d"];</script>
<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
    nav {
        margin-top: 5px;
        font-size: 20px;
        margin-right: 30px;
        padding-left: 30px;
    }
</style>

<!-- Navbar -->
<div class="w3-bar w3-border w3-black" style="height: 60px">
    <nav>
        <a href="admin-home.php" class="w3-bar-item w3-button w3-text-teal">Home</a>
        <a href="admin-users.php" class="w3-bar-item w3-button">Users</a>
        <a href="admin-hostels.php" class="w3-bar-item w3-button">Hostels</a>
    </nav>
</div>

<body>
<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:200px;margin-top:43px;">

    <!-- Header -->
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
    </header>

    <div class="w3-row-padding w3-margin-bottom">
        <div class="w3-quarter">
            <div class="w3-container w3-blue w3-padding-16">
                <div class="w3-left"><i class="fa fa-bed w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>
                        <?php
                        include_once 'php/connection.php';
                        $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM hostels"));
                        echo $count;
                        ?>
                    </h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Hostels</h4>
            </div>
        </div>
        <div class="w3-quarter">
            <div class="w3-container w3-orange w3-text-white w3-padding-16">
                <div class="w3-left"><i class="fa fa-users w3-xxxlarge"></i></div>
                <div class="w3-right">
                    <h3>
                        <?php
                        include_once 'php/connection.php';
                        $count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM users"));
                        echo $count;
                        ?>
                    </h3>
                </div>
                <div class="w3-clear"></div>
                <h4>Users</h4>
            </div>
        </div>
    </div>

    <br>
    <div class="w3-panel">
        <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-twothird" id="myChart">
                <?php
                include 'php/connection.php';

                $data=mysqli_query($con,"SELECT `hostel_name`, `total_available` FROM `hostels` ");
                ?>
            </div>
        </div>
    </div>

    <!-- End page content -->
</div>
</body>
<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
    var myData=[<?php
        while($info=mysqli_fetch_array($data))
            echo $info['total_available'].','; /* We use the concatenation operator '.' to add comma delimiters after each data value. */
        ?>];
    <?php
    $data=mysqli_query($con,"SELECT `hostel_name`, `total_available` FROM `hostels`");
    ?>
    var myLabels=[<?php
        while($info=mysqli_fetch_array($data))
            echo '"'.$info['hostel_name'].'",'; /* The concatenation operator '.' is used here to create string values from our database names. */
        ?>];

    window.onload=function(){
        zingchart.render({
            id:"myChart",
            width:"100%",
            height:400,
            data:{
                "type":"bar",
                "title":{
                    "text":"Hostels and their availability"
                },
                "scale-x":{
                    "labels":myLabels
                },
                "series":[
                    {
                        "values":myData
                    }
                ]
            }
        });
    };
</script>
</html>

