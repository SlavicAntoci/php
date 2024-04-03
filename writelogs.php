<?php
function write_logs($action){
    // Include fișierul de conectare la baza de date PostgreSQL
    include 'conectforlog.php';

    // Construirea interogării SQL pentru inserarea datelor în tabel
    $sql = "INSERT INTO logs (data_ora, fisier_accesat, id_sesiune, id_user, id_rol, actiune) VALUES (
            NOW(),
            '" . pg_escape_string($_SERVER['PHP_SELF']) . "',
            '" . pg_escape_string(SESSION_ID()) . "',
            " . (isset($_SESSION['id_utilizator']) ? $_SESSION['id_utilizator'] : "NULL") . ",
            " . (isset($_SESSION['id_rol']) ? $_SESSION['id_rol'] : "NULL") . ",
            '" . pg_escape_string($action) . "'
        )";

    // Executarea interogării SQL
    $result = pg_query($conn, $sql);
   /* if ($result) {
        echo "Înregistrare cu succes în baza de date.";
    } else {
        echo "Eroare la înregistrare în baza de date: " . pg_last_error($conn);
    }*/

    // Închiderea conexiunii la baza de date
    pg_close($conn);
}

?>
