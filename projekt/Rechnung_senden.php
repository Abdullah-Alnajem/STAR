<?php
session_start(); // Sitzung starten
include 'db_connection.php';
require 'vendor/autoload.php';
require('fpdf/fpdf.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_SESSION['rechnung_id'])) {
    $rechnungID = $_SESSION['rechnung_id']; 
    echo "Rechnung-ID: " . $rechnungID;
} else {
    echo "Rechnung-ID ist nicht vorhanden.";
    exit(); 
}

// PHPMailer konfigurieren, um die E-Mail zu senden
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'test.projekt94@gmail.com';
    $mail->Password = 'erikmppswrqlyvkz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Rechnungsdaten und Benutzerdetails aus der Datenbank abrufen
    $sql = "SELECT r.Rechnung_ID, r.Datum, u.email, u.Vorname, u.Nachname, d.Artikel_ID, d.menge, d.Preis, a.Artikelname, a.Grosse
            FROM rechnung r
            JOIN rechnung_details d ON r.Rechnung_ID = d.Rechnung_ID
            JOIN users u ON r.user_ID = u.user_ID
            JOIN artikel a ON d.Artikel_ID = a.Artikel_ID
            WHERE r.Rechnung_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $rechnungID); // Dynamisch Rechnung_ID verwenden
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Neues PDF erstellen
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, 'Rechnung');
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 12);

        // Rechnungsdetails
        $email = '';
        $vorname = '';
        $nachname = '';
        $pdf->Cell(0, 10, 'Rechnungsdetails:', 0, 1);
        $pdf->Ln(5);
        
        // Tabelle für Artikelinformationen erstellen
        $pdf->Cell(50, 10, 'Artikelname', 1);
        $pdf->Cell(30, 10, 'Grosse', 1);
        $pdf->Cell(30, 10, 'Menge', 1);
        $pdf->Cell(30, 10, 'Preis', 1);
        $pdf->Ln();

        while ($row = $result->fetch_assoc()) {
            if ($email == '') {
                $email = $row['email']; // E-Mail des Benutzers abrufen
                $vorname = $row['Vorname']; // Vorname abrufen
                $nachname = $row['Nachname']; // Nachname abrufen
            }

            // Artikelinformationen zum PDF hinzufügen
            $pdf->Cell(50, 10, $row['Artikelname'], 1);
            $pdf->Cell(30, 10, $row['Grosse'], 1);
            $pdf->Cell(30, 10, $row['menge'], 1);
            $pdf->Cell(30, 10, $row['Preis'], 1);
            $pdf->Ln();
        }

        // Bankdaten hinzufügen
        $pdf->Ln(10);
        $pdf->Cell(0, 10, 'Bankdaten:', 0, 1);
        $pdf->Cell(0, 10, 'Bankname: Tamtom Bank', 0, 1);
        $pdf->Cell(0, 10, 'Kontonummer: 123456789', 0, 1);
        $pdf->Cell(0, 10, 'IBAN: DE89370400440532013000', 0, 1);
        $pdf->Cell(0, 10, 'SWIFT: ABCDDEFFXXX', 0, 1);

        // PDF in einer Datei speichern
        $pdfFilePath = 'invoices/invoice_' . $rechnungID . '.pdf';
        $pdf->Output('F', $pdfFilePath);

        // E-Mail konfigurieren
        $mail->setFrom('from@example.com', 'Cloud Service');
        $mail->addAddress($email); // E-Mail des Benutzers hinzufügen
        $mail->isHTML(true);
        $mail->Subject = 'Rechnung Nr. ' . $rechnungID;
        $mail->Body = 'Hallo ' . $vorname . ' ' . $nachname . ', <br>im Anhang finden Sie die Rechnung für Ihre Bestellung.';
        $mail->addAttachment($pdfFilePath); // PDF als Anhang hinzufügen

        $mail->send();
        echo 'Die Rechnung wurde an ' . $email . ' gesendet.';
    } else {
        echo 'Keine Daten für die Rechnung vorhanden.';
    }

    $stmt->close();
} catch (Exception $e) {
    echo "Die E-Mail konnte nicht gesendet werden. Fehler: {$mail->ErrorInfo}";
}

// Verbindung zur Datenbank schlie?en
$conn->close();
?>
