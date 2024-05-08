<?php
require_once __DIR__ . '/../PHPMailer-6.9.1/PHPMailer-6.9.1/src/Exception.php';
require_once __DIR__ . '/../PHPMailer-6.9.1/PHPMailer-6.9.1/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-6.9.1/PHPMailer-6.9.1/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Création d'une nouvelle instance de PHPMailer


// Création d'une nouvelle instance de PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuration du serveur
    $mail->isSMTP();                                      // Définir l'utilisation de SMTP
    $mail->Host       = 'smtp.gmail.com';                 // Spécifier le serveur SMTP principal
    $mail->SMTPAuth   = true;                             // Activer l'authentification SMTP
    $mail->Username   = 'bougattayaroua290@gmail.com';           // SMTP username
    $mail->Password   = 'samj uayz oznk wkgz';    // SMTP password généré
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   // Activer le cryptage TLS, `PHPMailer::ENCRYPTION_SMTPS` recommandé aussi
    $mail->Port       = 587;                              // Port TCP à utiliser

    // Configurer les détails de l'expéditeur et du destinataire
    $mail->setFrom('bougattayaroua290@gmail.com', 'Mailer');        // Qui envoie l'email
    $mail->addAddress('bougattayadoniez806@gmail.com', 'Joe User');     // Ajouter un destinataire

    // Contenu de l'email
    $mail->isHTML(true);                                  // Définir le format de l'email à HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

