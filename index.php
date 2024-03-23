<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Magazin Online</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .footer {
      background-color: #343a40;
      color: #fff;
      padding: 20px 0;
    }
  </style>
</head>
<body>
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
          <a class="dropdown-item" href="#">Electronice</a>
          <a class="dropdown-item" href="#">Îmbrăcăminte</a>
          <a class="dropdown-item" href="#">Accesorii</a>
          <a class="dropdown-item" href="#">Cărți</a>
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

<div class="container mt-5">
  <h1>Bine ați venit în Magazinul Nostru Online!</h1>
  <p>Descoperiți cele mai bune oferte și produse de calitate.</p>
  <p>Explorați gama noastră variată de produse și bucurați-vă de experiența de cumpărare convenabilă.</p>

  <div class="row">
    <div class="col-md-4">
      <div class="card mb-4 shadow-sm">
        <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Produs 1</h5>
          <p class="card-text">Descriere produs 1.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">Adaugă în coș</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Detalii</button>
            </div>
            <small class="text-muted">Preț: $10</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- Repetă structura pentru fiecare produs -->
      <div class="card mb-4 shadow-sm">
        <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Produs 1</h5>
          <p class="card-text">Descriere produs 1.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">Adaugă în coș</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Detalii</button>
            </div>
            <small class="text-muted">Preț: $10</small>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <!-- Repetă structura pentru fiecare produs -->
      <div class="card mb-4 shadow-sm">
        <img src="https://via.placeholder.com/300" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Produs 1</h5>
          <p class="card-text">Descriere produs 1.</p>
          <div class="d-flex justify-content-between align-items-center">
            <div class="btn-group">
              <button type="button" class="btn btn-sm btn-outline-secondary">Adaugă în coș</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Detalii</button>
            </div>
            <small class="text-muted">Preț: $10</small>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<footer class="footer mt-auto py-4">
  <div class="container text-center">
    <span>© 2024 Magazin Online. Toate drepturile rezervate.</span>
  </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
