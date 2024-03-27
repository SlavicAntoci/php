<?php
// Verificăm dacă utilizatorul este autentificat
session_start();

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
  <h1>Bine ați venit în Magazinul Nostru Online!</h1>
  <p>Descoperiți cele mai bune oferte și produse de calitate.</p>
  <p>Explorați gama noastră variată de produse și bucurați-vă de experiența de cumpărare convenabilă.</p>

  <div class="row">
      
  <?php
    // Include fișierul de conexiune la baza de date
    include 'conect.php';

    // Interogare pentru a selecta toate produsele
    $sql = "SELECT id,imagine, denumire, descriere, pret FROM produse";
    $result = pg_query($conn, $sql);

    // Verificare dacă interogarea a returnat rezultate
    if (!$result) {
        echo "Eroare la executarea interogării SQL: " . pg_last_error($conn);
        exit;
    }

    // Iterare prin rezultatele interogării și afișare carduri produs
    while ($row = pg_fetch_assoc($result)) {
      echo '<div class="col-md-4 mb-3"">';
      echo '<div class="card mb-4 shadow-sm h-100">'; // Adăugăm clasa h-100 pentru a asigura înălțimi egale
      echo '<img src="' . $row['imagine'] . '" class="card-img-top img-fluid d-block" style="width: 300px; height: 300px;" alt="Imagine produs">';
      echo '<div class="card-body">';
      echo '<h5 class="card-title">' . $row['denumire'] . '</h5>';
      echo '<p class="card-text">' . $row['descriere'] . '</p>';
      echo '<div class="d-flex justify-content-between align-items-center">';
      echo '<div class="btn-group">';
      echo '<form method="POST" action="adauga_in_cos.php">';
      echo '    <input type="hidden" name="id" value="' . $row["id"] . '">';
      echo '    <button type="submit" class="btn btn-sm btn-outline-secondary" name="adauga_in_cos">Adaugă în coș</button>';
      echo '</form>';
            echo '<button type="button" class="btn btn-sm btn-outline-secondary">Detalii</button>';
      echo '</div>';
      echo '<small class="text-muted">Preț: $' . $row['pret'] . '</small>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
      echo '</div>';
    }

    // Închidere conexiune la baza de date
    pg_close($conn);
    ?>
</div>

<?php
include 'foter.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
