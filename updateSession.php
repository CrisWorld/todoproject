<?php 
    include('./connect.php');
    session_start();
    if (isset($_POST["pomodoroColor"]) && isset($_POST["shortBreakColor"]) && isset($_POST["longBreakColor"])
    && isset($_POST['pomodoro-value']) && isset($_POST['shortbreak-value']) && isset($_POST['longbreak-value']) 
    && isset($_POST['longbreakinterval'])
    ){
        $arr = array(
            "pomodoroColor" => "#".$_POST["pomodoroColor"],
            "shortBreakColor" => "#".$_POST["shortBreakColor"],
            "longBreakColor" => "#".$_POST["longBreakColor"],
            "pomodoro" => $_POST["pomodoro-value"],
            "shortbreak" => $_POST["shortbreak-value"],
            "longbreak" => $_POST["longbreak-value"],
            "longBreakInterval" => $_POST["longbreakinterval"],
        );
        if (isset($_POST['autostartbreak'])) $query .= ",autoStartBreak = ".$_POST['autostartbreak']." ";
        if (isset($_POST['autostartpomodoro'])) $query .= ",autoStartPomodoro = ".$_POST['autostartpomodoro']." ";
        if (isset($_POST['autochecktask'])) $query .= ",autoCheckTask = ".$_POST['autochecktask']." ";
        $_SESSION["setting"]["pomodoroColor"] = "#".$_POST["pomodoroColor"];
        $_SESSION["setting"]["shortBreakColor"] = "#".$_POST["shortBreakColor"];
        $_SESSION["setting"]["longBreakColor"] = "#".$_POST["longBreakColor"];
        $_SESSION["setting"]["pomodoro"] = $_POST["pomodoro-value"];
        $_SESSION["setting"]["shortbreak"] = $_POST["shortbreak-value"];
        $_SESSION["setting"]["longbreak"] = $_POST["longbreak-value"];
        $_SESSION["setting"]["longBreakInterval"] = $_POST["longbreakinterval"];
        if (isset($_POST['autostartbreak'])) $_SESSION["setting"]["autoStartBreak"] = $_POST['autostartbreak'];
        if (isset($_POST['autostartpomodoro'])) $_SESSION["setting"]["autoStartPomodoro"] = $_POST['autostartpomodoro'];
        if (isset($_POST['autochecktask'])) $_SESSION["setting"]["autoCheckTask"] = $_POST['autochecktask'];
        header('Location: /todolist/');
    } else echo "<script> alert('Thất bại'); </script>"; 
?>  