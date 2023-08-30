<?php
    include('connect.php');
    session_start();

// Set the new timezone
date_default_timezone_set('Asia/Ho_Chi_Minh');
$time = date('h:i');
$time_stamp = strtotime($time);

$new = $time_stamp + 1*25*60;
echo date('h:i',$new);

function caculateEst(){
    $caculateEst = 0;
    $sql = "SELECT finishTime FROM tasks WHERE userID = ".$_SESSION['id'];
    $query = mysqli_query($conn, $sql);
    white($row = mysqli_fetch_array($query)){
        $caculateEst = $caculateEst + $row['finishTime'];
    }
    echo $caculateEst;
}


?>
