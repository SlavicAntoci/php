<?php
// Verificăm dacă s-a trimis formularul de înregistrare
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date (modificați detaliile corespunzătoare)
    include 'conect.php';

    // Capturăm datele din formular
    $nume = $_POST['nume'];
    $prenume = $_POST['prenume'];
    $email = $_POST['email'];
    $parola = $_POST['parola'];

    // Inserăm datele în baza de date folosind parametrii pentru a preveni injecțiile SQL
    $sql = "INSERT INTO utilizatori (nume, prenume, email, parola) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($conn, $sql, array($nume, $prenume, $email, $parola));

    // Verificăm dacă inserarea s-a realizat cu succes
    if ($result) {
        header("Location: autorizare.php");
    } else {
        $error_message = "Eroare la înregistrare: " . pg_last_error($conn);
    }


    // Închidem conexiunea la baza de date
    pg_close($conn);
}
?>
