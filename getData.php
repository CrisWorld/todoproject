<?php
    error_reporting(0);
    require('./connect.php');
    $query = "SELECT * FROM setting where id = 3";
    $result = mysqli_query($conn, $query);
    $data = "";
    if (mysqli_num_rows($result) != 0) {
        global $data;
        $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
    } else die("No thing found");
?>