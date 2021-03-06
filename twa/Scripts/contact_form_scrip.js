let emailExr = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

function addIncorrectClass(element) {
    element.classList.add("incorrectInput");
}

function removeIncorrectClass(element) {
    if (element.classList.contains("incorrectInput")) element.classList.remove("incorrectInput");
}

function checkClearStringById(id) {
    let element = document.getElementById(id);
    if (element.value.match(/\d+/g) != null) {
        this.addIncorrectClass(element);
        return false;
    }
    this.removeIncorrectClass(element);
    return true;
}

function checkFormValidity() {
    let enableSendButton = true;
    if (!this.checkClearStringById("name")) enableSendButton = false;
    if (!this.checkClearStringById("surname")) enableSendButton = false;

    let element = document.getElementById("email");
    if (!emailExr.test(String(element.value).toLowerCase())) {
        this.addIncorrectClass(element);
        enableSendButton = false;
    } else {
        this.removeIncorrectClass(element);
    }

    element = document.getElementById("message");
    if (!element.value) {
        enableSendButton = false;
        this.addIncorrectClass(element);
    } else {
        this.removeIncorrectClass(element);
    }

    element = document.getElementById("send");
    if (enableSendButton && element.disabled) {
        element.classList.remove("errorEffect");
        element.classList.add("focusEffect");
        element.disabled = false;
    } else if (!enableSendButton && !element.disabled) {
        element.classList.remove("focusEffect");
        element.classList.add("errorEffect");
        element.disabled = true;
    }
}