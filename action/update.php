<?php 
    include('connect.php');
    session_start();
    if (isset($_POST["pomodoroColor"]) && isset($_POST["shortBreakColor"]) && isset($_POST["longBreakColor"])
    && isset($_POST['pomodoro-value']) && isset($_POST['shortbreak-value']) && isset($_POST['longbreak-value']) 
    && isset($_POST['longbreakinterval'])
    ){
        $id = openssl_decrypt($_COOKIE['account'],"AES-128-CTR","account");
        $arr = array(
            "pomodoroColor" => "#".$_POST["pomodoroColor"],
            "shortBreakColor" => "#".$_POST["shortBreakColor"],
            "longBreakColor" => "#".$_POST["longBreakColor"],
            "pomodoro" => $_POST["pomodoro-value"],
            "shortbreak" => $_POST["shortbreak-value"],
            "longbreak" => $_POST["longbreak-value"],
            "longBreakInterval" => $_POST["longbreakinterval"],
            "id" => $id
        );
        $query = "UPDATE setting SET pomodoroColor = '".$arr['pomodoroColor']."',
                shortBreakColor = '".$arr['shortBreakColor']."',
                longBreakColor = '".$arr['longBreakColor']."',
                longBreakInterval = ".$arr['longBreakInterval'].",
                shortbreak = ".$arr['shortbreak'].",
                longbreak = ".$arr['longbreak'].",
                pomodoro = ".$arr['pomodoro']." ";
        if (isset($_POST['autostartbreak'])) $query .= ",autoStartBreak = ".$_POST['autostartbreak']." ";
        if (isset($_POST['autostartpomodoro'])) $query .= ",autoStartPomodoro = ".$_POST['autostartpomodoro']." ";
        if (isset($_POST['autochecktask'])) $query .= ",autoCheckTask = ".$_POST['autochecktask']." ";
        $query .= "WHERE id = ".$arr['id'];
        $result = mysqli_query($conn, $query);
        if ($result) {
            $_SESSION['isSaved'] = true;
        } else $_SESSION['isSaved'] = false;
    } else {
        $_SESSION['error'] = true;
    }
    header('Location: ../');
?>  