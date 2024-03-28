<?php
// Începeți sesiunea
session_start();

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
    <title>Adaugă Produs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="admin.php" class="btn btn-secondary mt-3">Înapoi la produse</a>
        <h2>Adaugă Produs</h2>
        <form method="post" action="salveaza_produs.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imagine">Imagine:</label>
                <input type="file" class="form-control-file" id="imagine" name="imagine" required>
            </div>
            <div class="form-group">
                <label for="denumire">Denumire:</label>
                <input type="text" class="form-control" id="denumire" name="denumire" required>
            </div>
            <div class="form-group">
                <label for="descriere">Descriere:</label>
                <textarea class="form-control" id="descriere" name="descriere" rows="4" required></textarea>
            </div>
            <div class="form-group">
            <label for="categorie">Categorie:</label>
            <select class="form-control" id="categorie" name="categorie">
            <?php
                // Include fișierul de conexiune la baza de date
                include 'conect.php';

                // Interogare pentru a selecta toate categoriile din baza de date
                $sql = "SELECT id, denumire FROM categorii";
                $result = pg_query($conn, $sql);

                // Verificare dacă interogarea a returnat rezultate
                if ($result) {
                    // Iterați prin rezultate și adăugați opțiuni în meniul derulant
                    while ($row = pg_fetch_assoc($result)) {
                        echo '<option value="' . $row['id'] . '">' . $row['denumire'] . '</option>';
                    }
                } else {
                    echo '<option value="">Nu există categorii disponibile</option>';
                }

                // Închideți conexiunea la baza de date
                pg_close($conn);
                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="pret">Preț:</label>
                <input type="number" class="form-control" id="pret" name="pret" step="0.01" required>
            </div>
           
            <button type="submit" class="btn btn-primary">Adaugă Produs</button>
        </form>
    </div>
</body>
</html>
