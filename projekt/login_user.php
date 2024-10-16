<?php
session_start();
include 'db_connection.php'; // Verbindung zur Datenbank herstellen


// Verarbeitung des POST-Requests
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pr�fen, ob die Eingabe gesetzt ist
    if (isset($_POST['benutzername_email']) && isset($_POST['password'])) {
        $benutzername_email = $_POST['benutzername_email'];
        $password = $_POST['password'];

        // Verwende ein vorbereitetes Statement, um SQL-Injection zu vermeiden
        $sql = "SELECT * FROM users WHERE benutzername = ? OR email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $benutzername_email, $benutzername_email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Pr�fen, ob Benutzer gefunden wurde
        if ($result->num_rows > 0) {
            // Benutzer gefunden
            $user = $result->fetch_assoc();

            // Passwort �berpr�fen
            if (password_verify($password, $user['password'])) {
                // Login erfolgreich - Benutzer in die Session speichern
                $_SESSION['user_ID'] = $user['user_ID'];
                $_SESSION['username'] = $user['benutzername'];
                $_SESSION['role'] = $user['role'];

                // Weiterleitung je nach Rolle
                if ($user['role'] == 'Admin' || $user['role'] == 'Superadmin') {
                    header("Location: admin_dashboard.php"); // Admin-Dashboard
                } else {
                    header("Location: home.php"); // Normale Benutzer zur Home-Seite
                }
                exit();
            } else {
                echo "Falsches Passwort!";
            }
        } else {
            echo "Kein Benutzer mit diesem Benutzernamen oder dieser E-Mail gefunden!";
        }

        $stmt->close(); // Schlie?e das Statement
    } else {
        echo "Bitte geben Sie sowohl einen Benutzernamen oder eine E-Mail als auch ein Passwort ein!";
    }
}

// Verbindung schlie?en
$conn->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellbest?tigung</title>
    <link rel="stylesheet" href="place_order.css"> 
    
</head>
<body>

  
</body>
</html>