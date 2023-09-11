<?php 
    include './action/connect.php';
    if (isset($_GET['currentTime'],$_GET['taskID'])){
        $query = 'UPDATE tasks set currentTime = '.$_GET['currentTime'].' WHERE taskID = '.$_GET['taskID'];
        mysqli_query($conn, $query);
    }
?>