<?php
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verifică dacă s-a trimis un formular de adăugare a produsului
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Preia datele din formular și aplică filtrare
    $denumire = htmlspecialchars($_POST['denumire']);
    $descriere = htmlspecialchars($_POST['descriere']);
    $pret = floatval($_POST['pret']); // Asigură că prețul este un număr
    $categorie_id = intval($_POST['categorie']); // Asigură că id-ul categoriei este un număr întreg

    // Verifică dacă a fost încărcată o imagine și filtrează numele imaginii
    if(isset($_FILES['imagine']) && $_FILES['imagine']['error'] === UPLOAD_ERR_OK) {
        $imagine_tmp_name = $_FILES['imagine']['tmp_name'];
        $imagine_name = htmlspecialchars($_FILES['imagine']['name']); // Filtrează numele imaginii

        // Mută imaginea încărcată în folderul dorit (în acest exemplu, numele folderului este 'imagini')
        $destination = 'imagini/' . $imagine_name;
        move_uploaded_file($imagine_tmp_name, $destination);
    } else {
        echo "Eroare la încărcarea imaginii.";
        exit;
    }

    // Inserează datele produsului în baza de date utilizând parametrizarea
    $sql = "INSERT INTO produse (imagine, denumire, descriere, pret, categorie_id) VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $sql, array($destination, $denumire, $descriere, $pret, $categorie_id));

    // Verifică dacă inserarea a fost efectuată cu succes
    if ($result) {
        header("Location: http://localhost/aplicatie/admin.php"); // Redirect către pagina produselor
    } else {
        echo "Eroare la adăugarea produsului: " . pg_last_error($conn);
    }
}

// Închide conexiunea la baza de date
pg_close($conn);
?>
