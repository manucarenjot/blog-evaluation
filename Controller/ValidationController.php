<?php
class ValidationController extends AbstactController
{
    public function index()
    {
        $this->render('user/validation');
        if (isset($_GET[$_SESSION['codeValidate']]) and isset($_GET[$_SESSION['user']['username']])) {
            UserManager::validateMail();
        }
    }
}