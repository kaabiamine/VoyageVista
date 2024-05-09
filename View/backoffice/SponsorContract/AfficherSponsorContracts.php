<?php

include_once '../../../Model/SponsorContractModel.php'; // Include the SponsorContractModel class
include_once "../../../Controller/SponsorContractController.php"; // Include the SponsorContractController class

$sponsorContractController = new SponsorContractController();
$contracts = $sponsorContractController->getAllContracts(); // Retrieve all sponsor contracts

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
                                <a href="AjouterSponsorContract.php" class="btn btn-primary m-4">Add Sponsor Contract</a>
                                <h4 class="card-title">List of Sponsor Contracts</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Payment Method</th>
                                            <th>Contract Status</th>
                                            <th>Sponsor Name</th>
                                            <th>Pack Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($contracts as $contract) : ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($contract['id']); ?></td>
                                                <td><?php echo htmlspecialchars($contract['start_date']); ?></td>
                                                <td><?php echo htmlspecialchars($contract['end_date']); ?></td>
                                                <td><?php echo htmlspecialchars($contract['payement_method']); ?></td>
                                                <td>
                                                    <a href="UpdateStatusContract.php?id=<?php echo htmlspecialchars($contract['id']); ?>" class="btn <?php echo $contract['contract_status'] ? 'btn-success' : 'btn-danger'; ?>">
                                                        <?php echo $contract['contract_status'] ? 'Active' : 'Inactive'; ?>
                                                    </a>
                                                </td>

                                                <td><?php echo htmlspecialchars($contract['sponsor_name']); ?></td>
                                                <td><?php echo htmlspecialchars($contract['pack_name']); ?></td>
                                                <td>
                                                    <a href="ModifierSponsorContract.php?id=<?php echo htmlspecialchars($contract['id']); ?>"
                                                       class="btn btn-warning">Edit</a>
                                                    <a href="DeleteSponsorContract.php?id=<?php echo htmlspecialchars($contract['id']); ?>&action=delete"
                                                       class="btn btn-danger">Delete</a>
                                                </td>
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
