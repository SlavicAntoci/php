<?php
session_start();
include 'writelogs.php';
write_logs('stergere produs');


// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verifică dacă parametrul ID a fost transmis prin URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Preia ID-ul produsului din URL
    $produs_id = $_GET['id'];

    // Interogare pentru a șterge produsul din baza de date
    $sql = "DELETE FROM produse WHERE id = $1";
    $result = pg_query_params($conn, $sql, array($produs_id));

    // Verifică dacă ștergerea a fost efectuată cu succes
    if ($result) {
        echo "Produsul a fost șters cu succes.";
    } else {
        echo "Eroare la ștergerea produsului: " . pg_last_error($conn);
    }

    // Redirecționează utilizatorul înapoi la pagina de unde a venit
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
} else {
    echo "ID-ul produsului lipsește.";
}

// Închidere conexiune la baza de date
pg_close($conn);
?>
