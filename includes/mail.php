<?php
/**
 * PHPMailer Configuration & Helper for AK Energies
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../PHPMailer/src/Exception.php';
require_once __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer/src/SMTP.php';

// ==========================================
// SMTP SETTINGS
// Configure these with your email credentials
// ==========================================
if (!defined('SMTP_HOST')) {
    define('SMTP_HOST', 'smtp.gmail.com');
    define('SMTP_PORT', 587);
    define('SMTP_SECURE', PHPMailer::ENCRYPTION_STARTTLS);
    define('SMTP_AUTH', true);
    define('SMTP_USER', 'kangaisiva15@gmail.com');
    define('SMTP_PASS', 'yizedujeizmvmsii');
    define('MAIL_FROM_EMAIL', 'kangaisiva15@gmail.com');
    define('MAIL_FROM_NAME', 'AK Energies Website');
    define('ADMIN_NOTIFICATION_EMAIL', 'kangaisiva15@gmail.com');
}

/**
 * Send an email using PHPMailer with fallback.
 *
 * @param string $toEmail
 * @param string $toName
 * @param string $subject
 * @param string $htmlBody
 * @param string $replyToEmail
 * @param string $replyToName
 * @return bool
 */
function send_email($toEmail, $toName, $subject, $htmlBody, $replyToEmail = '', $replyToName = '') {
    $mail = new PHPMailer(true);

    try {
        // SMTP Server configuration
        $mail->isSMTP();
        $mail->Host       = SMTP_HOST;
        $mail->SMTPAuth   = SMTP_AUTH;
        $mail->Username   = SMTP_USER;
        $mail->Password   = SMTP_PASS;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port       = SMTP_PORT;
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 10;

        // Sender & Recipient
        $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
        $mail->addAddress($toEmail, $toName);

        // Reply-To header
        if (!empty($replyToEmail)) {
            $mail->addReplyTo($replyToEmail, $replyToName ?: $replyToEmail);
        }

        // Email format and body
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = strip_tags($htmlBody);

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("PHPMailer error: " . $mail->ErrorInfo);

        // Fallback to standard mail() if SMTP is not yet configured or fails
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8\r\n";
        $headers .= "From: " . MAIL_FROM_NAME . " <" . MAIL_FROM_EMAIL . ">\r\n";
        if (!empty($replyToEmail)) {
            $headers .= "Reply-To: $replyToEmail\r\n";
        }
        @mail($toEmail, $subject, $htmlBody, $headers);
        return false;
    }
}

/**
 * Send a formatted notification email when a customer submits the contact form.
 *
 * @param string $name
 * @param string $email
 * @param string $phone
 * @param string $message
 * @return bool
 */
function send_contact_email($name, $email, $phone, $message, $service = 'General Consultation') {
    $subject = "New Inquiry: [" . $service . "] from " . $name . " · AK Energies";

    $safeName    = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
    $safeEmail   = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $safePhone   = htmlspecialchars($phone ?: 'Not provided', ENT_QUOTES, 'UTF-8');
    $safeService = htmlspecialchars($service ?: 'General Consultation', ENT_QUOTES, 'UTF-8');
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));
    $date        = date('d M Y, h:i A');

    $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
</head>
<body style="margin:0; padding:20px; background-color:#f4f6fb; font-family:'Segoe UI', Arial, sans-serif;">
    <div style="max-width:600px; margin:0 auto; background:#ffffff; border:1px solid #e2e8f0; border-radius:12px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.05);">
        <div style="background:#0F2647; padding:24px 28px; text-align:center;">
            <h2 style="color:#ffffff; margin:0; font-size:21px; font-weight:700;">New Contact Form Enquiry</h2>
            <p style="color:#b8dc6d; margin:6px 0 0; font-size:13.5px; font-weight:500;">AK Energies Website Notification</p>
        </div>
        <div style="padding:28px 30px;">
            <p style="margin:0 0 20px; font-size:14.5px; color:#334155; line-height:1.5;">You have received a new inquiry from the website contact page:</p>
            
            <table style="width:100%; border-collapse:collapse; font-size:14px; margin-bottom:22px;">
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:10px 0; font-weight:600; color:#64748b; width:120px;">Name:</td>
                    <td style="padding:10px 0; color:#0F2647; font-weight:600;">{$safeName}</td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:10px 0; font-weight:600; color:#64748b;">Service:</td>
                    <td style="padding:10px 0; color:#67812F; font-weight:700;">{$safeService}</td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:10px 0; font-weight:600; color:#64748b;">Email:</td>
                    <td style="padding:10px 0;"><a href="mailto:{$safeEmail}" style="color:#2563eb; text-decoration:none; font-weight:500;">{$safeEmail}</a></td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:10px 0; font-weight:600; color:#64748b;">Phone:</td>
                    <td style="padding:10px 0; color:#334155;">{$safePhone}</td>
                </tr>
                <tr style="border-bottom:1px solid #f1f5f9;">
                    <td style="padding:10px 0; font-weight:600; color:#64748b;">Date:</td>
                    <td style="padding:10px 0; color:#64748b;">{$date}</td>
                </tr>
            </table>

            <div style="margin-bottom:24px;">
                <div style="font-weight:700; color:#475569; font-size:12.5px; text-transform:uppercase; letter-spacing:.05em; margin-bottom:8px;">Customer Message:</div>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:16px 18px; font-size:14px; line-height:1.6; color:#1e293b;">
                    {$safeMessage}
                </div>
            </div>

            <div style="text-align:center; padding-top:10px;">
                <a href="mailto:{$safeEmail}?subject=Re: AK Energies Enquiry" style="display:inline-block; background:#67812F; color:#ffffff; text-decoration:none; padding:12px 26px; border-radius:8px; font-weight:700; font-size:14px; box-shadow:0 2px 6px rgba(103,129,47,0.3);">
                    Reply to Customer &rarr;
                </a>
            </div>
        </div>

        <div style="background:#f8fafc; padding:14px 28px; text-align:center; border-top:1px solid #e2e8f0; font-size:12px; color:#94a3b8;">
            This email was generated automatically by the AK Energies contact form.
        </div>
    </div>
</body>
</html>
HTML;

    return send_email(ADMIN_NOTIFICATION_EMAIL, 'AK Energies Support', $subject, $html, $email, $name);
}
