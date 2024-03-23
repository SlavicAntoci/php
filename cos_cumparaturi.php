<?php
// Include fișierul de conexiune la baza de date
include 'conect.php';

// Verifică dacă există o sesiune pentru coșul de cumpărături
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array(); // Inițializează un coș de cumpărături gol
}

// Afisează produsele din coșul de cumpărături
$products = array();
$totalPrice = 0;

foreach ($_SESSION['cart'] as $productId => $quantity) {
    // Interogare pentru a selecta detaliile produsului din coș
    $sql = "SELECT id, nume, pret FROM produse WHERE id = $1";
    $result = pg_query_params($conn, $sql, array($productId));
    
    // Verifică dacă interogarea a returnat un singur rând
    if (pg_num_rows($result) == 1) {
        $row = pg_fetch_assoc($result);
        $product = array(
            'id' => $row['id'],
            'nume' => $row['nume'],
            'pret' => $row['pret'],
            'cantitate' => $quantity
        );
        $totalPrice += $row['pret'] * $quantity;
        $products[] = $product;
    }
}

// Închide conexiunea la baza de date
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coș de Cumpărături</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Coș de Cumpărături</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Nume Produs</th>
                    <th>Preț</th>
                    <th>Cantitate</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?php echo $product['nume']; ?></td>
                    <td><?php echo $product['pret']; ?></td>
                    <td><?php echo $product['cantitate']; ?></td>
                    <td><?php echo $product['pret'] * $product['cantitate']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Total: <?php echo $totalPrice; ?></p>
    </div>
</body>
</html>
