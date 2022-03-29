

<form action="?c=home&a=add-article" method="post">
    <table>
        <tr>
            <td><label for="title">titre</label></td>
            <td><input type="text" name="title" id="title" required></td>
        </tr>
        <tr>
            <td><label for="content">contenu</label></td>
            <td><textarea name="content" id="content" required cols="80" rows="15"></textarea></td>
        </tr>
        <tr>
            <td><label for="author"></label></td>
            <td><input type="text" name="author" id="author" value="<?=$_SESSION['user']['username']?>" required style="display: none"></td>
        </tr>
        <tr>
            <td><input type="submit" name="send" id="send" required></td>
        </tr>
    </table>
</form>
