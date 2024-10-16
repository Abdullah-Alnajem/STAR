<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users_db";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}
?>