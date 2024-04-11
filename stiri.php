<?php
// Verificăm dacă utilizatorul este autentificat
session_start();

include 'writelogs.php';
write_logs('vizualizare');

// Dacă utilizatorul nu este autentificat, îl redirecționăm către pagina de autentificare
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: autorizare.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Magazin Online</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css">

</head>
<body>

<?php 
include 'nav.php';
?>

<div class="container mt-5">
  <h1>Bine ați venit la stiri!</h1>
  <p>Descoperiți cele mai bune oferte și produse de calitate.</p>
  <p>Explorați gama noastră variată de produse și bucurați-vă de experiența de cumpărare convenabilă.</p>

  

</div>

<?php
include 'foter.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
