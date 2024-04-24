<?php

include_once '../../Model/PayementModel.php';
include_once "../../Controller/PayementController.php";
$payementController = new PayementController();
// Check if the ID is provided as a GET parameter
if (isset($_GET['idPayement'])) {
    $idPayement = (int)$_GET['idPayement'];
    $deleted = $payementController->deletePayementById($idPayement);

    if ($deleted) {
        header("Location: AfficherPayements.php");
    } else {
        header("Location: AfficherPayements.php");
    }
} else {
    header("Location: payement-list.php?msg=Payment ID not provided");
}

exit();
?>