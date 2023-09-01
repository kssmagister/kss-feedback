<?php

$adminUsername = "admin";

// Das Passwort wird hier mit dem PASSWORD_DEFAULT-Algorithmus gehasht.
// Der folgende Hash entspricht dem Passwort "Theoderich007!".
// In der Praxis würde der Hash in einer Datenbank oder einer Konfigurationsdatei gespeichert.
$hashedPassword = password_hash("Theoderich007!", PASSWORD_DEFAULT);

?>
