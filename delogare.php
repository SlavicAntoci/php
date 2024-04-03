<?php

// Începem sesiunea
session_start();

include 'writelogs.php';
write_logs('delogarea');

// Ștergem toate variabilele de sesiune
$_SESSION = array();

// Închidem sesiunea
session_destroy();

// Redirecționăm către pagina principală
header("Location: index.php");
exit;
?>
