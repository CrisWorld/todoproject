function validator(){
    validator.rules.forEach(element => {
        const form = document.querySelector(element.selectorForm);
        let checked;
        form.addEventListener('submit',(e) =>{
            checked = true;
            e.preventDefault();
            element.constraints.forEach((constraint) => {
                if (!constraint[0](form)) {
                    checked = false;
                    return false;
                };
            });
            if (checked) {
                e.target.submit();
            }
        });
    });
    validator.rules.forEach(element => {
        const form = document.querySelector(element.selectorForm);
        let checked = true;
        element.constraints.forEach((constraint) => {
            const input = form.querySelector(constraint[1]);
            input.onblur = () => constraint[0](form);
        });
    });
}
validator.isEmail = (form,selector,descript) => {
    const element = form.querySelector(selector);
    const email = element.value;
    const filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var description = element.nextElementSibling;
    if (filter.test(email)) {
        if(element.classList.contains("failed")) element.classList.remove("failed");
        element.classList.add("successed");
        description.innerHTML = "";
        return true;
    } else {
        if(element.classList.contains("successed")) element.classList.remove("successed");
        element.classList.add("failed");
        description.innerHTML = descript;
        return false;
    }
}
validator.isAtLeast = (form,selector,length,descript) => {
    const element = form.querySelector(selector);
    var description = element.nextElementSibling;
    let elementlength = element.value.length;
    if(elementlength >= length){
        if(element.classList.contains("failed")) element.classList.remove("failed");
        element.classList.add("successed");
        description.innerHTML = "";
        return true;
    } else {
        if(element.classList.contains("successed")) element.classList.remove("successed");
        element.classList.add("failed");
        description.innerHTML = descript;
        return false;
    }
}
validator.isSame = (form,selector,depselector,descript) => {
    var element1 = form.querySelector(selector);
    var element2 = form.querySelector(depselector);
    var description = element2.nextElementSibling;
    element1.oninput = () => {
        element2.value = "";
        element2.classList.remove("failed");
        element2.classList.remove("successed");
        description.innerHTML = "";
    }
    if (element1.value.localeCompare(element2.value) == 0 && element1.value !== ""){
        if(element2.classList.contains("failed")) element2.classList.remove("failed");
        element2.classList.add("successed");
        description.innerHTML = "";
        return true;
    }
    else {
        if(element2.classList.contains("successed")) element2.classList.remove("successed");
        element2.classList.add("failed");
        description.innerHTML = descript;
        return false;
    }
}