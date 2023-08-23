<?php 
    include('./connect.php');
    // echo $_POST['autostartbreak']."<br>";
    // echo $_POST['autostartpomodoro']."<br>";
    // echo $_POST['autochecktask']."<br>";
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
            "id" => "3"
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
        if ($result) header('Location: /todolist/');
    } else echo "<script> alert('Thất bại'); </script>"; 
?>  