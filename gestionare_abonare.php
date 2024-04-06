<?php
// Includeți fișierul de conexiune la baza de date
include 'conect.php';

// Verificați dacă formularul a fost trimis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "1";
    // Verificați dacă câmpul de email a fost completat
    if (isset($_POST['email'])) {
        echo "2";
        // Preiați valoarea introdusă în câmpul de email
        $email = $_POST['email'];
        
        // Verificați dacă adresa de email există deja în baza de date
        $check_sql = "SELECT COUNT(*) FROM emails WHERE email = $1";
        $check_result = pg_query_params($conn, $check_sql, array($email));
        $row = pg_fetch_row($check_result);
        $email_exists = $row[0];
        
        if ($email_exists) {
            // Mesajul de eroare
            $error_message = "Această adresă de email este deja înregistrată în baza de date.";
            header("Location: noutati.php?error_message=" . urlencode($error_message));
            exit(); // Asigurați-vă că scriptul se încheie aici
        } else {
            // Preparează o declarație de inserare a datelor în tabela "emails"
            $insert_sql = "INSERT INTO emails (email, data) VALUES ($1, NOW())";
            $insert_result = pg_query_params($conn, $insert_sql, array($email));

            if ($insert_result) {
                include 'writelogs.php';
                write_logs('abonare noutati');
                // Mesajul de succes
                $success_message = "V-ați abonat cu succes la noutățile noastre!";
                // Redirecționare către pagina principală cu mesajul de succes în URL
                header("Location: noutati.php?success_message=" . urlencode($success_message));
                exit(); // Asigurați-vă că scriptul se încheie aici
            } else {
                // Mesajul de eroare
                $error_message = "Eroare la inserarea datelor în baza de date.";
            }
        }
    }
}
?>
