<?php


session_start();
include 'writelogs.php';
write_logs('vizualizare');


// Începe o sesiun

// Verifică dacă utilizatorul este autentificat și dacă da, să îl deconectezi
/*if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Șterge toate variabilele de sesiune
    session_unset();
    
    // Distrugerea sesiunii
    session_destroy();
}*/

// Restul codului pentru formularul de autentificare
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formular de Autorizare</title>
  <!-- Adaugă link-ul către Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">


  <div class="row justify-content-center">
    
    <div class="col-md-6">
   
    <?php
// Inițializează sesiunea (dacă nu este deja inițializată)

// Verifică dacă există un mesaj de eroare în sesiune
if(isset($_SESSION['error_message'])) {
    // Afișează mesajul de eroare
    echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';
    
    // Șterge mesajul de eroare pentru a nu fi afișat din nou
    unset($_SESSION['error_message']);
}
?> <a href="index.php" class="btn btn-primary mb-3">Inapoi</a>
      <div class="card">
        <div class="card-header">
          Autorizare
        </div>
        <div class="card-body">
          <form action="autentificare.php" method="POST">
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="password">Parolă:</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Autentificare</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Adaugă link-ul către librăria jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Adaugă link-ul către librăria Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
