<?php

include_once '../../Model/PayementModel.php';
include_once "../../Controller/PayementController.php";
// USER VERIFICATION ===========================================================
include_once '../../controller/verify_login.php';

if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['id'];
    $role = $_SESSION['role'];
    if ($role != 1 && $role != 2) {

        header('Location: ../login.php');
    }
}else{
    header('Location: ../login.php');
}
//==============================================================================
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