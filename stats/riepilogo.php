<?php

$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "SELECT id_lista, nome_lista  FROM liste";
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

    <body>
        <h1>Pagina di riepilogo</h1>
        <a class="btn btn-primary" role="button" aria-disabled="true" href="riepilogo_totale_voti.php">Riepilogo totale voti</a>
        <h3>Riepilogo voti per lista</h3>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Seleziona la lista
            </button>
            <ul class="dropdown-menu">';

            while ($row = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
                echo '<li><a class="dropdown-item" href="riepilogo_voti_per_lista.php?id_lista=' . $row['id_lista'] . '">' . $row['nome_lista'] . '</a></li>';
            }

            echo '
            </ul>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

    </html>
    ';
