import timer from './timer.js';
import color from './color.js';
var root = document.querySelector(":root");
var rootStyle = window.getComputedStyle(document.documentElement);
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
    pomodoroColor: rootStyle.getPropertyValue('--pomodoro'),
    shortBreakColor: rootStyle.getPropertyValue('--shortbreak'),
    longBreakColor: rootStyle.getPropertyValue('--longbreak'),
    currentMode: 1,
}
// Cấu hình những background (theme) color.
timer.backgrounds = [timer.setting.pomodoroColor,timer.setting.shortBreakColor, timer.setting.longBreakColor];
// Chế độ mặc định là pomodoro
timer.switchMode(1,true);



// Config Color

// config 1 mảng chứa 3 cái buttons màu trong setting form
color.stateBtn = [document.getElementById("pomodoro-color")
,document.getElementById("shortbreak-color")
,document.getElementById("longbreak-color")];