<?php
require_once '../cnx1.php';
$db = Cnx1::getConnexion();

$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['id'])) {
    $notificationId = $data['id'];

    $stmt = $db->prepare("DELETE FROM notifications WHERE id = :id");
    $stmt->bindValue(':id', $notificationId, PDO::PARAM_INT);
    $stmt->execute();
    
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
