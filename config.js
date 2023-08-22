import timer from './timer.js';
import color from './color.js';
var root = document.querySelector(":root");
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
timer.backgrounds = ["rgba(165, 42, 42, 0.864)","rgb(20, 30, 70, 0.864)", "rgb(68, 80, 105, 0.864)"];
// Chế độ mặc định là pomodoro
timer.switchMode(1,true);


// Config Color

// 3 màu mặc định của trình duyệt
color.states = {
    pomodoro: "black",
    shortbreak: "blue",
    longbreak: "green",
}
// config 1 mảng chứa 3 cái buttons màu trong setting form
color.stateBtn = [document.getElementById("pomodoro-color")
,document.getElementById("shortbreak-color")
,document.getElementById("longbreak-color")];
// Render 3 màu của states cho 3 button màu trong setting 
(function renderState(){
    for(let state in color.states){
        root.style.setProperty(`--${state}`, color.states[state]);
    }
})();