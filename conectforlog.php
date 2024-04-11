<?php
// Parametrii de conexiune
$host = "localhost"; // adresa serverului de bază de date
$port = "5432"; // portul utilizat pentru conexiune (implicit este 5432 pentru PostgreSQL)
$dbname = "loguri"; // numele bazei de date la care vrei să te conectezi
$user = "postgres"; // numele utilizatorului pentru accesarea bazei de date
$password = "Slavic2001"; // parola utilizatorului

// Realizarea conexiunii
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verificarea conexiunii
if (!$conn) {
    echo "Eroare la conectare: ";
}

// Închiderea conexiunii
//pg_close($conn);
?>
