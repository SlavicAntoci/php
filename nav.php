<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Magazinul Meu Online</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Acasă <span class="sr-only">(current)</span></a>
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
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Caută produse" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Caută</button>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Contul Meu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Coș de cumpărături</a>
      </li>
    </ul>
  </div>
</nav>