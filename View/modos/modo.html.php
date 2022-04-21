<?php
if (isset($_SESSION['modo'])) {
    header('LOCATION: ?c=home');
}
if (isset($_SESSION['banned']['user']['mail'])){
    header('LOCATION: ?c=home&a=banned');
}
?>
</form>

</form>
