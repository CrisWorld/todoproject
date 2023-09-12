
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
        if(id == idt){
            if (collection[i].style.cssText === "color: red;") collection[i].removeAttribute('style');
            else collection[i].style = "color: red";
        }
    }

    const collect = document.getElementsByClassName("tt");
    for (var j = 0; j < collect.length ; j++) {
        const idtt = collect[j].getAttribute("tasktt");
        if(idtt == idt){
            if (collect[j].style.cssText == "text-decoration-line: line-through;") collect[j].removeAttribute('style'); 
            else collect[j].style = "text-decoration-line: line-through";
        }
    }
}
finishTask.currentTaskID = undefined;
finishTask.currentTas = undefined;

/// Update
function updateTask(element){
    let parentElement = element.parentElement.parentElement.parentElement.parentElement;
    const taskID = parentElement.getAttribute("taskID");
    let titleElement = parentElement.querySelector("#_title").innerHTML;
    let descriptionElement = parentElement.querySelector(".show-note").innerHTML;
    let currentTime = parentElement.querySelector('.currentTime').innerHTML;
    let finishTime = parentElement.querySelector('.finishTime').innerHTML;
    const task = {taskID, titleElement, descriptionElement, currentTime, finishTime};
    parentElement.outerHTML = `<form action="./action/updateTask.php" class="form-updateTask" id="form-updateTask" method="get" enctype="application/x-www-form-urlencoded" taskID="${taskID}">
    <div class="px-3">
        <input type="text" class="title mb-5" id="title" name="title" placeholder="What are you working on?" value="${titleElement}" required></input>
        <b>Est Pomodoros</b><br>
        <input type="number" class="est mb-3" id="estc" name="estc" required value="${currentTime}"> /
        <input type="number" class="est mb-3" id="est" name="est" required value="${finishTime}"><br>
        <span> <input type="text" id="note" name="note" class="note mb-2" placeholder="Some note" value="${descriptionElement}"> </span> <span> + Add Project <i class="fa-solid fa-lock"></i> </span>
    </div>
    <div class="btn-Form-addTask mt-4" style="display: block; height: 80px;">
        <button type="button" class="btn btn-dark me-3" style="float: left; margin-left: 20px;" onclick="deleteTask(${taskID})">Delete</button>
        <div style="float: right;">
            <button class="btn btn-light cancel" type="button">Cancel</button>
            <button type="button" class="btn btn-dark me-3" onclick="handleUpdateTask(${taskID})">Update</button>
        </div>
    </div>
</form>`;
    parentElement = document.querySelector(`form[taskID="${taskID}"]`);
    parentElement.querySelector('.cancel').onclick = () => {cancelTask(task);}
}
function deleteTask(taskID){
    const request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200){
            document.querySelector(`form[taskID="${taskID}"]`).outerHTML = ""; ///  xoa
            renderTotalTime();
        }
    }
    request.open("GET", "./action/deleteTask.php?taskID="+taskID, true);
    request.send();
}
function handleUpdateTask(taskID){
    const request = new XMLHttpRequest();
    const form = document.querySelector(`form[taskID="${taskID}"]`);
    console.dir(form);
    request.onreadystatechange = function() {
        if (request.readyState === 4 && request.status === 200){
            form.outerHTML = `
            <div id="show-task" class="show-task mt-3 d-flex " style="padding:0; position:relative;" onclick="chooseTask(${taskID})" taskID="${taskID}">
            <button class="btn-idTask" id="btn-idTask" taskID="${taskID}"></button>
            <div style="width: 95%; padding: 10px 10px 10px 30px;">
                <div class="d-flex w-100 justify-content-between">
                    <span>
                        <button id="btn-check"  ><i class="fa-solid fa-circle-check btncheck" onclick="finishTask(${taskID})" taskID="${taskID}"></i></button>
                        <b id="_title" class="tt" tasktt="${taskID}">${form.elements['title'].value}</b>
                    </span>
                    <div>
                    <span class="currentTime" id="currentTime" taskID="${taskID}">${form.elements['estc'].value}</span>
                    /
                        <span class="finishTime">${form.elements['est'].value}</span>
                        <button class="btn-vertical" id="test" onclick="updateTask(this)"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    </div>
                </div>
                <div class="show-note">${form.elements['note'].value}</div>
            </div>
        </div>`;
            renderTotalTime();
        }
    }
    request.open("GET", `./action/updateTask.php?id=${taskID}&title=${form.elements['title'].value}&est=${form.elements['est'].value}&note=${form.elements['note'].value}&estc=${form.elements['estc'].value}`, true);
    request.send();
}
function cancelTask(task){
    const form = document.querySelector(`form[taskID="${task.taskID}"]`);
    form.outerHTML = `
            <div id="show-task" class="show-task mt-3 d-flex " style="padding:0; position:relative;" onclick="chooseTask(${task.taskID})" taskID="${task.taskID}">
            <button class="btn-idTask" id="btn-idTask" taskID="${task.taskID}"></button>
            <div style="width: 95%; padding: 10px 10px 10px 30px;">
                <div class="d-flex w-100 justify-content-between">
                    <span>
                        <button id="btn-check"  ><i class="fa-solid fa-circle-check btncheck" onclick="finishTask(${task.taskID})" taskID="${task.taskID}"></i></button>
                        <b id="_title" class="tt" tasktt="${task.taskID}">${task.titleElement}</b>
                    </span>
                    <div>
                    <span class="currentTime" id="currentTime" taskID="${task.taskID}">${task.currentTime}</span>
                    /
                        <span class="finishTime">${task.finishTime}</span>
                        <button class="btn-vertical" id="test" onclick="updateTask(this)"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                    </div>
                </div>
                <div class="show-note">${task.descriptionElement}</div>
            </div>
        </div>`;
}
function renderTotalTime(){
    const currentTime = document.getElementById("totalCurrentTime");
    const finishTime = document.getElementById("totalFinishTime");
    const currentTimes = Array.from(document.getElementsByClassName("currentTime"));
    const finishTimes = Array.from(document.getElementsByClassName("finishTime"));
    let totalCurrentTime = 0;
    let totalFinishTime = 0;
    currentTimes.forEach(function (element,key){
        totalCurrentTime += parseInt(element.innerHTML);
        if (parseInt(element.innerHTML) > parseInt(finishTimes[key].innerHTML)){
            totalFinishTime += parseInt(element.innerHTML);
        } else totalFinishTime += parseInt(finishTimes[key].innerHTML);
    });
    currentTime.innerHTML = totalCurrentTime;
    finishTime.innerHTML = totalFinishTime;
}
