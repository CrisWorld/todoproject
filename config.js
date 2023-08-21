import timer from './handleTimer.js';
// Cấu hình element;
timer.button = timer.setBtn("btn-start");
timer.time = timer.setTime('time');
timer.progress = timer.setProgress('navbar-separate1');
// cấu hình setting
timer.setting = {
    pomodoro: document.getElementById("pomodoro-value").value,
    shortbreak: document.getElementById("shortbreak-value").value,
    longbreak: document.getElementById("longbreak-value").value,
    longBreakInterval: document.getElementById("longbreakinterval").value,
    autoStartBreak: document.getElementById("autostartbreak").checked,
    autoStartPomodoro: document.getElementById("autostartpomodoro").checked,
    autoCheckTasks: document.getElementById("autochecktask").checked,
    pomodoroColor: "",
    shortBreakColor: "",
    longBreakColor: "",
    currentMode: 1,
}
// Cấu hình những background (theme) color.
timer.backgrounds = ["rgba(165, 42, 42, 0.864);","rgb(20, 30, 70, 0.864)", "rgb(68, 80, 105, 0.864)"];
// Chế độ mặc định là pomodoro
timer.switchMode(1,true);