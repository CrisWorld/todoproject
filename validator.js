function validator(){

}
validator.isEmail = (email) => {
    const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return  filter.test(email);
}
validator.checkEmail = (selector,descript) => {
    var element = document.querySelector(selector);
    var description = element.nextElementSibling;
    element.addEventListener('blur', () => {
        if (validator.isEmail(element.value)){
            if(element.classList.contains("failed")) element.classList.remove("failed");
            element.classList.add("successed");
            description.innerHTML = "";
        } else {
            if(element.classList.contains("successed")) element.classList.remove("successed");
            element.classList.add("failed");
            description.innerHTML = descript;
        }
    });
}
validator.checkLength = (selector,length = 8,descript) => {
    var element = document.querySelector(selector);
    var description = element.nextElementSibling;
    element.addEventListener('blur', () => {
        const elementlength = element.value.length;
        if(elementlength>=length){
            if(element.classList.contains("failed")) element.classList.remove("failed");
            element.classList.add("successed");
            description.innerHTML = "";
        } else {
            if(element.classList.contains("successed")) element.classList.remove("successed");
            element.classList.add("failed");
            description.innerHTML = descript;
        }
    });
}
validator.isSame = (selector,depselector,descript) => {
    var element1 = document.querySelector(selector);
    var element2 = document.querySelector(depselector);
    var description = element2.nextElementSibling;
    element2.addEventListener('blur', () => {
        if (element1.value.localeCompare(element2.value) == 0 && element1.value !== ""){
            if(element2.classList.contains("failed")) element2.classList.remove("failed");
            element2.classList.add("successed");
            description.innerHTML = "";
        }
        else {
            if(element2.classList.contains("successed")) element2.classList.remove("successed");
            element2.classList.add("failed");
            description.innerHTML = descript;
        }
    });
}