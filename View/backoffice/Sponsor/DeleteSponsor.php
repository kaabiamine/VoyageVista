<?php
include_once '../../../Model/SponsorModel.php';
include_once "../../../Controller/SponsorController.php";
$sponsorID = $_GET['id'] ;
$sponsorController = new SponsorController();

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
