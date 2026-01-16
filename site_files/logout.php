<?php
session_start();
// Distrugem toate variabilele sesiunii
$_SESSION = array();
session_destroy();
// Trimitem utilizatorul la pagina de Login
header("location: pagina.login.php");
exit;
?>