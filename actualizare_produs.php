<?php
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verifică dacă parametrul ID a fost transmis prin URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Preia ID-ul produsului din URL
    $produs_id = $_GET['id'];

    // Interogare pentru a selecta detalii despre produsul cu ID-ul specificat
    $sql = "SELECT id, imagine, denumire, descriere, pret FROM produse WHERE id = $1";
    $result = pg_query_params($conn, $sql, array($produs_id));

    // Verifică dacă interogarea a returnat un singur rând
    if(pg_num_rows($result) == 1) {
        $row = pg_fetch_assoc($result);
        $id = $row['id'];
        $denumire = $row['denumire'];
        $descriere = $row['descriere'];
        $pret = $row['pret'];
    } else {
        echo "Produsul nu a fost găsit.";
        exit;
    }
} else {
    echo "ID-ul produsului lipsește.";
    exit;
}

// Verifică dacă s-a trimis un formular de actualizare
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preia noile date din formular
    $denumire_noua = $_POST['denumire'];
    $descriere_noua = $_POST['descriere'];
    $pret_nou = $_POST['pret'];

    // Verifică dacă a fost încărcată o imagine
    if(isset($_FILES['imagine']) && $_FILES['imagine']['error'] === UPLOAD_ERR_OK) {
        $imagine_tmp_name = $_FILES['imagine']['tmp_name'];
        $imagine_name = $_FILES['imagine']['name'];

        // Mută imaginea încărcată în folderul dorit (în acest exemplu, numele folderului este 'imagini')
        $destination = 'imagini/' . $imagine_name;
        move_uploaded_file($imagine_tmp_name, $destination);

        // Actualizează calea imaginii în baza de date
        $sql_actualizare_imagine = "UPDATE produse SET imagine = $1 WHERE id = $2";
        $result_actualizare_imagine = pg_query_params($conn, $sql_actualizare_imagine, array($destination, $produs_id));

        // Verifică dacă actualizarea imaginii a fost efectuată cu succes
        if (!$result_actualizare_imagine) {
            echo "Eroare la actualizarea imaginii: " . pg_last_error($conn);
            exit;
        }
    }

    // Actualizează denumirea, descrierea și prețul produsului
    $sql_actualizare = "UPDATE produse SET denumire = $1, descriere = $2, pret = $3 WHERE id = $4";
    $result_actualizare = pg_query_params($conn, $sql_actualizare, array($denumire_noua, $descriere_noua, $pret_nou, $produs_id));
}

// Închidere conexiune la baza de date
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizare Produs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="admin.php" class="btn btn-secondary mt-3">Înapoi la produse</a>
        <h2>Actualizare Produs</h2>
       


        <!-- Afisare mesaje de eroare sau de succes -->
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($result_actualizare) {
                    echo '<div class="alert alert-success" role="alert">Produsul a fost actualizat cu succes.</div>';
                } else {
                    echo '<div class="alert alert-danger" role="alert">Eroare la actualizarea produsului: ' . pg_last_error($conn) . '</div>';
                }
            }
        ?>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $produs_id); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imagine">Imagine:</label>
                <input type="file" class="form-control-file" id="imagine" name="imagine">
            </div>
            <div class="form-group">
                <label for="denumire">Denumire:</label>
                <input type="text" class="form-control" id="denumire" name="denumire" value="<?php echo $denumire; ?>" required>
            </div>
            <div class="form-group">
                <label for="descriere">Descriere:</label>
                <textarea class="form-control" id="descriere" name="descriere" rows="4" required><?php echo $descriere; ?></textarea>
            </div>           
            <div class="form-group">
                <label for="pret">Preț:</label>
                <input type="number" class="form-control" id="pret" name="pret" value="<?php echo $pret; ?>" step="0.01" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizează</button>
            
        </form>
    </div>
</body>
</html>
