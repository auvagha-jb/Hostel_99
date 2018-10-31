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
        <a href="admin-users.php" class="w3-bar-item w3-button w3-text-teal">Users</a>
        <a href="admin-hostels.php" class="w3-bar-item w3-button">Hostels</a>
        <a href="php/logout.php" class="w3-bar-item w3-button" style="float: right;">Logout</a>
    </nav>
</div>

<div class="w3-main" style="margin-left:40px;margin-top:20px;">
    <div class="usersTable">
        <?php
        include 'php/connection.php';

        //Display table
        if ($result = $con->query("SELECT `user_id`, `first_name`, `last_name`, `email`, `user_type`, `room_assigned`, user_status FROM `users`"
                . "WHERE NOT user_type = 'Admin' AND blocked = 0 ORDER BY user_type DESC ")) {
            if ($result->num_rows > 0) {
                echo " <table class='w3-table-all w3-centered w3-hoverable'>";
                echo "<h2>Registered Users</h2>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>User ID</th>";
                echo "<th>Name</th>";
                echo "<th>Email Address</th>";
                echo "<th>User Type</th>";
                echo "<th>Room Assigned</th>";
                echo "<th>Delete</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['first_name'] ." ".$row['last_name']. "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['user_type'] . "</td>";
                    echo "<td>" . $row['room_assigned'] . "</td>";
//                    echo '<td><a href="user-delete.php?id=' . $row['user_id'] . '"><i class="far fa-trash-alt"></i></td>';
                    echo '<td><a href="user-suspend.php?id1=' . $row['user_id'] . '"><i class="far fa-trash-alt"></i></td>';
                    echo "</tr>";
                }
            }
            echo "</tbody>";
            echo "</table>";
        }
        ?>
    </div>
</div>
<script>
        $('#suspend').click(function() {
            $('#suspend').toggle('1000');
            $("i", this).toggleClass("fas fa-lock");
        });
</script>
<!-- Footer -->
<!--<footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>-->
</html>


