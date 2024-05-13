<?php
require_once '../../../model/reclamation.php';
require_once '../../../cnx1.php';
require_once __DIR__ . '/../PHPMailer-6.9.1/src/Exception.php';

require_once __DIR__ . '/../PHPMailer-6.9.1/src/PHPMailer.php';
require_once __DIR__ . '/../PHPMailer-6.9.1/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class ReclamationController {
    private $db;
    
    // Constructeur pour initialiser la connexion à la base de données
    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

   public function getReclamations() {
        try {
            $sql = "SELECT * FROM reclamation";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }


    public function getReclamationById($id) {
        $stmt = $this->db->prepare("SELECT * FROM reclamation WHERE idReclamation = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getReclamationsWithResponses() {
        $stmt = $this->db->prepare(
            "SELECT r.*, rp.texteReponse AS reponseTexte, rp.dateReponse ,rp.idReponse
            FROM reclamation r 
            LEFT JOIN reponse rp ON r.idReclamation = rp.idReclamation"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //**********************************************AJOUT REPONSE ********* */
    public function addReponseAndUpdateStatus($idReclamation, $reponse) {
        try {
            $this->db->beginTransaction();
    
            // Insérer la réponse dans la base de données
            $stmt = $this->db->prepare("INSERT INTO reponse (idReclamation, texteReponse, dateReponse) VALUES (?, ?, NOW())");
            if (!$stmt->execute([$idReclamation, $reponse])) {
                error_log('Insert Reponse Error: ' . implode(":", $stmt->errorInfo()));
                throw new Exception("Erreur lors de l'ajout de la réponse.");
            }
            
            // Mettre à jour le statut de la réclamation
            $stmt = $this->db->prepare("UPDATE reclamation SET status = 'Traité' WHERE idReclamation = ?");
            if (!$stmt->execute([$idReclamation])) {
                error_log('Update Reclamation Error: ' . implode(":", $stmt->errorInfo()));
                throw new Exception("Erreur lors de la mise à jour du statut de la réclamation.");
            }
    
            // Récupérer l'email de l'utilisateur lié à la réclamation
            $email = $this->getUserEmailByReclamationId($idReclamation);
            if (!$email) {
                throw new Exception("Aucun email associé à cette réclamation.");
            }
    
            // Envoyer l'email au client
            if ($email) {
                $this->sendEmailToClient($email, "Reponse pour votre reclamation", $reponse);
            }
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Failed to add response and update status: ' . $e->getMessage());
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    

 


 /*   public function addReponseAndUpdateStatus($idReclamation, $reponse) {
        try {
            $this->db->beginTransaction();
    
            $stmt = $this->db->prepare("INSERT INTO reponse (idReclamation, texteReponse, dateReponse) VALUES (?, ?, NOW())");
            if (!$stmt->execute([$idReclamation, $reponse])) {
                $error = $stmt->errorInfo();
                error_log('Insert Error: ' . $error[2]);
                throw new Exception('Insert Error: ' . $error[2]);
            }
    
            $stmt = $this->db->prepare("UPDATE reclamation SET status = 'Traité' WHERE idReclamation = ?");
            if (!$stmt->execute([$idReclamation])) {
                $error = $stmt->errorInfo();
                error_log('Update Error: ' . $error[2]);
                throw new Exception('Update Error: ' . $error[2]);
            }
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log('Transaction Failed: ' . $e->getMessage());
            echo "Error: " . $e->getMessage();
            return false;
        }
    }*/
    
    public function updateResponse($responseId, $newText) {
        $stmt = $this->db->prepare("UPDATE reponse SET texteReponse = ? WHERE idReponse = ?");
        return $stmt->execute([$newText, $responseId]);
    }

    public function getReponseById($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM reponse WHERE idReponse = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne un seul résultat ou false si aucun n'est trouvé
        } catch (PDOException $e) {
            die("Erreur de base de données : " . $e->getMessage());
        }
    }

    public function deleteResponse($responseId) {
        try {
            $stmt = $this->db->prepare("DELETE FROM reponse WHERE idReponse = ?");
            $stmt->execute([$responseId]);
            return $stmt->rowCount() > 0; // Retourne true si une ligne a été affectée
        } catch (PDOException $e) {
            error_log('Erreur lors de la suppression : ' . $e->getMessage());
            return false;
        }
    }
//****************** recuperer les notifications*********************************** */
    function fetchNotifications() {
        $sql = "SELECT * FROM notifications WHERE is_read = FALSE ORDER BY created_at DESC";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

 // mail user ************************************
 private function getUserEmailByReclamationId($idReclamation) {
    $stmt = $this->db->prepare("SELECT u.email FROM user u JOIN reclamation r ON u.id = r.idUser WHERE r.idReclamation = ?");
    $stmt->execute([$idReclamation]);
    return $stmt->fetchColumn(); // Cela devrait retourner l'email ou false si aucun résultat n'est trouvé.
}

   /*****************************mail**************************** */ 
    private function sendEmailToClient($clientEmail, $subject, $body) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Corrected the typo
            $mail->SMTPAuth = true;
            $mail->Username = 'bougattayaroua290@gmail.com';
            $mail->Password = 'samj uayz oznk wkgz'; // Use App Password if 2FA is enabled
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
    
            $mail->setFrom('noreply@example.com', 'Support Team');
            $mail->addAddress($clientEmail);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->AddEmbeddedImage('../images/IMG_3819.jpg', 'image_cid');
            $mail->Body = '
            <html>
                <head>
                    <title>Mise à jour sur votre réclamation</title>
                </head>
                <body>
                    <p>Bonjour,</p>
    
                    <p>Nous vous écrivons pour vous informer des dernières mises à jour concernant votre réclamation. Nous avons examiné votre cas et sommes heureux de vous annoncer que votre réclamation a été traitée avec succès.</p>
    
                    <p>Veuillez trouver les détails de la résolution dans votre espace dans le site .</p>
                   
                    <p>Nous espérons que la résolution de votre problème a été satisfaisante. Si vous avez des autres questions ou si vous avez besoin une aide supplémentaire, merci de nous contacter.</p>
    
                    <p>Merci davoir choisi notre service.</p>

                    <br>
                    <br>

                    <img style="width: 200px; height: auto;" src="cid:image_cid">
                   <b> <p style="color:red">Cordialement,</p></b>
                    

                  <b>  <p style="color:red">Entreprise voyage visita </p></b>
                    
     

       
                </body>
            </html>';
    
            $mail->send();
            echo "Email sent successfully to $clientEmail";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    }


    
    
    

}


?>
