<?php 
    require("connect.php");
    if (isset($_GET['taskID'])){
        $taskID = $_GET['taskID'];
        $sql = "DELETE FROM `tasks` WHERE `taskID` = '$taskID'";
        $result = mysqli_query($conn, $sql);
    }
?>