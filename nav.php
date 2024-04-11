<?php
// Verificăm dacă sesiunea nu este deja activă
if (session_status() == PHP_SESSION_NONE) {
    // Inițiem sesiunea
    session_start();
}

// Definim o variabilă pentru a verifica dacă utilizatorul este autentificat
$logged_in = false;

// Verificăm dacă utilizatorul este autentificat
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $logged_in = true;
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Magazinul Meu Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="user.php">Acasă <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Produse
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

        <?php
        // Include conexiunea la baza de date
        include 'conect.php';

        // Interogare SQL pentru a extrage denumirile categoriilor
        $sql = "SELECT denumire FROM categorii";
        $result = pg_query($conn, $sql);

        // Creare meniu dropdown
        while ($row = pg_fetch_assoc($result)) {
            echo '<a class="dropdown-item" href="#">' . $row['denumire'] . '</a>';
        }

        // Închidere conexiune
        pg_close($conn);
?>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="noutati.php">Noutati</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="stiri.php">Stiri</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Caută produse" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Caută</button>
    </form>
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="contDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Contul
    </a>
    <div class="dropdown-menu" aria-labelledby="contDropdown">
        <!--<a class="dropdown-item" href="inregistrare.php">Înregistrare</a>
        <a class="dropdown-item" href="autorizare.php">Autentificare</a>-->
        <?php
        if ($logged_in) {
          echo '<a class="dropdown-item text-center" href="profil.php">';
          echo '<img src="imagini\user.png" alt="Imagine utilizator" class="mx-auto d-block rounded-circle" style="width: 70px; height: 70px;">';
          echo '<div>Detalii cont</div>';
          echo '</a>';          
          echo '<a class="dropdown-item text-center" href="delogare.php">Delogare</a>';
        } else {
            echo '<a class="dropdown-item" href="autorizare.php">Autentificare</a>';
            echo '<a class="dropdown-item" href="inregistrare.php">Înregistrare</a>';
        }
        ?>
    </div>
</li>

      <li class="nav-item">
        <a class="nav-link" href="cos_cumparaturi.php">Coș de cumpărături</a>
      </li>
    </ul>
  </div>
</nav>