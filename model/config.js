import timer from './timer.js';
import color from './color.js';
import validator from './validator.js';

var root = document.querySelector(":root");
var rootStyle = window.getComputedStyle(document.documentElement);
// Cấu hình element;
timer.button = timer.setBtn("btn-start");
timer.time = timer.setTime('time');
timer.progress = timer.setProgress('navbar-separate1');
timer.count = 0;
timer.skipBtn = document.getElementById('btn-skip');
timer.sound = document.getElementById("bell");
window.addEventListener("click", () => {
    timer.sound.pause();
});

// cấu hình setting
timer.setting = {
    pomodoro: document.getElementById("pomodoro-value").value,
    shortbreak: document.getElementById("shortbreak-value").value,
    longbreak: document.getElementById("longbreak-value").value,
    longBreakInterval: document.getElementById("longbreakinterval").value,
    autoStartBreak: document.getElementById("autostartbreak").value,
    autoStartPomodoro: document.getElementById("autostartpomodoro").value,
    autoCheckTasks: document.getElementById("autochecktask").value,
    pomodoroColor: rootStyle.getPropertyValue('--pomodoro'),
    shortBreakColor: rootStyle.getPropertyValue('--shortbreak'),
    longBreakColor: rootStyle.getPropertyValue('--longbreak'),
    currentMode: 1
}
// Cấu hình những background (theme) color.
timer.backgrounds = [timer.setting.pomodoroColor,timer.setting.shortBreakColor, timer.setting.longBreakColor];
// Chế độ mặc định là pomodoro  
timer.switchPage(document.getElementById('1'),true);

// config skip btn
document.getElementById('btn-skip').onclick = timer.skipTime;

// Config Color

// config 1 mảng chứa 3 cái buttons màu trong setting form
color.stateBtn = [document.getElementById("pomodoro-color")
,document.getElementById("shortbreak-color")
,document.getElementById("longbreak-color")];


// validator

validator.rules = [
    {
        selectorForm: "#form-login",
        constraints: [
            [
                (form) => validator.isEmail(form,'.email',"Không phải là Email !"),
                '.email'
            ],
            [
                (form) => validator.isAtLeast(form,'.password',8,"Mật khẩu cần tối thiểu 8 ký tự !"),
                '.password'
            ]
        ]
    },
    {
        selectorForm: "#form-signup",
        constraints: [
            [
                (form) => validator.isAtLeast(form,'#fullname',10, "Cần tối thiểu 10 ký tự !"),
                '#fullname'
            ],
            [
                (form) => validator.isEmail(form,'#email', "Không phải là Email !"),
                '#email'
            ],
            [
                (form) => validator.isAtLeast(form,'#password',8, "Mật khẩu cần tối thiểu 8 ký tự !"),
                '#password'
            ],
            [
                (form) => validator.isSame(form,'#password', '#confirm-password', "Mật khẩu xác nhận không hợp lệ"),
                '#confirm-password'
            ]
        ]
    }
]
validator();
