<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../../vendor/autoload.php';  // Adjust the path as needed
include_once '../../../Model/SponsorContractModel.php';
include_once "../../../Controller/SponsorContractController.php";

$controller = new SponsorContractController();

// Check if the 'id' GET parameter is set
if (isset($_GET['id'])) {
    $contractId = intval($_GET['id']);

    // Get contract and sponsor information before toggling the status
    $contract = $controller->getContractWithSponsor($contractId);

    if ($contract) {
        $success = $controller->toggleContractStatus($contractId);

        if ($success !== false) {
            $mail = new PHPMailer(true);  // Passing `true` enables exceptions

            try {
                // Server settings
                // $mail->SMTPDebug = 2;                                 // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'example@gmail.com';           // SMTP username
                $mail->Password = 'pwd';                    // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 25;                                    // TCP port to connect to

                // Recipients
                $mail->setFrom('user.user@gmail.com', 'Mailer');
                //$mail->addAddress($contract['sponsor_email'], $contract['sponsor_name']);     // Add a recipient
                //$mail->addAddress('farouk.chalghoumi031@gmail.com' , 'farouk chalghoumi');
                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Contract Status Updated';
                $mail->Body    = "Dear " . $contract['sponsor_name'] . ",<br><br>";
                $mail->Body   .= "The status of your contract (ID: $contractId) has been updated to: ";
                $mail->Body   .= $success ? 'Active' : 'Inactive';
                $mail->Body   .= ".<br><br>Regards,<br>Your Company Name";
                $mail->AltBody = "Dear " . $contract['sponsor_name'] . ",\n\n";
                $mail->AltBody .= "The status of your contract (ID: $contractId) has been updated to: ";
                $mail->AltBody .= $success ? 'Active' : 'Inactive';
                $mail->AltBody .= ".\n\nRegards,\nYour Company Name";

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            }

            // Redirect back to the contracts page
            header('Location: AfficherSponsorContracts.php');
            exit();
        } else {
            echo "Failed to toggle status.";
        }
    } else {
        echo "Contract not found.";
    }
} else {
    echo "No contract ID provided.";
}
?>
