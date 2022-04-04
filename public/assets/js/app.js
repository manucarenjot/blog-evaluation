let mail = document.getElementById('mail');
let password = document.getElementById('password');

function checkLogin() {
    if (mail.value === "") {
        mail.setCustomValidity("Veuillez entrer votre adresse e-mail");
    }
    else {
        mail.setCustomValidity("");
    }
    if (mail.value.indexOf("@", 0) < 0) {
        mail.setCustomValidity("Veuillez entrer une adresse e-mail valide");
    }
    else {
        mail.setCustomValidity("");
    }
    if (password.value === "") {
        password.setCustomValidity("Veuillez entrer votre mot de passe")
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
}

password.addEventListener('keyup', checkLogin)
mail.addEventListener('keyup', checkLogin)