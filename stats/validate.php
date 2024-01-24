<?php
session_start();
$_SESSION['administrator'] = null;

$mysqli = new mysqli("localhost", "root", null, "es17php", 3306)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);

$query = $mysqli->prepare("select id_login from login where nome = ? and pasw = SHA2(?, 256)");
$query->bind_param("ss", $_POST['name'], $_POST['pasw']);
$response = mysqli_query($mysqli, $query)
    or die("Connessione non riuscita" . $mysqli->connect_error . " " . $mysqli->connect_errno);
$mysqli->close() or die("Chiusura connessione fallita" . $mysqli->error . " " . $mysqli->errno);

echo '
<body data-bs-theme="dark">
        <nav class="navbar bg-body-tertiary m-1 mb-3 rounded">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Amministratore - Sistema Elettorale Elettronico</span>
            </div>
        </nav>
        <div class="card">
  <div class="card-body">';

if ($query->num_rows == 1) {
    echo '<h1>Autenticato</h1>
    <a class="btn btn-primary" role="button" aria-disabled="true" href="login.php">Riprova</a>';
    $_SESSION['administrator'] = true;
} else {
    echo '<h1>Utente inesistente</h1>
    <a class="btn btn-primary" role="button" aria-disabled="true" href="login.php">Riprova</a>';
    $_SESSION['administrator'] = false;
}
echo '
        </div>
    </div>
</body>';