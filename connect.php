<?php 
try {
    $conn = mysqli_connect("localhost","root","","todolist");
    echo "Successfully connected";
}
catch (Exception $e){
    die("Failed to connect $e");
}
?>