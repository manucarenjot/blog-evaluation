<?php
(new UserController)->getConnected();
session_destroy();
header('LOCATION: ?c=home');