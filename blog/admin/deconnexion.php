<?php
session_start();
unset($_SESSION);
unset($_COOKIE);
session_destroy();
header ("X-FRAME-OPTIONS: DENY");
header ('Location: connexion.php');

?>
