<?php

$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "
    select c.cognome, c.nome, c.voti,
    (
        c.voti / 
        (
            select SUM(c.voti)
            from candidati c
            where id_lista = '" . $_GET['id_lista'] . "'
        )*100
    ) as '% relativa',
    (
        c.voti /
        (
            select SUM(c.voti)
            from candidati c
        )*100
    ) as '% assoluta'
    from candidati c 
    where c.id_lista = '" . $_GET['id_lista'] . "'
";
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
        <h3>Riepilogo voti per lista</h3>
        <p>- Democrazia sempre -<p>
        <table>
            <thead>
                <th>Cognome</th>
                <th>Nome</th>
                <th>n. voti</th>
                <th>% relativa</th>
                <th>% assoluta</th>
            </thead>
            <tbody>';

            while ($row = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
                echo '
                <tr>
                    <td>'. $row['cognome'] .'</td>
                    <td>'. $row['nome'] .'</td>
                    <td>'. $row['voti'] .'</td>
                    <td>'. $row['% relativa'] .'</td>
                    <td>'. $row['% assoluta'] .'</td>
                </tr>';
            }

echo '  </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

    </html>
    ';
