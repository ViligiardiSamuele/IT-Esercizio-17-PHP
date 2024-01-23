<?php
session_start();

$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "SELECT * FROM liste";
$response = mysqli_query($mysqli, $query)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);
$mysqli->close() or die("Chiusura connessione fallita" . $mysqli->error . " " . $mysqli->errno);

echo '
    <!doctype html>
    <html lang="it">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>es17php</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>

    <body data-bs-theme="dark">
        <nav class="navbar bg-body-tertiary m-1 mb-3 rounded">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Benvenuti nel nuovo Sistema Elettorale Elettronico</span>
        </div>
        </nav>
        <h1 class="text-center">La prima fase del voto prevede la selezione della lista</h1>
        <div class="card w-50 mx-auto mb-3">
            <div class="card-body">
                <h4>
                    Scelga la lista a cui assegnare il Suo voto dall\'elenco a comparsa qui sotto.
                </h4>
                <p>appena selezionata la lista, le verrà proposto l\'elenco dei candidati per quella lista</p>
            </div>
        </div>
        <div class="card mx-auto w-50 text-center">
            <div class="card-body">
            <form action="selezione_candidato.php" method="post">
            <select class="form-select mb-2" name="id_lista">
                <option selected>Selezionare la lista</option>';

while ($row = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
    echo '<option value="' . $row['id_lista'] . '">' . $row['nome_lista'] . '</option>';
}

echo '</select>
            <button type="submit" class="btn btn-primary">Continua</button>
        </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>
    ';
