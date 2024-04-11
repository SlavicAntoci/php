<?php


session_start();
include 'writelogs.php';
write_logs('vizualizare');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formular de Autorizare</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <?php
        if (isset($_SESSION['error_message'])) {
          echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error_message'] . '</div>';

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
                <input type="text" class="form-control" id="email" name="email" required>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>