// function pauseCount({currentTime, futureTime, percent, myTimer}) {
//     const btn = document.getElementById("start-btn");
//     btn.innerHTML = "Start";
//     clearInterval(myTimer);
//     btn.onclick = startCount.bind(btn,currentTime, futureTime, percent);
// }
// function startCount(currentTime = 0, futureTime = 10000, percent = 0) {
//     const btn = document.getElementById("start-btn");
//     btn.innerHTML = "Pause";
//     btn.onclick = pauseCount.bind(btn, {currentTime, futureTime, percent});
//     let time = document.getElementById("time");
//     let progress = document.getElementById("progress-bar");
//     var myTimer = setInterval(() => {
//         currentTime+=1000;
//         const minutes = Math.floor((futureTime - currentTime)/60000);
//         const seconds = Math.floor((futureTime - currentTime)/1000);
//         if (currentTime === futureTime) {
//             clearInterval(myTimer);
//             btn.innerHTML = "Start";
//             btn.onclick = startCount.bind(btn,0,10*1000,0);
//             console.log("Đã dừng");
//         } else { 
//             btn.onclick = pauseCount.bind(btn, {currentTime, futureTime, percent, myTimer});
//         }
//         percent += futureTime/1000;
//         progress.style = `background: linear-gradient(90deg, rgba(255,255,255,1) ${percent}%, rgba(0,0,0,1) ${percent}%);`;
//         if (minutes < 10) {
//             time.innerHTML = "0" + minutes.toString() + ":";
//         } else time.innerHTML = minutes.toString() + ":";
//         if (seconds < 10) {
//             time.innerHTML += "0" + seconds.toString();
//         } else time.innerHTML += seconds.toString();
            
//     },1000)
// }

function timer(){

}
timer.button = function(btnSelector){
    return document.getElementById(btnSelector) || undefined;
};
timer.startCount = function({currentTime,futureTime,percent,selector,selectorbtn}){
    const btn = timer.button(selectorbtn);
    if (!btn) {
        alert("button start selector not found");
        return false;
    }
    const time = document.getElementById(selector);
    if (!time) {
        alert("clock selector not found");
        return false;
    }
    const minutes = Math.floor((futureTime - currentTime)/60000);
    const seconds = Math.floor(((futureTime - currentTime) % 60000)/1000);
    btn.innerHTML = "Pause";
    let progress = document.getElementById("navbar-separate1");
    timer.render(minutes, seconds, percent, {time, progress});
    var myTimer = setInterval(() => {
        currentTime+=1000;
        const minutes = Math.floor((futureTime - currentTime)/60000);
        const seconds = Math.floor(((futureTime - currentTime) % 60000)/1000);
        percent += (1000/futureTime)*100;
        timer.render(minutes, seconds,percent, {time, progress});
        if (currentTime === futureTime) {
            clearInterval(myTimer);
            btn.innerHTML = "Start";
            btn.onclick = timer.startCount.bind(btn,{currentTime: 0,futureTime,percent: 0,selector, selectorbtn});
        } else { 
            btn.onclick = timer.pauseCount.bind(btn, {currentTime, futureTime, percent, selector, selectorbtn},myTimer);
        }
    },1000);
    btn.onclick = timer.pauseCount.bind(btn, {currentTime, futureTime, percent, selector, selectorbtn}, myTimer);
}
timer.pauseCount = function({currentTime,futureTime,percent,selector, selectorbtn},myTimer){
    const btn = timer.button(selectorbtn);
    btn.innerHTML = "Start";
    clearInterval(myTimer);
    btn.onclick = timer.startCount.bind(btn,{currentTime, futureTime, percent, selector, selectorbtn});
}
timer.render = function(minutes, seconds, percent, {time, progress}){
    if (progress) {
        progress.style = `background: linear-gradient(90deg, rgba(255,255,255,1) ${percent}%, rgba(0,0,0,1) ${percent}%);`;
    }
    if (minutes < 10) {
        time.innerHTML = "0" + minutes.toString() + ":";
    } else time.innerHTML = minutes.toString() + ":";
    if (seconds < 10) {
        time.innerHTML += "0" + seconds.toString();
    } else time.innerHTML += seconds.toString();
};