<?php
session_start();
include 'writelogs.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conect.php';

    $email = $_POST['email'];
    $parola = $_POST['password'];

    $sql = "SELECT id, id_rol, parola FROM utilizatori WHERE email = $1";
    $result = pg_query_params($conn, $sql, array($email));

    if ($result) {
        $row = pg_fetch_assoc($result);
        $parola_hash = $row['parola'];

        if (password_verify($parola, $parola_hash)) {

            $sql_user_details = "SELECT id, id_rol FROM utilizatori WHERE email = $1";
            $result_user_details = pg_query_params($conn, $sql_user_details, array($email));

            if ($result_user_details) {
                $row_user_details = pg_fetch_assoc($result_user_details);
                $id_utilizator = $row_user_details['id'];
                $rol = $row_user_details['id_rol'];

                $_SESSION['logged_in'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['id_utilizator'] = $id_utilizator;
                $_SESSION['id_rol'] = $rol;

                if ($rol == 1) {
                    pg_close($conn);
                    write_logs('autentificare');
                    header("Location: admin.php");
                    exit(); 
                } elseif ($rol == 2) {
                    pg_close($conn);
                    write_logs('autentificare');
                    header("Location: user.php");
                    exit(); 
                } else {
                    pg_close($conn);
                    write_logs('autentificare');
                    header("Location: index.php");
                    exit(); 
                }
            } else {
                pg_close($conn);
                $_SESSION['error_message'] = "Eroare la autentificare. Te rugăm să încerci din nou mai târziu.";
                header("Location: autorizare.php");
                exit();
            }
        } else {
            pg_close($conn);
            $_SESSION['error_message'] = "Email sau parolă incorecte. Te rugăm să încerci din nou.";
            header("Location: autorizare.php");
            exit(); 
        }
    } else {
        pg_close($conn);
        $_SESSION['error_message'] = "Eroare la autentificare. Te rugăm să încerci din nou mai târziu.";
        header("Location: autorizare.php");
        exit(); 
    }
    pg_close($conn);
}
