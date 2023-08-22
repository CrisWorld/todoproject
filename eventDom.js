
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
    task.style = "display: inline-block; margin: 20px 520px";
}
function closeAddTask(){
    task.style = "display: none";
    btnAddTask.style = "display: inline-block";
}
