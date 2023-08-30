const container = document.getElementById('message-inf');
container.addEventListener('click', (e) => {
    popMessage(e.target.getAttribute('index'));
});
function addMessage(message, type) {
    switch (type) {
        case 'success':
            container.innerHTML += `<div class="alert alert-success d-flex align-items-center" role="alert" index="${container.children.length}">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
            <div>
                ${message}
            </div>
            </div>`;
            setTimeout(() => popMessage(container.children.length-1), 1500);
            break;
        case 'information':
            container.innerHTML += `<div class="alert alert-primary d-flex align-items-center" role="alert" index="${container.children.length}">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
            <div>
                ${message}
            </div>
            </div>`;
            setTimeout(() => popMessage(container.children.length-1), 1500);
            break;
        case 'error':
            container.innerHTML += `<div class="alert alert-danger d-flex align-items-center" role="alert" index="${container.children.length}">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              ${message}
            </div>
            </div>`;
            setTimeout(() => popMessage(container.children.length-1), 1500);
            break;
        case 'warning':
            container.innerHTML += `<div class="alert alert-warning d-flex align-items-center" role="alert" index="${container.children.length}">
            <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
            <div>
              ${message}
            </div>
            </div>`;
            setTimeout(() => popMessage(container.children.length-1), 1500);
            break;
    }
}
function popMessage(index) {
    var element = container.querySelector(`div[index="${index}"]`);
    if (element) element.outerHTML = "";
}
