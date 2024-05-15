<?php
include_once '../../../Model/SponsorModel.php';
include_once "../../../Controller/SponsorController.php";
$sponsorID = $_GET['id'] ;
$sponsorController = new SponsorController();

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

if ($sponsorID)
{
    $deleteSuccess = $sponsorController->deleteSponsorById($sponsorID);
    if ($deleteSuccess)
    {
        header("Location: AfficherSponsors.php");
    }
    else
    {
        echo "Error deleting sponsor";
    }
}

?>
