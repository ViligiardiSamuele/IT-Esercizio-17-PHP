<?php
session_start();
$_SESSION["id_lista"] = -1;
$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);
$query = "SELECT * FROM liste";
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

    <body>
        <h1>La prima fase del voto prevede la selezione della lista</h1>
        <h3>
        Scelga la lista a cui assegnare il Suo voto dall\'elenco a comparsa qui sotto.
        </h3>
        <p>appena selezionata la lista, le verrà proposto l\'elenco dei candidati per quella lista</p>

        <form action="../two/selezione_candidato.php" method="post">
            <select class="form-select" name="id_lista">
                <option selected>Selezionare la lista</option>';

                while ($row = mysqli_fetch_array($response, MYSQLI_ASSOC)){
                    echo '<option value="' . $row['id_lista'] . '">' . $row['nome_lista'] . '</option>';
                }

            echo '</select>
            <button type="submit" class="btn btn-primary">Continua</button>
        </form>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>
    ';