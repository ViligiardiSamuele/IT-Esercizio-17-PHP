<?php

$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = "
    select l.nome_lista,
    (
        select SUM(c.voti)
        from candidati c
        where id_lista = l.id_lista
    ) as 'voti',
    cast(
    (
        (
            select SUM(c.voti)
            from candidati c
            where id_lista = l.id_lista
            ) / (
            select sum(c.voti)
            from candidati c
        )
    )*100 as float) as '%'
    from liste l
    order by voti desc, l.nome_lista
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
        <h3>Riepilogo totale voti</h3>
        <table>
            <thead>
                <th>Lista</th>
                <th>Voti</th>
                <th>%</th>
                <th> </th>
            </thead>
            <tbody>';

            while ($row = mysqli_fetch_array($response, MYSQLI_ASSOC)) {
                echo '
                <tr>
                    <td>'. $row['nome_lista'] .'</td>
                    <td>'. $row['voti'] .'</td>
                    <td>'. $row['%'] .'</td>
                    <td> </td>
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
