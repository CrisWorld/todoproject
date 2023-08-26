var root = document.querySelector(":root");
function displayBtn(a,type = 'block'){
    a.style.display = type;
}
function hideBtn(a){
    a.style.display = 'none';
}
function timer(){

}
timer.setBtn = (selector) => {
    return document.getElementById(selector);
}
timer.setTime = (selector) => {
    return document.getElementById(selector);
}
timer.setProgress = (selector) => {
    return document.getElementById(selector);
}
// một số thuộc tính của timer 
timer.button = undefined;
timer.time = undefined;
timer.progress = undefined;
timer.myTimer = undefined;
timer.skipBtn = undefined;
timer.title = "Time to focus !";
// Method bắt đầu countdown
timer.startCount = function({currentTime,futureTime,percent}){
    const btn = timer.button;
    displayBtn(timer.skipBtn,'flex')
    if (!btn) {
        alert("button start selector not found");
        return false;
    }
    const time = timer.time;
    if (!time) {
        alert("clock selector not found");
        return false;
    }
    let progress = timer.progress;
    if (!progress) {
        alert("progress selector not found");
        return false;
    }
    btn.innerHTML = "Pause";
    timer.render(currentTime, futureTime, percent, {time, progress});
    var myTimer = setInterval(() => {
        currentTime+=1000;
        percent += (1000/futureTime)*100;
        timer.render(currentTime, futureTime,percent, {time, progress});
        if (currentTime === futureTime) {
            clearInterval(myTimer);
            if (timer.setting.currentMode == 1) timer.count += 1;
            timer.checkLongBreakInterval();
        } else { 
            btn.onclick = timer.pauseCount.bind(btn, {currentTime, futureTime, percent},myTimer);
        }
    },1000);
    timer.myTimer = myTimer;
    btn.onclick = timer.pauseCount.bind(btn, {currentTime, futureTime, percent}, myTimer);
}
// Method dùng để dừng countdown lại
timer.pauseCount = function({currentTime,futureTime,percent},myTimer){
    hideBtn(timer.skipBtn);
    const btn = timer.button;
    btn.innerHTML = "Start";
    clearInterval(myTimer);
    btn.onclick = timer.startCount.bind(btn,{currentTime, futureTime, percent});
}
// Method render ra thời gian countdown 
timer.render = function(currentTime, futureTime, percent, {time, progress}){
    const minutes = Math.floor((futureTime - currentTime)/60000);
    const seconds = Math.floor(((futureTime - currentTime) % 60000)/1000);
    if (progress) {
        progress.style = `background: linear-gradient(90deg, rgba(255,255,255,1) ${percent}%, rgba(0,0,0,1) ${percent}%);`;
    }
    if (minutes < 10) {
        time.innerHTML = "0" + minutes.toString() + ":";
    } else time.innerHTML = minutes.toString() + ":";
    if (seconds < 10) {
        time.innerHTML += "0" + seconds.toString();
    } else time.innerHTML += seconds.toString();
    document.title = time.innerHTML;
};

// hàm này thêm class active vào button mà người dùng đã bấm và xóa class active cũ đi
function addActive(e){
    addActive.currentActive.classList.remove("active");
    e.classList.add('active');
    addActive.currentActive = e;
}
// Lấy tất cả element có class là .nav-item (3 cái button Poromodo, short break, long break)
// và lắng nghe click của từng button nếu click vào thì ta chuyển chế độ
// vì người dùng nhấn vào nên nó không thể tự đổi start countdown được nên ta cho tham số
// thứ 2 của switchPage là true
var list = document.querySelectorAll('.nav-item');
list.forEach((item) =>{
    item.addEventListener('click', (e) => timer.switchPage(e.target, true));
});
// Vì mình đặt Poromodo làm active mặc định lên mình cho currentActive là List[0]
addActive.currentActive = list[0];
// Hàm render lại những gì thay đổi khi mà đổi chế độ
timer.switchPage = function(e, isFirstTime = false){
    hideBtn(timer.skipBtn);
    let title = document.getElementById('title');
    let mode = parseInt(e.getAttribute('mode'));
    timer.setting.currentMode = mode;
    addActive(e);
    clearInterval(timer.myTimer);
    timer.button.innerHTML = "START";
    timer.switchMode(mode, isFirstTime);
    if (mode === 1) timer.title = "Tập trung nào !";
    else timer.title = "Nghỉ ngơi chút nha";
    title.innerHTML = timer.title;
    root.style.setProperty("--color",timer.backgrounds[mode-1]);
}

// Method tùy chọn chế độ: 1. Pomodoro, 2. Short break, 3. Long break. Và isFirstTime để kiểm tra
// đó có phải lần đầu không. Vì lần đầu thì ta phải để cho người dùng tự bấm vào mới thực hiện đếm
// chớ không thể tự động đếm khi mới vào web được. chế độ tự động break là khi mà setting autoStart là true
timer.switchMode = (mode, isFirtTime = false) => {
    let setting = timer.setting;
    switch (mode) {
        case 1:
            timer.render(0, setting.pomodoro*60000, 0, {time: timer.time, progress: timer.progress});
            timer.button.onclick = timer.startCount.bind(this,{currentTime: 0,futureTime: setting.pomodoro*60000, percent: 0});
            if(setting.autoStartPomodoro == "1" && !isFirtTime) timer.button.onclick();
            break;
        case 2:
            timer.render(0, setting.shortbreak*60000, 0, {time: timer.time, progress: timer.progress});
            timer.button.onclick = timer.startCount.bind(this,{currentTime: 0,futureTime: setting.shortbreak*60000, percent: 0});
            if(setting.autoStartBreak == "1" && !isFirtTime) timer.button.onclick();
            break;
        case 3:
            timer.render(0, setting.longbreak*60000, 0, {time: timer.time, progress: timer.progress});
            timer.button.onclick = timer.startCount.bind(this,{currentTime: 0,futureTime: setting.longbreak*60000, percent: 0});
            if (setting.autoStartBreak == "1" && !isFirtTime) timer.button.onclick();
            break;
        default:
            alert("Failed to set count mode!");
    }
}
// method check xem thử đủ điều kiện để auto chuyển sang chế độ long break
timer.checkLongBreakInterval = function (){
    const setting = timer.setting;
    if (timer.count == parseInt(setting.longBreakInterval)) {
        timer.count = 0;
        setting.currentMode = 3;
        timer.switchPage(document.getElementById('3'));
    } else if (setting.currentMode == 1) {
        setting.currentMode = 2;
        timer.switchPage(document.getElementById('2'));
    } else {
        setting.currentMode = 1;
        timer.switchPage(document.getElementById('1'));
    } 
}
timer.skipTime = () => {
    clearInterval(timer.myTimer);
    if (timer.setting.currentMode == 1) timer.count += 1;
    timer.checkLongBreakInterval();
};
export default timer;