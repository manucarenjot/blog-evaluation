<?php
if (isset($_GET['profil'])) {
    if (!isset($_SESSION['user'])) {
        header('LOCATION: ?c=home');
    }
}
?>
<br>
<br>



