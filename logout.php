<?php
// Initialize the session
session_start();

// De array met alle data wordt geleegd
$_SESSION = array();

// De sessie wordt als het waren gereset
session_destroy();

// Doorsturing naar de login pagina
header("location: index.php");
exit;
?>
