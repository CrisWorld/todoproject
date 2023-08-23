var root = document.querySelector(":root");
function color(){

}
color.states = {
    pomodoro: "black",
    shortbreak: "blue",
    longbreak: "green",
}
color.stateBtn = [document.getElementById("pomodoro-color"),document.getElementById("shortbreak-color"),document.getElementById("longbreak-color")];
color.stateBtn.forEach( (btn) => {
    let state = btn.getAttribute("state");
    btn.onclick = () => {
        color.renderHTML(state);
        window.removeEventListener("click", listenClick);
        setTimeout(() => window.addEventListener("click",listenClick),100)
    };
});
color.options = ["#435334","#313866", "#C8AE7D","#E8FFCE","#A1CCD1","#FFD0D0","#F24C3D","#080202"];
color.container = document.getElementById("color-options");
function listenClick(e) {
    console.log(e.target);
    if (e.target !== color.container) color.container.style.display = "none";
    window.removeEventListener("click", listenClick);
}
color.renderHTML = (state) => {
    color.container.style.display = "flex";
    color.container.innerHTML = color.options.map((color,index) => {
        return `<div class='option' index=${index} style='background: ${color}'></div>`
    }).join("");
    color.pickUpColor(state);
}
color.pickUpColor = (state) => {
    let listBtns = color.container.querySelectorAll(".option");
    listBtns.forEach((option, index) => {
        option.onclick = () => {
            color.changeState(state, index);
            color.container.style.display = "none";
            color.container.innerHTML = "";
        };
    });
}
color.changeState = (state,index) => {
    color.states[state] = color.options[index];
    root.style.setProperty(`--${state}`, color.states[state]);
}
export default color