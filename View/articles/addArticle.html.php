<?php

if (isset($_SESSION['user'])) {
    if ($_SESSION['banned'] === 'bannis') {
        header('LOCATION: ?c=home&a=banned');
    }
}
if (!isset($_SESSION['user']['username'])) {
    $alert = [];
    $alert[] = '<div class="alert-error">Vous devez vous connecter pour écrire un article !</div>';
    if (count($alert) > 0) {
        $_SESSION['alert'] = $alert;

    }
}
?>
<h2>Ajouter un article</h2>
<br>
<div class="addArticleForm">
    <form action="?c=home&a=add-article" method="post" class="form">
        <table>
            <tr>
                <td><label for="title">titre: </label></td>
                <td><input type="text" name="title" id="title" required></td>
            </tr>
            <tr>
                <td><label for="content">contenu: </label></td>
                <td><textarea name="content" id="content" required cols="60" rows="10"></textarea></td>
            </tr>
            <tr>
                <td><label for="author"></label></td>
                <td><input type="text" name="author" id="author" value="<?= $_SESSION['user']['username'] ?>" required
                           style="display: none"></td>
            </tr>
            <tr>
                <td><input type="submit" name="send" id="send" required></td>
            </tr>
        </table>
    </form>
</div>

