<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function send_mail($to, $subject, $message) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
        $mail->SMTPAuth = true;
        $mail->Username = 'restaurantroyalburgers@gmail.com'; // SMTP username
        $mail->Password = 'uzgzzfqskqrglemn'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('restaurantroyalburgers@gmail.com', 'Restaurant'); // From email and name
        $mail->addAddress($to); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        error_log("Mailer Error: {$mail->ErrorInfo}"); // Log the error
        return false; // Email sending failed
    }
}
?>
