<?php
include './connection.php';

  $hostel_no = $_GET['id'];
  $sql = "SELECT * FROM rooms WHERE hostel_no = ? ORDER BY no_sharing";

  $stmt = $con->prepare($sql);
  $stmt->bind_param("s", $hostel_no);
  $stmt->execute();

  $result = $stmt->get_result();

    echo " <label>Room-type: </label>";
    echo "<br>";
    echo "<select class='form-control' id='hostel_room_type'>";
    while ($row = $result->fetch_array()) { 
        echo "<option>".$row['no_sharing']." Sharing </option>" ;
    }
    echo "</select>";
    echo "<br>";
    echo "<br>";