<?php
session_start();

// Uberprüfung, ob der Benutzer eingeloggt ist
if (!isset($_SESSION['user_ID'])) {
    header("Location: Anmelden.php");
    exit();
}
include 'db_connection.php';
// Initialisierung der Message-Variable
$message = ''; // Initialisierung, um die Warnung zu vermeiden

// Verarbeitung der Daten aus dem POST-Request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Daten von der Bestellung abrufen
    $totalPrice = floatval($_POST['totalPrice']);
    $packages = intval($_POST['packages']);
    $users = intval($_POST['users']);
    $user_id = $_SESSION['user_ID']; 

    // Zus?tzliche Informationen
    $artikel_name = $_POST['artikel_name']; // Name des Artikels
    $grosse = $_POST['grosse']; // Gr??e des Artikels
    $base_price = floatval($_POST['base_price']); // Basispreis

    // Berechnungen für zus?tzliche Anzahl und Preis
    $zusatzanzahl = $users - ($packages * 3); // Zus?tzliche Benutzer
    $zusatzpreis = $totalPrice - ($packages * $base_price); // Zusatzpreis

    // Aktuelles Datum
    $datum = date("Y-m-d H:i:s");

    // Transaktion starten
    $conn->begin_transaction();

    try {
        // Rechnung in die Tabelle 'rechnung' einfügen
        $sql_invoice = "INSERT INTO rechnung (user_ID, Datum) VALUES (?, ?)";
        $stmt_invoice = $conn->prepare($sql_invoice);
        $stmt_invoice->bind_param("is", $user_id, $datum);
        $stmt_invoice->execute();
        $rechnung_id = $stmt_invoice->insert_id; // ID der neuen Rechnung
        $stmt_invoice->close();
        $_SESSION['rechnung_id'] = $rechnung_id;
        // Artikel in die Tabelle 'artikel' einfügen (ohne Preis)
        $sql_artikel = "INSERT INTO artikel (Artikelname, Benutzeranzahl, Grosse, Zusatzanzahl, Zusatzpreis)
                        VALUES (?, ?, ?, ?, ?)";
        $stmt_artikel = $conn->prepare($sql_artikel);
        $stmt_artikel->bind_param("siiii", $artikel_name, $users, $grosse, $zusatzanzahl, $zusatzpreis); // totalPrice removed from this statement
        $stmt_artikel->execute();
        $artikel_id = $stmt_artikel->insert_id; // ID des neuen Artikels
        $stmt_artikel->close();

        // Rechnung Details in die Tabelle 'rechnung_details' einfügen (mit Preis)
        $sql_details = "INSERT INTO rechnung_details (Rechnung_ID, Artikel_ID, menge, Preis) VALUES (?, ?, ?, ?)";
        $stmt_details = $conn->prepare($sql_details);
        $stmt_details->bind_param("iiid", $rechnung_id, $artikel_id, $packages, $totalPrice); // 'd' for float/double
        $stmt_details->execute();
        $stmt_details->close();

        // Transaktion committen
        $conn->commit();
        
        // Erfolgsmeldung
        $message = "Die Bestellung wurde erfolgreich aufgegeben! Gesamtpreis: " . number_format($totalPrice, 2) . " Euro";
       header("Location: Rechnung_senden.php");
        exit();
    } catch (Exception $e) {
        // Bei einem Fehler rollbacken
        $conn->rollback();
        $message = "Fehler bei der Bestellung: " . $e->getMessage();
    }
}

// Verbindung zur Datenbank schlie?en
$conn->close();
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestellbest?tigung</title>
    <link rel="stylesheet" href="place_order.css"> <!-- ???? ???? CSS ??????? -->
    
</head>
<body>

    <div class="container">
        <div class="message"><?php echo $message; ?></div>
        <button class="back-button" onclick="window.location.href='Home.php';">Zur&uuml;ck zur Startseite</button>
    </div>

</body>
</html>
