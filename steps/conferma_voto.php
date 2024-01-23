<?php
session_start();
$_SESSION['id_candidato'] = $_POST['id_candidato'];
$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "SELECT c.cognome, c.nome, c.id_lista FROM candidati c WHERE c.id_candidato = " . $_POST['id_candidato'] . "";
$candidato = mysqli_query($mysqli, $query)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);
$candidato = mysqli_fetch_array($candidato, MYSQLI_ASSOC);

$query = "SELECT l.nome_lista FROM liste l WHERE l.id_lista = " . $_SESSION['id_lista'] . "";
$lista = mysqli_query($mysqli, $query)
or die ("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);
$lista = mysqli_fetch_array($lista, MYSQLI_ASSOC);

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
        <h1 class="text-center">La prima fase del voto prevede la selezione della lista</h1>
        <div class="card w-50 mx-auto mb-3">
            <div class="card-body">
                    <h3>
                        Scelga la lista a cui assegnare il Suo voto dall\'elenco a comparsa qui sotto.
                    </h3>
                <p>appena selezionata la lista, le verrà proposto l\'elenco dei candidati per quella lista</p>
            </div>
        </div>
        <div class="card w-50 mx-auto mb-3">
            <div class="card-body text-center">
                <h3>Lista: ' . $lista['nome_lista'] . '</h3>
                <h3>Candidato: ' . $candidato['cognome'] . ' ' . $candidato['nome'] . '</h3>
                
                <a class="btn btn-primary" role="button" aria-disabled="true" href="voto_confermato.php">Conferma</a>
                <a class="btn btn-primary" role="button" aria-disabled="true" href="selezione_lista.php">Annulla</a>
            </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>
    ';