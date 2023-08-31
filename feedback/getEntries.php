<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    die("Zugriff verweigert!");
}

$servername = "rutzimp.mysql.db.internal";
$username = "rutzimp_pensat";
$password = "hbr2D3Y=vEbGiWcnjeS7";
$dbname = "rutzimp_pensum2023";

// Verbindung erstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung überprüfen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT texteingabe FROM memoranda";
$result = $conn->query($query);

$entries = [];

while($row = $result->fetch_assoc()) {
    $entries[] = $row;
}

echo json_encode($entries);
?>
