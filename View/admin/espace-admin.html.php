<?php
if (!isset($_SESSION['admin'])) {
    if (isset($_SESSION['modo'])) {
        header('LOCATION: ?c=espace-moderation');
    }
}

if (!isset($_SESSION['modo'])) {
    if (!isset($_SESSION['admin'])) {
        header('LOCATION: ?c=home');
    }
}
?>
</form>

</form>

