<?php
include_once '../../../Model/SponsorPackModel.php';
include_once "../../../Controller/SponsorPackController.php";
$idPack = $_GET['id'];
$deleteSuccess = SponsorPackController::deleteByPackID($idPack);
if ($deleteSuccess) {
    header("Location: AfficherPacks.php");
} else {
    echo "Error deleting pack";
}
?>
