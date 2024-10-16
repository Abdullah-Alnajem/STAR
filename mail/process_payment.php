<?php
session_start();

// ÊÍÞÞ ãä ÊÓÌíá ÇáÏÎæá
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// ÊÖãíä ãßÊÈÉ FPDF
require($_SERVER['DOCUMENT_ROOT'] . '/mail/fpdf/fpdf.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // ÊÍãíá ãßÊÈÇÊ Composer

// ÅäÔÇÁ PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Invoice');

$pdf->SetFont('Arial', '', 12);
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Item: Example Product');
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Price: $100');
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Quantity: 1');
$pdf->Ln(10);
$pdf->Cell(40, 10, 'Total: $100');

// ÍÝÙ PDF
$pdf->Output('F', 'invoice.pdf');

// ÅÚÏÇÏ PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // ÇáãÖíÝ SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com'; // ÈÑíÏß ÇáÅáßÊÑæäí
    $mail->Password = 'your_password'; // ßáãÉ ÇáãÑæÑ ÇáÎÇÕÉ ÈÈÑíÏß
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // ÅÚÏÇÏÇÊ ÇáÈÑíÏ
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress('customer_email@example.com', $_SESSION['username']); // ÚäæÇä ÇáãÓÊáã

    // ÅÑÝÇÞ ÇáÝÇÊæÑÉ
    $mail->addAttachment('invoice.pdf');

    // ãÍÊæì ÇáÈÑíÏ
    $mail->isHTML(true);
    $mail->Subject = 'Your Invoice';
    $mail->Body    = 'Thank you for your purchase. Please find your invoice attached.';

    // ÅÑÓÇá ÇáÈÑíÏ
    $mail->send();
    echo 'Payment successful, invoice has been sent!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
