<?php
// Datenbankverbindungsinformationen
$servername = "localhost";  // Normalerweise "localhost"
$username = "root";         // Datenbankbenutzername
$password = "";             // Datenbankpasswort
$dbname = "users_db";       // Name der Datenbank

// Verbindung zur Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung �berpr�fen
if ($conn->connect_error) {
    die("Verbindung zur Datenbank fehlgeschlagen: " . $conn->connect_error);
}

// �berpr�fen, ob das Formular gesendet wurde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Daten aus dem Formular abrufen (POST)
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $strasse = $_POST['strasse'];
    $hausnummer = $_POST['hausnummer'];
    $PLZ_id = $_POST['PLZ_id'];
    $email = $_POST['email'];
    $telefonnummer = $_POST['telefonnummer'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Passwort verschl�sseln
    $geschlecht = $_POST['geschlecht'];
    $benutzername = $_POST['benutzername'];

    // SQL-Abfrage zum Einf�gen der Daten in die Tabelle
    $sql = "INSERT INTO users (vorname, nachname, strasse, hausnummer, PLZ_id, email, telefonnummer, password, geschlecht, benutzername)
            VALUES ('$vorname', '$nachname', '$strasse', '$hausnummer', '$PLZ_id', '$email', '$telefonnummer', '$password', '$geschlecht', '$benutzername')";

    // Ausf�hren der Abfrage und �berpr�fung, ob der Eintrag erfolgreich war
    if ($conn->query($sql) === TRUE) {
        echo "Benutzer wurde erfolgreich registriert!";
    } else {
        echo "Fehler: " . $sql . "<br>" . $conn->error;
    }
}

// Verbindung zur Datenbank schlie�en
$conn->close();

?>
