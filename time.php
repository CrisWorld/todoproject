<?php
    include('./action/connect.php');

    function caculateEst(){
        global $conn; 
        $caculateEst = 0;
        $sql = "SELECT currentTime FROM tasks WHERE userID = ".$_SESSION['id'];
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            $caculateEst = $caculateEst + $row['currentTime'];
        }
        return $caculateEst;
    }
    function finishTime(){
        global $conn; 
        $caculate = 0;
        $sql = "SELECT finishTime, currentTime FROM tasks WHERE userID = ".$_SESSION['id'];
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            if($row['currentTime'] > $row['finishTime']){
                $caculate = $caculate + $row['currentTime'];
            }
            else{
                $caculate = $caculate + $row['finishTime'];
            }
        }
        return $caculate;
    }

    function caculateTime(){
        global $conn;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $time = date('h:i');
        $time_stamp = strtotime($time);
        $sql = "SELECT pomodoro, shortbreak, longbreak, longBreakInterval FROM setting WHERE id = ".$_SESSION['id'];
        $qr = mysqli_query($conn, $sql);
        while($kq = mysqli_fetch_assoc($qr)){
            $floored = floor(caculateEst()/$kq['longBreakInterval']);
            $new = $time_stamp + caculateEst()*$kq['pomodoro']*60 + (caculateEst()-$floored - 1)*$kq['shortbreak']*60 + $floored*$kq['longbreak']*60;
        }
        echo date('h:i', $new);
    }

?>
