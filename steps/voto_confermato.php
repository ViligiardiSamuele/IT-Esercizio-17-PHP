<?php
session_start();
$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "UPDATE candidati SET voti = voti + 1 WHERE id_candidato = '" . $_SESSION['id_candidato'] . "'";
$response = mysqli_query($mysqli, $query)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$mysqli->close() or die ("Chiusura connessione fallita" . $mysqli->error . " " . $mysqli->errno);

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
        <div class="card w-50 mx-auto mb-3">
            <div class="card-body">
                <h1>Registrazione del voto</h1>
                <p>Il suo voto è stato correttamente registrato<br>Grazie</p>
                <a class="btn btn-primary" role="button" aria-disabled="true" href="../index.php">Home</a>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>
    ';