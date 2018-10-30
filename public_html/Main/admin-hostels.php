<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15/10/2018
 * Time: 09:06
 */
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
        <a href="admin-home.php" class="w3-bar-item w3-button">Home</a>
        <a href="admin-users.php" class="w3-bar-item w3-button">Users</a>
        <a href="admin-hostels.php" class="w3-bar-item w3-button w3-text-teal">Hostels</a>
    </nav>
</div>

<div class="w3-main" style="margin-left:40px;margin-top:20px;">
    <div class="usersTable">
        <?php
        include 'php/connection.php';

        //Display table
        if ($result = $con->query("SELECT `hostel_name`, `description`, `location`, `type` FROM `hostels`")) {
            if ($result->num_rows > 0) {
                echo " <table class='w3-table-all w3-centered w3-hoverable'>";
                echo "<h2>Registered Hostels</h2>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Hostel Number</th>";
                echo "<th>Hostel Name</th>";
                echo "<th>Hostel Location</th>";
                echo "<th>Hostel Type</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['hostel_name'] ."</td>";
                    echo "<td>" . $row['location'] . "</td>";
                    echo "<td>" . $row['type'] . "</td>";
                    echo '<td><a href="hostel-delete.php?=id' . $row['hostel_name'] . '"><i class="far fa-trash-alt"></i></td>';
                    echo '<td><a href="hostel-suspend.php?=id1' . $row['hostel_name'] . '"><i class="fas fa-lock-open"></i></td>';
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
        }
        ?>
    </div>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

