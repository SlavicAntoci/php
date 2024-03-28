<?php 
// Verificăm dacă s-a trimis formularul
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectare la baza de date (modificați detaliile corespunzătoare)
    include 'conect.php';

    // Capturăm datele din formular
    $email = $_POST['email'];
    $parola = $_POST['password'];

    // Verificăm dacă utilizatorul există în baza de date
    $sql = "SELECT * FROM utilizatori WHERE email = $1 AND parola = $2";
    $result = pg_query_params($conn, $sql, array($email, $parola));

    // Verificăm dacă s-a găsit un rând în baza de date (utilizatorul există)
    if (pg_num_rows($result) == 1) {
        // Începem sesiunea
        session_start();

        // Stocăm detaliile de autentificare în variabile de sesiune
        $_SESSION['logged_in'] = true;
        $_SESSION['email'] = $email;

        // Extragem ID-ul și rolul utilizatorului din rezultatul interogării
        $row = pg_fetch_assoc($result);
        $id_utilizator = $row['id'];
        $rol = $row['id_rol']; // presupunând că numele coloanei din baza de date pentru rol este 'rol'

        // Stocăm ID-ul utilizatorului în sesiune
        $_SESSION['id_utilizator'] = $id_utilizator;
        $_SESSION['id_rol'] = $rol;


        // Redirecționăm utilizatorul în funcție de rolul său
        if ($rol == 1) {
            header("Location: admin.php");
        } elseif ($rol == 2) {
            header("Location: user.php");
        } else {
            // Dacă nu este nici admin, nici cumpărător, poți redirecționa către o pagină de eroare sau acțiune suplimentară
            header("Location: index.php");
        }
    } else {
        // Utilizatorul nu există sau parola este incorectă
        session_start();
        $_SESSION['error_message'] = "Email sau parolă incorecte. Te rugăm să încerci din nou.";
        header("Location: autorizare.php");
    }

    // Închidem conexiunea la baza de date
    pg_close($conn);
}
?>
