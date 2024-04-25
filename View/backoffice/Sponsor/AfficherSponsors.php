<?php

include_once '../../../Model/SponsorModel.php'; // Include the SponsorModel class
include_once "../../../Controller/SponsorController.php"; // Include the SponsorController class

$sponsorController = new SponsorController();
$sponsors = $sponsorController->getAllSponsors(); // Retrieve all sponsors

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('../components/head.php'); ?>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php require_once('../components/navbar.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_settings-panel.html -->
        <?php require_once('../components/theme-setting-wrapper.php'); ?>
        <!-- partial -->
        <!-- partial:../../partials/_sidebar.html -->
        <?php require_once('../components/sidebar.php'); ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">

                            <div class="card-body">
                                <a href="AjouterSponsor.php" class="btn btn-primary m-4">Add sponsor</a>
                                <h4 class="card-title">Liste des Sponsors</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Logo</th>
                                            <th>Description</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Website</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($sponsors as $sponsor) : ?>
                                            <tr>
                                                <td><?php echo $sponsor->getId(); ?></td>
                                                <td><?php echo $sponsor->getSponsorName(); ?></td>
                                                <td><?php echo $sponsor->getSponsorLogo(); ?></td>
                                                <td><?php echo $sponsor->getSponsorDescription(); ?></td>
                                                <td><?php echo $sponsor->getSponsorEmail(); ?></td>
                                                <td><?php echo $sponsor->getSponsorPhone(); ?></td>
                                                <td><?php echo $sponsor->getSponsorAddress(); ?></td>
                                                <td><?php echo $sponsor->getSponsorWebsite(); ?></td>
                                                <td>
                                                    <a href="ModifierSponsor.php?id=<?php echo $sponsor->getId(); ?>"
                                                       class="btn btn-warning">Edit</a>
                                                    <a href="DeleteSponsor.php?id=<?php echo $sponsor->getId(); ?>&action=delete"
                                                       class="btn btn-danger">Delete</a>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<?php require_once('../components/footer-scripts.php'); ?>
</body>

</html>
