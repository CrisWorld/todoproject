
// Handle evnet DOM
var setting = document.getElementById("form-setting");
var login = document.getElementById("form-login");
var signup = document.getElementById("form-signup");
var btnAddTask = document.getElementById("btn-addTask");
var task = document.getElementById("form-addTask");
var openbtn = document.getElementById("opensmallwindow");
// Cái này khi nhấn vào open của small window thì nó sẽ hiện ra 1 cửa sổ nhỏ
openbtn.addEventListener("click", (e) =>{
    e.preventDefault();
    let w= window.open("http://127.0.0.1:5500/index.html","","width=100,height=100");
    w.resizeTo(500,600);
});
// Đóng form setting
function closeSetting(){
    setting.style = "display: none";
}
// mở form setting
function openSetting(){
    setting.style = "display: inline-block";
}
// Đóng form login
function closeLogin(){
    login.style = "display: none";
}
// mở form login
function openLogin(){
    login.style = "display: inline-block";
    signup.style = "display: none";
}
// Đóng form Sign up
function closeSignup(){
    signup.style = "display: none";
}
// mở form Sign up
function openSignup(){
    login.style = "display: none";
    signup.style = "display: inline-block";
}
function openAddTask(){
    btnAddTask.style = "display: none";
    task.style = "display: block; margin: 20px auto";
}
function closeAddTask(){
    task.style = "display: none";
    btnAddTask.style = "display: inline-block";
}
var formSetting = document.getElementById("form-setting");
formSetting.onsubmit = (e) => {
    e.preventDefault();
    const rootStyle = window.getComputedStyle(document.documentElement);
    const pomodoroColor = rootStyle.getPropertyValue("--pomodoro").substring(1);
    const shortBreakColor = rootStyle.getPropertyValue("--shortbreak").substring(1);
    const longBreakColor = rootStyle.getPropertyValue("--longbreak").substring(1);
    document.getElementById('pomodoroColor').value=pomodoroColor;
    document.getElementById('shortBreakColor').value=shortBreakColor;
    document.getElementById('longBreakColor').value=longBreakColor;
    formSetting.submit();   
}
// Xử lý Event click vào checkbox
var listCheckbox = document.querySelectorAll(".checkbox");
listCheckbox.forEach((e) => {
    e.addEventListener("click",() => {
        if (e.value == 1) {
            e.value = 0;
        } else {
            e.value = 1;
        }
    })
});
///
// function checkCookie() {
//     var id= document.cookie;
//     if (id!="") {
//         alert("Success ! " +id);
//     } else {
//         alert("Fail !" );
//     }
// }
function chooseTask(x){
    var idtask = x;
    console.log("imple");
    const collection = document.getElementsByClassName("btn-idTask");
    for (var i = 0; i < collection.length ; i++) {
        const id = collection[i].getAttribute("taskID");
        if(id == idtask && chooseTask.currentTaskID != id){
            collection[i].style.display = "block";
            chooseTask.currentTaskID = id;
            document.cookie = "idtask=" + idtask;
        } else if (id == idtask && chooseTask.currentTaskID == id){
            chooseTask.currentTaskID = undefined;
            collection[i].style.display = "none";
           document.cookie = "idtask=" + ";path=/todolist;expires=Thu, 01 Jan 1970 00:00:01 GMT"; // Xóa cookie
        }
        else{
            collection[i].style.display = "none";
        }
    }
    // checkCookie();
}
chooseTask.currentTaskID = undefined;

const collect = document.getElementsByClassName("btn-vertical");
for (var i = 0; i < collect.length ; i++) {
    collect[i].addEventListener("click", (e) => {
        e.stopPropagation();
        }
    );
}
const collecti = document.getElementsByClassName("btncheck");
for (var i = 0; i < collecti.length ; i++) {
    collecti[i].addEventListener("click", (e) => {
        e.stopPropagation();
        }
    );
}


function finishTask(x){
    var idt = x;
    const collection = document.getElementsByClassName("btncheck");
    for (var i = 0; i < collection.length ; i++) {
        const id = collection[i].getAttribute("taskID");
        if(id == idt && finishTask.currentTaskID != id){
            collection[i].style = "color: red";
            finishTask.currentTaskID = id;
        } else if (id == idt && finishTask.currentTaskID == id){
            finishTask.currentTaskID = undefined;
            collection[i].style = "color:#33333384";
        }
        else{
            collection[i].style = "color:#33333384";
        }
    }

    const collect = document.getElementsByClassName("tt");
    for (var j = 0; j < collect.length ; j++) {
        const idtt = collect[j].getAttribute("tasktt");
        if(idtt == idt && finishTask.currentTas != idtt){
            collect[j].style = "text-decoration-line: line-through";
            finishTask.currentTas = idtt;
        } else if (idtt == idt && finishTask.currentTas == idtt){
            finishTask.currentTas = undefined;
            collect[j].style = "text-decoration: none";
        }
        else{
            collect[j].style = "text-decoration: none";
        }
    }
}
finishTask.currentTaskID = undefined;
finishTask.currentTas = undefined;