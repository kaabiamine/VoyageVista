<?php
include_once '../../../Model/SponsorPackModel.php';
include_once "../../../Controller/SponsorPackController.php";
// USER VERIFICATION ===========================================================
include_once '../../../controller/verify_login.php';

if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['id'];
    $role = $_SESSION['role'];
    if ($role == 2) {
        header('Location: ../../login.php');
    }
}else{
    header('Location: ../../login.php');
}
//==============================================================================
$idPack = $_GET['id'];
$deleteSuccess = SponsorPackController::deleteByPackID($idPack);
if ($deleteSuccess) {
    header("Location: AfficherPacks.php");
} else {
    echo "Error deleting pack";
}
?>
