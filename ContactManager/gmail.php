<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPSecure = 'ssl';
    //$mail->Port = 587;
    $mail->Port = 465;

    $mail->Username = 'rakesh@icsweb.in'; // YOUR gmail email
    $mail->Password = 'icsweb.@#123'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('rakesh@icsweb.in', 'Rakesh');
    $mail->addAddress('farooque@icsweb.in', 'Khan Sir');
    $mail->addAddress('aamer@icsweb.in', 'Ammer Sir');
    $mail->addReplyTo('icsweb.rakesh@gmail.com', 'Rakesh'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
?>
