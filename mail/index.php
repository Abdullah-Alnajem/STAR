<?php
require_once 'mail.php';
$mail->setfrom('mhmwdjwban0@gmail.com','Tamtom');
$mail->addAddress('memati32112@hotmail.com');
$mail->subject = 'MOIN MOIN Werder Bremen';
$mail->Body   = 'this is message <b>PHP Mailer</b>';
$mail->send();
?>