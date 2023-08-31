<?php
session_start();

$adminUsername = "admin";
$adminPassword = "Theoderich007!";

$username = $_POST['username'];
$password = $_POST['password'];

if ($username === $adminUsername && $password === $adminPassword) {
    $_SESSION['loggedIn'] = true;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Ungültiger Benutzername oder Passwort.']);
}
?>
