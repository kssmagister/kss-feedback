<?php
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

$auswahl = $_POST['auswahl'];
$texteingabe = $_POST['texteingabe'];

$sql = "INSERT INTO memoranda (auswahl, texteingabe) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $auswahl, $texteingabe);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
