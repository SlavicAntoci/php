<?php
session_start();
include 'writelogs.php';
write_logs('vizualizre');


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coș Cumpărături</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">

</head>
<body>


<?php 
include 'nav.php';
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verificăm dacă există o sesiune pornită

// Verificăm dacă utilizatorul este logat
if (!isset($_SESSION['id_utilizator'])) {
    // Redirectăm către pagina de autentificare sau afișăm un mesaj de eroare
    header("Location: autorizare.php");
    //exit();
}
// Extragem id-ul utilizatorului din sesiune
$id_utilizator = $_SESSION['id_utilizator'];

// Interogare pentru a obține produsele din coșul utilizatorului curent
$sql = "SELECT p.denumire, p.pret ,p.imagine ,c.id
        FROM cos_cumparaturi c
        INNER JOIN produse p ON c.id_produs = p.id
        WHERE c.id_utilizator = $id_utilizator";
$result = pg_query($conn, $sql);


?>

<div class="container">
    <h1 class="text-center">Coș Cumpărături</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                <?php
                // Afisare produse din coșul utilizatorului în listă
                if ($result && pg_num_rows($result) > 0) {
                    while($row = pg_fetch_assoc($result)) {
                        echo '<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">';
                        echo '<div class="d-flex align-items-center">';
                        echo '<img src="' . $row["imagine"] . '" class="img-fluid mr-3" style="max-width: 100px;" alt="Imagine produs">';
                        echo '<span>' . $row["denumire"] . '</span>';
                        echo '</div>';
                        echo '<span class="badge badge-primary badge-pill">' . $row["pret"] . ' lei</span>';
                        echo '<form method="POST" action="sterge_din_cos.php">';
                        echo '<input type="hidden" name="id" value="' . $row["id"] . '">';
                        echo '<button type="submit" class="btn btn-sm btn-danger ml-2"><i class="fas fa-trash"></i> Sterge</button>';
                        echo '</form>';
                        echo '</li>';
                    }
                } else {
                    echo "<li class='list-group-item'>Nu există produse în coș.</li>";
                }
                ?>
            </ul>
            <hr>
            <div class="text-center">
            <strong>
    <?php
    if (isset($_SESSION['id_utilizator'])) {
        // Preia ID-ul utilizatorului din sesiune
        $id_utilizator = $_SESSION['id_utilizator'];

        // Interogare pentru a obține suma prețurilor produselor din coșul utilizatorului
        $sql = "SELECT SUM(p.pret) AS suma_totala
                FROM cos_cumparaturi c
                INNER JOIN produse p ON c.id_produs = p.id
                WHERE c.id_utilizator = $id_utilizator";
        $result = pg_query($conn, $sql);

        // Verificăm dacă interogarea a fost executată cu succes și dacă a returnat un rezultat
        if ($result && pg_num_rows($result) > 0) {
            // Extragem suma totală din rezultatul interogării
            $row = pg_fetch_assoc($result);
            $suma_totala = $row['suma_totala'];

            // Afisează suma totală formatată într-un mod frumos
            echo "<span style='color: green; font-size: 24px;'>Suma totală a produselor din coșul utilizatorului este: <br> <strong>" . $suma_totala . " lei</strong></span>";
        } else {
            // Mesaj de eroare în cazul în care nu s-a găsit niciun produs în coș
            echo "Nu există produse în coș.";
        }
    }
    ?>
</strong>

            </div>
            <button class="btn btn-success btn-block mt-3 ">Finalizează Comanda</button>
            <div class="mb-3"></div>

        </div>
    </div>
</div>


<?php
include 'foter.php';
?>

  <!-- Bootstrap JS (opțional, pentru funcționalități interactive) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
