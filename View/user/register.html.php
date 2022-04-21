<?php
if (isset($_SESSION['user'])) {
    header('LOCATION: ?c=home');
}
?>
<form action="?c=user&a=register" method="post" id="register">
    <table>
        <tr>
            <td><label for="username">Nom d'utilisateur :</label></td>
            <td><input type="text" name="username" id="username" required></td>
        </tr>
        <tr>
            <td><label for="mail">Adresse e-mail :</label></td>
            <td><input type="email" name="mail" id="mail" required></td>
        </tr>
        <tr>
            <td><label for="password">Password :</label></td>
            <td><input type="password" name="password" id="password" required></td>
        </tr>
        <tr>
            <td><label for="password-repeat">Password-repeat :</label></td>
            <td><input type="password" name="password-repeat" id="password-repeat" required></td>
        </tr>
        <tr>
            <td><input type="submit" name="send" id="password" required></td>
        </tr>
    </table>
</form>