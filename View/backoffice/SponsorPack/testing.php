<?php

include_once '../../../Model/SponsorPackModel.php';
include_once "../../../Controller/SponsorPackController.php";

$sponsorPack = new SponsorPackModel("Pack 1", "Description of pack 1", 100.0, 1, new DateTime(), new DateTime(), "image.jpg");
$addSuccess = SponsorPackController::addPack($sponsorPack);
if ($addSuccess) {
    echo "Pack added successfully";
} else {
    echo "Error adding pack";
}
?>
