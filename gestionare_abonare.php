<?php
include 'conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['email'])) {

        $email = htmlspecialchars($_POST['email']);

        
        session_start();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Această adresă de email nu corespunde unui email.";
            $_SESSION['error_message'] = $error_message;
            header("Location: noutati.php");
            exit();
        }

        $check_sql = "SELECT COUNT(*) FROM emails WHERE email = $1";
        $check_result = pg_query_params($conn, $check_sql, array($email));
        $row = pg_fetch_row($check_result);
        $email_exists = $row[0];

        if ($email_exists) {
            $error_message = "Această adresă de email este deja înregistrată în baza de date.";
            header("Location: noutati.php?error_message=" . urlencode($error_message));
            exit();
        } else {

            $check_sql = "SELECT id FROM utilizatori WHERE email = $1";
            $check_result = pg_query_params($conn, $check_sql, array($email));
            $num_rows = pg_num_rows($check_result);

            if ($num_rows > 0) {
                $user_row = pg_fetch_assoc($check_result);
                $user_id = $user_row['id'];

                $insert_sql = "INSERT INTO emails (email, data, user_id) VALUES ($1, NOW(), $2)";
                $insert_result = pg_query_params($conn, $insert_sql, array($email, $user_id));

                if ($insert_result) {
                    include 'writelogs.php';
                    write_logs('abonare noutati');
                    $success_message = "V-ați abonat cu succes la noutățile noastre!";
                    header("Location: noutati.php?success_message=" . urlencode($success_message));
                    exit();
                } else {
                    $error_message = "Eroare la inserarea datelor în baza de date.";
                }
            } else {
                $insert_sql = "INSERT INTO emails (email, data) VALUES ($1, NOW())";
                $insert_result = pg_query_params($conn, $insert_sql, array($email));

                if ($insert_result) {
                    include 'writelogs.php';
                    write_logs('abonare noutati');
                    $success_message = "V-ați abonat cu succes la noutățile noastre!";
                    header("Location: noutati.php?success_message=" . urlencode($success_message));
                    exit();
                } else {
                    $error_message = "Eroare la inserarea datelor în baza de date.";
                }
            }
        }
    }
}
