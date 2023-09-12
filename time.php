<?php
    include('./action/connect.php');

    function caculateEst(){
        global $conn; 
        $caculateEst = 0;
        $sql = "SELECT finishTime, currentTime FROM tasks WHERE userID = ".$_SESSION['id'];
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            if($row['currentTime'] < $row['finishTime']){
                $caculateEst = $caculateEst + $row['finishTime'] - $row['currentTime'];
            }
        }
        return $caculateEst;
    }
    function currentTime(){
        global $conn; 
        $caculate = 0;
        $sql = "SELECT currentTime FROM tasks WHERE userID = ".$_SESSION['id'];
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            $caculate = $caculate + $row['currentTime'];
        }
        return $caculate;
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
            $totalEst = caculateEst();
            $floored = floor($totalEst/$kq['longBreakInterval']);
            $totalShortBreak = $totalEst - $floored;
            if ($floored > 0 && $totalShortBreak > 0)
                $new = $time_stamp + $totalEst*$kq['pomodoro']*60 + ($totalShortBreak)*$kq['shortbreak']*60 + ($floored - 1)*$kq['longbreak']*60;
            else if ($floored == 0 && $totalShortBreak > 0)
                $new = $time_stamp + $totalEst*$kq['pomodoro']*60 + ($totalShortBreak - 1)*$kq['shortbreak']*60;
            else if ($floored == $totalEst && $totalEst != 0)
                $new = $time_stamp + $totalEst*$kq['pomodoro']*60 + ($floored - 1)*$kq['longbreak']*60;
            else
                $new = $time_stamp;

        }
        echo date('h:i', $new);
    }

?>
