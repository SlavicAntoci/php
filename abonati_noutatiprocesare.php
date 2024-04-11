<?php
session_start();
include 'writelogs.php';
write_logs('vizualizare');


// Verificați dacă utilizatorul este autentificat și are rolul de admin
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['email']) || !isset($_SESSION['id_utilizator']) || !isset($_SESSION['id_rol']) || $_SESSION['id_rol'] !== '1') {
    // Utilizatorul nu este autentificat sau nu are rolul de admin, redirecționați către o altă pagină sau afișați un mesaj de eroare
    header("Location: index.php"); // Schimbați "pagina_de_autentificare.php" cu pagina de autentificare a utilizatorului
    exit(); // Asigurați-vă că nu se afișează niciun alt conținut al paginii dacă utilizatorul nu este autorizat
}
include 'conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['trimite_personalizat'])) {
    if (isset($_POST['mesaj_personalizat']) && !empty($_POST['mesaj_personalizat'])) {



        if (isset($_POST['email_tuturor']) && !empty($_POST['email_tuturor'])) {
            $mesaj_personalizat = $_POST['mesaj_personalizat'];

            $insert_mesaj_sql = "INSERT INTO mesaj (mesaj) VALUES ($1)";
            $insert_mesaj_result = pg_query_params($conn, $insert_mesaj_sql, array($mesaj_personalizat));

            if ($insert_mesaj_result) {
                $select_id_mesaj = "SELECT id_mesaj FROM mesaj WHERE mesaj = $1";
                $select_id_mesaj_result = pg_query_params($conn, $select_id_mesaj, array($mesaj_personalizat));

                if ($select_id_mesaj_result) {
                    $row_mesaj = pg_fetch_assoc($select_id_mesaj_result);
                    $mesaj_id = $row_mesaj['id_mesaj'];

                    $select_email_ids_sql = "SELECT id_mail FROM emails";
                    $select_email_ids_result = pg_query($conn, $select_email_ids_sql);

                    if ($select_email_ids_result) {
                        while ($row = pg_fetch_assoc($select_email_ids_result)) {
                            $id_email = $row['id_mail'];

                            $insert_relational_sql = "INSERT INTO email_mesaj (id_email, id_mesaj) VALUES ($1, $2)";
                            $insert_relational_result = pg_query_params($conn, $insert_relational_sql, array($id_email, $mesaj_id));

                            if ($insert_relational_result) {
                                echo "Mesajul a fost trimis cu succes către emailul cu id-ul $id_email. <br>";
                            } else {
                                echo "Eroare la trimiterea mesajului către emailul cu id-ul $id_email. <br>";
                            }
                        }
                        include 'writelogs.php';
                        write_logs('timitere mesaj la abonati');
                        $success_message = "Mesajul personalizat a fost trimis cu succes la toti!";
                        header("Location: abonati_noutati.php?success_message=" . urlencode($success_message));
                    } else {
                        echo "Eroare la preluarea id-urilor emailurilor.";
                    }
                }
            } else {
                echo "Eroare la trimiterea mesajului personalizat.";
            }
        } elseif (isset($_POST['email_alesi']) && !empty($_POST['email_alesi'])) {
            $mesaj_personalizat = $_POST['mesaj_personalizat'];

            $insert_mesaj_sql = "INSERT INTO mesaj (mesaj) VALUES ($1)";
            $insert_mesaj_result = pg_query_params($conn, $insert_mesaj_sql, array($mesaj_personalizat));

            if ($insert_mesaj_result) {
                $select_id_mesaj = "SELECT id_mesaj FROM mesaj WHERE mesaj = $1";
                $select_id_mesaj_result = pg_query_params($conn, $select_id_mesaj, array($mesaj_personalizat));

                if ($select_id_mesaj_result) {
                    $row_mesaj = pg_fetch_assoc($select_id_mesaj_result);
                    $mesaj_id = $row_mesaj['id_mesaj'];

                    if (isset($_POST['email_alesi'])) {
                        foreach ($_POST['email_alesi'] as $key => $value) {
                            $email = $_POST['email_alesi'][$key];
                            $insert_relational_sql = "INSERT INTO email_mesaj (id_email, id_mesaj) VALUES ((SELECT id_mail FROM emails WHERE email = $1), $2)";
                            $insert_relational_result = pg_query_params($conn, $insert_relational_sql, array($email, $mesaj_id));
                        }
                        include 'writelogs.php';
                        write_logs('timitere mesaj la abonati');
                        $success_message = "Mesajul personalizat a fost trimis cu succes la toti alesi!";
                        header("Location: abonati_noutati.php?success_message=" . urlencode($success_message));
                    }
                }
            } else {
                echo "Eroare la trimiterea mesajului personalizat.";
            }
        } else {
            $error_message = "Nu s-a ales personele.";
            header("Location: abonati_noutati.php?error_message=" . urlencode($error_message));
        }
    } else {
        $error_message = "Nu s-a introdus niciun mesaj personalizat.";
        header("Location: abonati_noutati.php?error_message=" . urlencode($error_message));
    }
}
