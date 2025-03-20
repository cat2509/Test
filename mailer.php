<?php

// Load PHPMailer classes
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

try {
    $mail = new PHPMailer(true);
    
    // Enable SMTP debugging (Optional: Uncomment for troubleshooting)
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;

    // SMTP Settings
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "sanaaakadam@gmail.com";
    $mail->Password = "lpqt keke dptb ikpb"; // Replace with App Password

    // Email format
    $mail->isHTML(true);

    return $mail;
} catch (Exception $e) {
    error_log("Mailer Error: " . $mail->ErrorInfo);
    return null;
}
