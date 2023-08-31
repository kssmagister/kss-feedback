<?php
session_start();

$response = array("success" => false, "message" => "Unbekannter Fehler");

// Überprüfen Sie, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['loggedIn']) || !$_SESSION['loggedIn']) {
    $response["message"] = "Sie sind nicht eingeloggt.";
    echo json_encode($response);
    exit;
}

$servername = "rutzimp.mysql.db.internal";
$username = "rutzimp_pensat";
$password = "hbr2D3Y=vEbGiWcnjeS7";
$dbname = "rutzimp_pensum2023";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    $response["message"] = "Verbindung zur Datenbank fehlgeschlagen: " . mysqli_connect_error();
    echo json_encode($response);
    exit;
}

$sql = "DELETE FROM memoranda";

if (mysqli_query($conn, $sql)) {
    $response["success"] = true;
    $response["message"] = "Daten erfolgreich gelöscht.";
} else {
    $response["message"] = "Fehler beim Löschen der Daten: " . mysqli_error($conn);
}

mysqli_close($conn);
echo json_encode($response);
?>
