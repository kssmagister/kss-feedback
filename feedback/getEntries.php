<?php
session_start();

// Überprüfen, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    die("Zugriff verweigert!");
}

$servername = "XXX";
$username = "XXX";
$password = "XXX";
$dbname = "XXX";

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
