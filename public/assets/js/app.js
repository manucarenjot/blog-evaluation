let mail = document.getElementById('mail');
let password = document.getElementById('password');
let passwordRepeat = document.getElementById('password-repeat');
let username = document.getElementById('username');



function checkForm() {
    if (mail.value === "") {
        mail.setCustomValidity("Veuillez entrer votre adresse e-mail");
    }
    else {
        mail.setCustomValidity("");
    }
    if (mail.value.indexOf("@", 0) < 0) {
        mail.setCustomValidity("Cher sapologue veuillez entrer une adresse e-mail valide");
    }
    else {
        mail.setCustomValidity("");
    }
    if (password.value === "") {
        password.setCustomValidity("Cher sapologue veuillez entrer votre mot de passe")
    }
    else {
        password.setCustomValidity("");
    }
    if (password.value.length <= 5) {
        password.setCustomValidity(" Cher sapologue votre mot de passe doit contenir au minimum 5 caractères")
    }
    else {
        password.setCustomValidity("");
    }

    if (username.value === "") {
        username.setCustomValidity("Cher sapologue il vous faut un nom d'utilisateur")
    }
    else {
        username.setCustomValidity("");
    }
    if (username.value.length <= 2) {
        username.setCustomValidity(" Cher sapologue votre nom d'utilisateur doit contenir au minimum 5 caractères")
    }
    else {
        username.setCustomValidity("");
    }


}

password.addEventListener('keyup', checkForm)
mail.addEventListener('keyup', checkForm)
username.addEventListener('keyup', checkForm)