<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Înregistrare</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
    <a href="index.php" class="btn btn-primary mb-3">Inapoi</a>

        <h2>Înregistrare</h2>
        <form method="post" action="procesare_inregistrare.php">
            <div class="form-group">
                <label for="nume">Nume:</label>
                <input type="text" class="form-control" id="nume" name="nume" required>
            </div>
            <div class="form-group">
                <label for="prenume">Prenume:</label>
                <input type="text" class="form-control" id="prenume" name="prenume" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="parola">Parolă:</label>
                <input type="password" class="form-control" id="parola" name="parola" required>
            </div>
            <div class="form-group">
                <label for="confirmare_parola">Confirmă parola:</label>
                <input type="password" class="form-control" id="confirmare_parola" name="confirmare_parola" required>
            </div>
            <button type="submit" class="btn btn-primary">Înregistrează-te</button>
        </form>
    </div>
</body>
</html>
