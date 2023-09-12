<?php 
    require 'connect.php';
    if(isset($_GET['title'], $_GET['est'], $_GET['note'], $_GET['id'], $_GET['estc'])){
        $title = $_GET['title'];
        $est = $_GET['est'];
        $estc = $_GET['estc'];
        $note = $_GET['note'];
        $id = $_GET['id'];
        $query = "UPDATE tasks SET title = '$title', description = '$note', finishTime = $est, currentTime = $estc WHERE taskID = $id";
        $result = mysqli_query($conn, $query);
    }
    
?>