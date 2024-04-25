<?php


include_once '../../../Model/SponsorContractModel.php';
include_once "../../../Controller/SponsorContractController.php";

$sponsorContract = new SponsorContractModel(new DateTime(), new DateTime(), "Credit Card", true, new DateTime(), new DateTime(), 1, 1);
$sponsorContractController = new SponsorContractController();
$addSuccess = $sponsorContractController->addContract($sponsorContract);
?>

