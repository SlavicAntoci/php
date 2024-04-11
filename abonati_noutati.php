<?php
// Includeți fișierul de conexiune la baza de date
session_start();
include 'writelogs.php';
write_logs('vizualizare');



// Verificați dacă utilizatorul este autentificat și are rolul de admin
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['email']) || !isset($_SESSION['id_utilizator']) || !isset($_SESSION['id_rol']) || $_SESSION['id_rol'] !== '1') {
    // Utilizatorul nu este autentificat sau nu are rolul de admin, redirecționați către o altă pagină sau afișați un mesaj de eroare
    header("Location: index.php"); // Schimbați "pagina_de_autentificare.php" cu pagina de autentificare a utilizatorului
    exit(); // Asigurați-vă că nu se afișează niciun alt conținut al paginii dacă utilizatorul nu este autorizat
}
// Interogare pentru a selecta toate emailurile și datele de abonare din baza de date
include 'conect.php';
$sql = "SELECT email, data FROM emails";
$result = pg_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abonați la Știri</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <?php
        // Verificați dacă există un mesaj de succes sau de eroare în URL
        if (isset($_GET['success_message'])) {
            // Afisati mesajul de succes
            echo '<div class="alert alert-success">' . htmlspecialchars($_GET['success_message']) . '</div>';
        } elseif (isset($_GET['error_message'])) {
            // Afisati mesajul de eroare
            echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error_message']) . '</div>';
        }
        ?>
        <a href="admin.php" class="btn btn-secondary mt-3">Înapoi la produse</a>
        <h1 class="text-center mb-4">Abonați la Știri</h1>
        <form action="abonati_noutatiprocesare.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Data Abonării</th>
                        <th>Trimite la toti
                            <input type='checkbox' name='email_tuturor' value='<?php echo $row['email']; ?>'>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Interogare pentru a selecta toate emailurile și datele de abonare din baza de date
                    $sql = "SELECT email, data FROM emails";
                    $result = pg_query($conn, $sql);

                    // Verificăm dacă există rânduri în rezultatul interogării
                    if (pg_num_rows($result) > 0) {
                        // Iterăm prin fiecare rând și afișăm datele abonaților
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['data'] . "</td>";
                            echo "<td><input type='checkbox' name='email_alesi[]' value='" . $row['email'] . "'>Trimite</td>";
                            echo "</tr>";
                        }
                    } else {
                        // Dacă nu există rânduri, afișăm un mesaj că nu există abonați
                        echo "<tr><td colspan='4'>Nu există abonați la știri.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            <div class="form-group">
                <input type='text' class="form-control" name='mesaj_personalizat' placeholder='Introduceți mesajul'>
            </div>
            <button type="submit" class="btn btn-primary" name="trimite_personalizat">Trimite Mesaj Personalizat</button>
        </form>
    </div>
</body>

</html>