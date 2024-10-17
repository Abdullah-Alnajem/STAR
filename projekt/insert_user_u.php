<?php
session_start();
// Verbindungsdaten für die MySQL-Datenbank
$servername = "localhost";  // Servername, in XAMPP normalerweise "localhost"
$username = "root";         // Standard-MySQL-Benutzername in XAMPP
$password = "";             // Standard-MySQL-Passwort in XAMPP ist leer
$dbname = "users_db"; // Name der Datenbank, die du in phpMyAdmin erstellt hast

// Verbindung zur MySQL-Datenbank herstellen
$conn = new mysqli($servername, $username, $password, $dbname);

// Verbindung prüfen
if ($conn->connect_error) {
    die("Verbindung fehlgeschlagen: " . $conn->connect_error);
}

// Eingaben aus dem Formular holen
$benutzername = $_POST['benutzername'];
$email = $_POST['email'];

// SQL-Query, um Benutzer basierend auf Benutzername oder E-Mail zu finden
$sql = "SELECT * FROM users WHERE benutzername = '$benutzername'";
$result = $conn->query($sql);

// Prüfen, ob Benutzer gefunden wurde
if ($result->num_rows > 0) {
    // Benutzer gefunden
    echo "Benutzername bereits vergeben.";
} else {
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "E-Mail bereits vergeben.";
}else{
// Daten aus dem Formular holen
$vorname = $_POST['vorname'];
$nachname = $_POST['nachname'];
$email = $_POST['email'];
$strasse = $_POST['strasse'];
$hausnummer = $_POST['hausnummer'];
$plz_id = $_POST['plz_id'];
$firma = $_POST['firma'];
$telefonnummer = $_POST['telefonnummer'];
$password = $_POST['password'];  // Tipp: Passwort sollte normalerweise gehasht werden
$geschlecht = $_POST['geschlecht'];
$username = $_POST['benutzername'];
$payment_method = $_POST['payment_method'];

// Passwort hashen (optional, empfohlen)
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// SQL-Insert-Query vorbereiten
$sql = "INSERT INTO users (user_id, vorname, nachname, role, strasse, hausnummer, plz_id, email, firma, telefonnummer, password, geschlecht, benutzername, payment_method)
        VALUES (NULL, '$vorname', '$nachname', 'User', '$strasse', '$hausnummer', '$plz_id', '$email', '$firma', '$telefonnummer', '$hashed_password', '$geschlecht', '$benutzername', '$payment_method')";

// Daten in die Datenbank einfügen und Erfolg prüfen
if ($conn->query($sql) === TRUE) {
    $_SESSION['user_ID'] = $conn->insert_id; // user_id in der Sitzung speichern
    echo "Neuer Datensatz erfolgreich eingefügt!";
            // Benutzer nach erfolgreicher Registrierung weiterleiten (optional)
            header("Location: Home.php");
            exit();
} else {
    echo "Fehler: " . $sql . "<br>" . $conn->error;
}
}
}
// Verbindung schließen
$conn->close();
?>
