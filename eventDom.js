
// Handle evnet DOM
var setting = document.getElementById("form-setting");
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