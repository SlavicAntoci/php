<?php
session_start();

// Verifică dacă există o cerere POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifică dacă utilizatorul este autentificat
    if (isset($_SESSION['id_utilizator'])) {
        // Preia ID-ul produsului din cererea POST
        $id = $_POST['id'];

        // Include fișierul de conexiune la baza de date
        include 'conect.php';
        $id_utilizator = $_SESSION['id_utilizator'];

        // Interogare pentru ștergerea produsului din coșul utilizatorului
        $sql = "DELETE FROM cos_cumparaturi WHERE id_utilizator = $id_utilizator AND id = $id";
        $result = pg_query($conn, $sql);

        // Verifică dacă ștergerea a fost realizată cu succes
        if ($result) {
            // Redirectează utilizatorul înapoi la pagina coșului
            header("Location: cos_cumparaturi.php");
            exit;
        } else {
            // Dacă apare o eroare la ștergere, poți afișa un mesaj de eroare sau face altă acțiune
            echo "Eroare la ștergerea produsului din coș.";
        }

        // Închide conexiunea la baza de date
        pg_close($conn);
    } else {
        // Dacă utilizatorul nu este autentificat, poți redirecționa către pagina de autentificare
        header("Location: autorizare.php");
        exit;
    }
}
?>
