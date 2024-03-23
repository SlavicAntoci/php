<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produse</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="adauga_produs.php" class="btn btn-primary mb-3">Adaugă produs</a>

        <h2>Produse</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Imagine</th>
                    <th>Denumire</th>
                    <th>Descriere</th>
                    <th>Preț</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
            <?php
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Interogare pentru a selecta toate produsele și informațiile despre categoria lor
$sql = "SELECT p.id, p.imagine, p.denumire, p.descriere, p.pret, c.denumire AS categorie
        FROM produse p
        INNER JOIN categorii c ON p.categorie_id = c.id";
$result = pg_query($conn, $sql);

// Verificare dacă interogarea a returnat rezultate
if (!$result) {
    echo '<tr><td colspan="6">Eroare la executarea interogării SQL: ' . pg_last_error($conn) . '</td></tr>';
} else {
    // Iterare prin rezultatele interogării și afișare rânduri de tabel
    while ($row = pg_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td><img src="' . $row['imagine'] . '" alt="Imagine produs" style="max-width: 100px; max-height: 100px;"></td>';
        echo '<td>' . $row['denumire'] . '</td>';
        echo '<td>' . $row['descriere'] . '</td>';
        echo '<td>' . $row['pret'] . '</td>';
        echo '<td>' . $row['categorie'] . '</td>';
        echo '<td>';
        echo '<a href="actualizare_produs.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-primary">Actualizare</a> ';
        echo '<a href="sterge_produs.php?id=' . $row['id'] . '" class="btn btn-sm btn-outline-danger" onclick="return confirm(\'Sigur doriți să ștergeți acest produs?\')">Ștergere</a>';
        echo '</td>';
        echo '</tr>';
    }
}

// Închidere conexiune la baza de date
pg_close($conn);
?>


            </tbody>
        </table>
    </div>
</body>
</html>
