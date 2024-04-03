<?php
session_start();
include 'writelogs.php';

// Verificăm dacă utilizatorul a trimis cererea de adăugare în coș
if(isset($_POST['adauga_in_cos'])) {
    // Verificăm dacă utilizatorul este autentificat
    if(isset($_SESSION['id_utilizator'])) {
        // Preia ID-ul produsului din cererea POST
        $id_produs = $_POST['id'];

        // Conectare la baza de date
        include 'conect.php';
        
        // Preia ID-ul utilizatorului din sesiune
        $id_utilizator = $_SESSION['id_utilizator'];

        // Interogare pentru a insera un nou produs în coșul utilizatorului
        $sql = "INSERT INTO cos_cumparaturi (id_utilizator, id_produs) VALUES ($id_utilizator, $id_produs)";
        
        // Execută interogarea
        if(pg_query($conn, $sql)) {
            // Produsul a fost adăugat cu succes în coș
            write_logs('adauga produs in cos');

            header("Location: user.php");
            exit;
        } else {
            // Eroare la inserarea produsului în coș
            echo "Eroare: " . pg_last_error($conn);
        }

        // Închide conexiunea la baza de date
        //pg_close($conn);
    } else {
        // Dacă utilizatorul nu este autentificat, redirecționează către pagina de autentificare
        header("Location: autorizare.php");
        exit;
    }
}
?>
