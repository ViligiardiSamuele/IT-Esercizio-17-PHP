<?php
session_start();
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
        <h1>Benvenuti nel nuovo Sistema Elettorale Elettronico</h1>
        <p>
        Attraverso questo innnovativo sistema è adesso possibile indicare la propria proferenza di voto scegliendo uno dei candidati proposti da un menu a scorrimento.<br>
        La definitiva conferma della scelta operata equivale alla consegna della tradizionale scheda elettorale al presidente di seggio: presti pertanto molta attenzione alle 
        operazioni che sarà chiamato a svolgere per giungere alla compilazione della Sua scheda di voto e alla conferma della Sua effettiva scelta.
        </p>
        <h3>L\'operazione di voto si svolge in 3 fasi</h3> <span>(corrispondenti a 3 diverse pagine)</span>
        <ul>
            <li>selezione della lista elettorale da una casella combinata</li>
            <li>selezione del candidato appartenente alal suddetta lista</li>
            <li>conferma del voto o ritorno alla prima fase</li>
        </ul>
        <a class="btn btn-primary" role="button" aria-disabled="true" href="steps/one/selezione_lista.php">Seleziona lista</a>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

    </html>
    ';
