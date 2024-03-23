<?php
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verifică dacă s-a trimis un formular de adăugare a produsului
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preia datele din formular
    $denumire = $_POST['denumire'];
    $descriere = $_POST['descriere'];
    $pret = $_POST['pret'];
    $categorie_id = $_POST['categorie'];

    // Verifică dacă a fost încărcată o imagine
    if(isset($_FILES['imagine']) && $_FILES['imagine']['error'] === UPLOAD_ERR_OK) {
        $imagine_tmp_name = $_FILES['imagine']['tmp_name'];
        $imagine_name = $_FILES['imagine']['name'];

        // Mută imaginea încărcată în folderul dorit (în acest exemplu, numele folderului este 'imagini')
        $destination = 'imagini/' . $imagine_name;
        move_uploaded_file($imagine_tmp_name, $destination);
    } else {
        echo "Eroare la încărcarea imaginii.";
        exit;
    }

    // Inserează datele produsului în baza de date
    $sql = "INSERT INTO produse (imagine, denumire, descriere, pret, categorie_id) VALUES ($1, $2, $3, $4, $5)";
$result = pg_query_params($conn, $sql, array($destination, $denumire, $descriere, $pret, $categorie_id));

    // Verifică dacă inserarea a fost efectuată cu succes
    if ($result) {
        header("Location: http://localhost/aplicatie/admin.php"); // Redirect către pagina produselor
        exit; // Asigură că nu se execută codul ulterior
    } else {
        echo "Eroare la adăugarea produsului: " . pg_last_error($conn);
    }
}

// Închide conexiunea la baza de date
pg_close($conn);
?>
