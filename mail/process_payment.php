<?php
session_start();

// ���� �� ����� ������
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// ����� ����� FPDF
require($_SERVER['DOCUMENT_ROOT'] . '/mail/fpdf/fpdf.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // ����� ������ Composer

// ����� PDF
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

// ��� PDF
$pdf->Output('F', 'invoice.pdf');

// ����� PHPMailer
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // ������ SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com'; // ����� ����������
    $mail->Password = 'your_password'; // ���� ������ ������ ������
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // ������� ������
    $mail->setFrom('your_email@gmail.com', 'Your Name');
    $mail->addAddress('customer_email@example.com', $_SESSION['username']); // ����� �������

    // ����� ��������
    $mail->addAttachment('invoice.pdf');

    // ����� ������
    $mail->isHTML(true);
    $mail->Subject = 'Your Invoice';
    $mail->Body    = 'Thank you for your purchase. Please find your invoice attached.';

    // ����� ������
    $mail->send();
    echo 'Payment successful, invoice has been sent!';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
