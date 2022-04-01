<div style="text-align: center">
    <p><b>Êtes vous sur de vouloir supprimer votre compte utilisateur ?</b></p>

    <form action="?c=user&a=delete&id=<?= $_SESSION['user']['id'] ?>" method="post" style="display: inline">
        <input type="number" name="id" value="<?= $_SESSION['user']['id'] ?>" style="display: none">
        <input type="submit" name="delete" class="submit" value="Oui" alt="Supprimer le compte"
               title="Supprimer le compte" style="color: red; width: 50px; display: inline">
    </form>
    <form action="?c=user&a=delete&id=<?= $_SESSION['user']['id'] ?>" method="post" style="display: inline">
        <input type="submit" name="notDelete" class="submit" value="Non" alt="ne pas supprimer le compte"
               title="ne pas supprimer le compte" style="color: green; width: 50px; display: inline; font-weight: bold">
    </form>
</div>