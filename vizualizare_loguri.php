<?php
// Începeți sesiunea
session_start();
include 'writelogs.php';
write_logs('vizualizare');


// Verificați dacă utilizatorul este autentificat și are rolul de admin
if (!isset($_SESSION['logged_in']) || !isset($_SESSION['email']) || !isset($_SESSION['id_utilizator']) || !isset($_SESSION['id_rol']) || $_SESSION['id_rol'] !== '1') {
    // Utilizatorul nu este autentificat sau nu are rolul de admin, redirecționați către o altă pagină sau afișați un mesaj de eroare
    header("Location: index.php"); // Schimbați "pagina_de_autentificare.php" cu pagina de autentificare a utilizatorului
    exit(); // Asigurați-vă că nu se afișează niciun alt conținut al paginii dacă utilizatorul nu este autorizat
}

// Include fișierul de conexiune la baza de date
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare loguri</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="admin.php" class="btn btn-secondary">Înapoi</a>

        <h2>Vizualizare loguri</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Data și oră</th>
                    <th>Fișier accesat</th>
                    <th>ID sesiune</th>
                    <th>ID utilizator</th>
                    <th>ID rol</th>
                    <th>Acțiune</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Include fișierul de conectare la baza de date
            include 'conectforlog.php';

            // Verificăm dacă este setat parametrul pentru pagina curentă
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

            // Numărul de rezultate pe pagină
            $resultsPerPage = 50;

            // Calculăm offset-ul pentru interogare
            $offset = ($currentPage - 1) * $resultsPerPage;

            // Interogare pentru a selecta logurile din baza de date cu limită și offset
            $sql = "SELECT data_ora, fisier_accesat, id_sesiune, id_user, id_rol, actiune 
                    FROM logs 
                    ORDER BY data_ora DESC 
                    LIMIT $resultsPerPage 
                    OFFSET $offset";
            $result = pg_query($conn, $sql);

            // Verificare dacă interogarea a returnat rezultate
            if ($result && pg_num_rows($result) > 0) {
                // Iterare prin rezultatele interogării și afișare loguri în tabel
                while ($row = pg_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['data_ora'] . '</td>';
                    echo '<td>' . $row['fisier_accesat'] . '</td>';
                    echo '<td>' . $row['id_sesiune'] . '</td>';
                    echo '<td>' . ($row['id_user'] != NULL ? $row['id_user'] : '-') . '</td>';
                    echo '<td>' . ($row['id_rol'] != NULL ? $row['id_rol'] : '-') . '</td>';
                    echo '<td>' . $row['actiune'] . '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6">Nu există loguri disponibile.</td></tr>';
            }

            // Închidere conexiune la baza de date
            pg_close($conn);
            ?>
            </tbody>
        </table>

        <!-- Buton pentru pagina anterioară (dacă este disponibilă) -->
        <?php if ($currentPage > 1): ?>
            <a href="?page=<?php echo $currentPage - 1; ?>" class="btn btn-secondary mr-2">Pagina anterioară</a>
        <?php endif; ?>

        <!-- Buton pentru pagina următoare (dacă este disponibilă) -->
        <?php if (pg_num_rows($result) == $resultsPerPage): ?>
            <a href="?page=<?php echo $currentPage + 1; ?>" class="btn btn-secondary">Pagina următoare</a>
        <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
