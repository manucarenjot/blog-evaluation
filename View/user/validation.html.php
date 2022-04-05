<?php
if (!isset($_SESSION['user'])) {
    $alert[] = '<div class="alert-error">Vous devez être connecté pour accéder à cette page !</div>';
    if (count($alert) > 0) {
        $_SESSION['alert'] = $alert;
    }
    header('LOCATION: ?c=home');
}
if (!isset($_SESSION['codeValidate'])) {
    $alert[] = '<div class="alert-error">votre lien de validation a expirer !</div>';
    if (count($alert) > 0) {
        $_SESSION['alert'] = $alert;
    }
    header('LOCATION: ?c=home');
}

