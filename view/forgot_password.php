<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'C:/xampp/htdocs/web_1/vendor/autoload.php';
require 'C:/xampp/htdocs/web_1/controller/user_con.php'; // Assurez-vous de remplacer "chemin_vers_user_con.php" par le chemin réel vers votre fichier user_con.php

// Fonction pour générer un token aléatoire
function generateToken() {
    return bin2hex(random_bytes(32)); // Génère un token aléatoire de 32 octets
}

// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    // Récupère l'e-mail saisi par l'utilisateur
    $email = $_POST['email'];
    
    // Crée une instance de la classe UserCon
    $userCon = new UserCon();

    // Vérifie si l'e-mail existe dans la base de données
    $user = $userCon->getUserByEmail($email);

    if ($user) {
        // L'e-mail existe dans la base de données
        // Génère un token unique
        $token = generateToken();
        
        // Construit le lien de réinitialisation de mot de passe
        $resetLink = "http://localhost/WEB_1/view/reset_password_form.php?token=$token";
        
        // Contenu de l'e-mail
        $subject = "Reset Your Password";
        $message = "Dear user,\n\nPlease click the following link to reset your password:\n$resetLink\n\nIf you did not request this, please ignore this email.";
        
        // Utilisation de PHPMailer pour envoyer l'e-mail
        $mail = new PHPMailer();
        try {
            // Paramètres SMTP
            $mail->isSMTP();
            $mail->Host = 'smtpauths.bluewin.ch';  // Remplacez par votre serveur SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'hase.tritten@bluewin.ch'; // Remplacez par votre nom d'utilisateur SMTP
            $mail->Password = 'Leitwolf1';  // Remplacez par votre mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port = 465; // Port SMTP
            
            // Destinataire et contenu de l'e-mail
            $mail->setFrom('hase.tritten@bluewin.ch', 'voyage visit'); // Remplacez par votre adresse e-mail et votre nom
            $mail->addAddress($email);
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            // Envoi de l'e-mail
            if ($mail->send()) {
                echo "An email with instructions to reset your password has been sent to $email";
            } else {
                echo "Failed to send email. Please try again later.";
            }
        } catch (Exception $e) {
            echo "Error sending email: {$mail->ErrorInfo}";
        }
    } else {
        // L'e-mail n'existe pas dans la base de données
        echo "Email not found in database. Please enter a valid email address.";
    }
}
if (isset($_GET['error'])) {
    // Display the appropriate error message based on the error code
    if ($_GET['error'] == 'email_not_found') {
        echo "Email not found in database. Please enter a valid email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="admin/vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="admin/images/logo.png" alt="logo">
              </div>
              <h6 class="font-weight-light">Forgot your password? Enter your email address below.</h6>
              <form class="pt-3" action="password_reset_confirmation.php" method="POST">
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="mt-3">
                  <input type="submit" style="background-color: #4695CC !important;" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="Reset Password">
                </div>
                <div class="text-center mt-4 font-weight-light">
                  <a href="login.php" class="text-black">Back to login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="admin/vendors/js/vendor.bundle.base.js"></script>
  <script src="admin/js/off-canvas.js"></script>
  <script src="admin/js/hoverable-collapse.js"></script>
  <script src="admin/js/template.js"></script>
  <script src="admin/js/settings.js"></script>
  <script src="admin/js/todolist.js"></script>
</body>

</html>
