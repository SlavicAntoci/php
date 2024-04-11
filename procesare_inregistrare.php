<?php

session_start();
include 'writelogs.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date (modificați detaliile corespunzătoare)
    include 'conect.php';

    // Capturăm datele din formular
    $nume = htmlspecialchars($_POST['nume']);
    $prenume = htmlspecialchars($_POST['prenume']);
    $email = htmlspecialchars($_POST['email']);
    $parola = htmlspecialchars($_POST['parola']);
    $confirmare_parola = htmlspecialchars($_POST['confirmare_parola']);

    if (!preg_match("/^[a-zA-Z]{1,15}$/", $nume) || !preg_match("/^[a-zA-Z]{1,15}$/", $prenume)) {
        $_SESSION['error_message'] = "Numele și prenumele trebuie să conțină doar litere.";
        header("Location: inregistrare.php");
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error_message'] = "Adresa de email este invalidă.";
        header("Location: inregistrare.php");
        exit;
    }
    
    if (!preg_match("/^.{5,15}$/", $parola)) {
        $_SESSION['error_message'] = "Parola trebuie să conțină între 5 și 15 caractere.";
        header("Location: inregistrare.php");
        exit;
    }
    
    if ($parola != $confirmare_parola) {
        $_SESSION['error_message'] = "Parola și confirmarea parolei nu coincid.";
        header("Location: inregistrare.php");
        exit;
    }
    
    $parola_hash = password_hash($parola, PASSWORD_DEFAULT);

    $sql = "INSERT INTO utilizatori (nume, prenume, email, parola, id_rol) VALUES ($1, $2, $3, $4, 2)";
    $result = pg_query_params($conn, $sql, array($nume, $prenume, $email, $parola_hash));

    if ($result) {
        write_logs('inregistrare');
        header("Location: autorizare.php");
    } else {
        $error_message = "Eroare la înregistrare: asa email deja este utilizat";
        header("Location: inregistrare.php?error_message=" . urlencode($error_message));
    }

    pg_close($conn);
}
