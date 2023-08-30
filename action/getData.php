<?php
    include('connect.php');
    function getData($id){
        global $conn;
        global $data;
        $query = "SELECT * FROM setting where id = $id";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) != 0) {
            $data = mysqli_fetch_array($result);
            return true;
        } else {
            $query = "insert into setting
            values ($id, 25, 5, 10, 0, 0, 0, 2, '#313866', '#313866', '#C8AE7D');";
            if (!($result = mysqli_query($conn, $query))) echo "<script>alert('Error');</script>";
            else {
                $query = "SELECT * FROM setting where id = $id";
                $result = mysqli_query($conn, $query);
                if ($result) $data = mysqli_fetch_array($result); else echo "<script>alert('Error');</script>";
                return true;
            }
        }
        return false;
    }
?>