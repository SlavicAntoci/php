<?php
// Verificăm dacă utilizatorul este autentificat
//session_start();


include 'writelogs.php';
write_logs('vizualizare');

// Dacă utilizatorul nu este autentificat, îl redirecționăm către pagina de autentificare
/*if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: autorizare.php");
    exit;
}*/
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magazin Online</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>

<body>

    <?php
    include 'nav.php';
    ?>

    <div class="container mt-5">

        <?php
        // Verificați dacă există un mesaj de succes sau de eroare în URL
        if (isset($_GET['success_message'])) {
            // Afisati mesajul de succes
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success_message']) . '</div>';
        } elseif (isset($_GET['error_message'])) {
            // Afisati mesajul de eroare
            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error_message']) . '</div>';
        }
        ?>


        <div class="container-fluid mt-5">
            <div class="row">
                <div class="col">
                    <h2 class="text-center mb-4 text-danger">Ca să vezi Noutățile trebuie să fii înregistrat cu acest email</h2>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4 error-message">
                    <?php
                    if (isset($_SESSION['error_message'])) {
                        echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']); // ștergem mesajul de eroare după ce a fost afișat
                    }
                    ?>
                </h2>

                <h2 class="text-center mb-4">Abonează-te la Noutățile Noastre</h2>
                <form id="subscribeForm" action="gestionare_abonare.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Introdu adresa ta de email" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Abonează-te</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col">
                <?php include 'foter.php'; ?>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>