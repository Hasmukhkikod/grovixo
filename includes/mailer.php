<?php
// includes/mailer.php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/env.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($to, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        $smtpUser = env('SMTP_USERNAME');
        $smtpPass = env('SMTP_PASSWORD');
        if (!$smtpUser || !$smtpPass) {
            throw new Exception('SMTP credentials are not configured. Set SMTP_USERNAME, SMTP_PASSWORD in .env');
        }

        // Server settings
        $mail->isSMTP();
        $mail->Host       = env('SMTP_HOST', 'smtp.gmail.com');
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtpUser;
        $mail->Password   = $smtpPass;
        $mail->SMTPSecure = env('SMTP_ENCRYPTION', 'tls') === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int) env('SMTP_PORT', '587');

        // Recipients
        $mail->setFrom($smtpUser, env('SMTP_FROM_NAME', 'Grovixo Agency'));
        $mail->addAddress($to);

        // Content
        $mail->isHTML(false);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
?>
