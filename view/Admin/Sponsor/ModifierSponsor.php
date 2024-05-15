<?php
include_once '../../../Model/SponsorModel.php';
include_once "../../../Controller/SponsorController.php";

$sponsorID = $_GET['id'];
$sponsorController = new SponsorController();
$sponsor = $sponsorController->getSponsorbyId($sponsorID);
if (!$sponsor) {
    header("Location: AfficherSponsors.php");
    exit;
}
else {
    $sponsorId = $sponsor->getId();
    $sponsorName = $sponsor->getSponsorName();
    $sponsorLogo = $sponsor->getSponsorLogo();
    $sponsorDescription = $sponsor->getSponsorDescription();
    $sponsorEmail = $sponsor->getSponsorEmail();
    $sponsorPhone = $sponsor->getSponsorPhone();
    $sponsorAddress = $sponsor->getSponsorAddress();
    $sponsorWebsite = $sponsor->getSponsorWebsite();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sponsornew = new SponsorModel (
            $sponsorId,
            $_POST['sponsor_name'],
            $_POST['sponsor_logo'],
            $_POST['sponsor_description'],
            $_POST['sponsor_email'],
            $_POST['sponsor_phone'],
            $_POST['sponsor_address'],
            $_POST['sponsor_website']
        );
        echo $sponsornew->getSponsorName();

        $sponsorController->updateSponsor($sponsornew);

        header("Location: AfficherSponsors.php");
    }

}




?>


<!DOCTYPE html>
<html lang="en">

<?php require_once('../components-sponsor/head.php'); ?>

<body>
<!-- partial:../../partials/_navbar.html -->
<?php require_once('../components-sponsor/navbarSponsor.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-8 grid-margin stretch-card d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Sponsor</h4>
                                <p class="card-description">
                                    Update Sponsor is done only by ADMIN
                                </p>
                                <form class="forms-sample" method="post">
                                    <input type="hidden" name="sponsor_id" value="<?= $sponsorId; ?>">
                                    <div class="form-group">
                                        <label for="sponsor_name">Sponsor Name</label>
                                        <input type="text" class="form-control" id="sponsor_name" name="sponsor_name" value="<?= $sponsorName; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_logo">Sponsor Logo</label>
                                        <input type="text" class="form-control" id="sponsor_logo" name="sponsor_logo" value="<?= $sponsorLogo; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_description">Sponsor Description</label>
                                        <textarea class="form-control" id="sponsor_description" name="sponsor_description"><?= $sponsorDescription; ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_email">Sponsor Email</label>
                                        <input type="email" class="form-control" id="sponsor_email" name="sponsor_email" value="<?= $sponsorEmail; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_phone">Sponsor Phone</label>
                                        <input type="text" class="form-control" id="sponsor_phone" name="sponsor_phone" value="<?= $sponsorPhone; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_address">Sponsor Address</label>
                                        <input type="text" class="form-control" id="sponsor_address" name="sponsor_address" value="<?= $sponsorAddress; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_website">Sponsor Website</label>
                                        <input type="text" class="form-control" id="sponsor_website" name="sponsor_website" value="<?= $sponsorWebsite; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Update</button>
                                    <a href="AfficherSponsors.php" class="btn btn-light">Cancel</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php require_once('../components/footer-scripts.php'); ?>
<!--<script src="../input-validation/Reservation.js"></script>-->
</body>

</html>
