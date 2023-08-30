<?php
    error_reporting(0);
    require('./connect.php');
    $data;
    function getData($id){
        global $conn;
        $query = "SELECT * FROM setting where id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            global $data;
            $data = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return true;
        }
        return false;
    }
?>