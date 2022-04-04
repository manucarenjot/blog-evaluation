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
    if (passwordRepeat.value === "") {
        password.setCustomValidity("Cher sapologue veuillez entrer votre mot de passe")
    }
    else {
        passwordRepeat.setCustomValidity("");
    }
    if (passwordRepeat.value.length <= 5) {
        passwordRepeat.setCustomValidity(" Cher sapologue votre mot de passe doit contenir au minimum 5 caractères")
    }
    else {
        passwordRepeat.setCustomValidity("");
    }
    if (passwordRepeat.value !== password.value) {
        passwordRepeat.setCustomValidity(" Cher sapologue vos mot de passe doit être identiques")
    }
    else {
        passwordRepeat.setCustomValidity("");
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

let title = document.getElementById("title");
let content = document.getElementById("content");
let comment =document.getElementById("comment");

function checkArticle() {
    if (title.value === "") {
        title.setCustomValidity("Cher sapologue veuillez entrer votre titre")
    }
    else {
        title.setCustomValidity("");
    }
    if (title.value.length <= 5) {
        title.setCustomValidity(" Cher sapologue votre titre doit contenir au minimum 5 caractères")
    }
    else {
        title.setCustomValidity("");
    }

    if (content.value === "") {
        content.setCustomValidity("Cher sapologue veuillez entrer le texte de l'article")
    }
    else {
        content.setCustomValidity("");
    }

    if (content.value.length <= 10) {
        content.setCustomValidity(" Cher sapologue votre titre doit contenir au minimum 10 caractères")
    }
    else {
        content.setCustomValidity("");
    }

    if (comment.value === "") {
        comment.setCustomValidity("Cher sapologue veuillez entrer votre commentaire")
    }
    else {
        comment.setCustomValidity("");
    }
    if (comment.value.length <= 5) {
        comment.setCustomValidity(" Cher sapologue votre commentaire doit contenir au minimum 5 caractères")
    }
    else {
        comment.setCustomValidity("");
    }
}

password.addEventListener('keyup', checkForm)
mail.addEventListener('keyup', checkForm)
username.addEventListener('keyup', checkForm)
passwordRepeat.addEventListener('keyup', checkForm)

title.addEventListener('keyup', checkForm)
content.addEventListener('keyup', checkForm)
comment.addEventListener('keyup', checkForm)




const errorMessage = document.querySelector('.alert-error');

if(errorMessage) {
    setTimeout(() => errorMessage.remove(), 5000);
}

const succesMessage = document.querySelector('.alert-succes');

if(succesMessage) {
    setTimeout(() => succesMessage.remove(), 5000);
}
