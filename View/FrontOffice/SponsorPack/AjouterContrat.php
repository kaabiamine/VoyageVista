<?php
// Include necessary models and controllers
include_once '../../../Model/SponsorContractModel.php';
include_once "../../../Controller/SponsorContractController.php";
$sponsor_id = $_GET['sponsor_id'];
$pack_id = $_GET['pack_id'];
echo "sponsor".$sponsor_id;
echo $pack_id;
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $payment_method = $_POST['payment_method'];
    $contract_status = $_POST['contract_status'] === '1'; // true for active, false for inactive
//    $sponsor_id = 1; // Example sponsor ID
//    $sponsor_pack_id = 1; // Example sponsor pack ID

    // Create a new contract model
    $contract = new SponsorContractModel(
        new DateTime($start_date),
        new DateTime($end_date),
        $payment_method,
        $contract_status,
        new DateTime(), // created_at
        new DateTime(), // updated_at
        $sponsor_id,
        $pack_id
    );

    // Instantiate the controller
    $sponsorContractController = new SponsorContractController();

    // Attempt to add the contract
    if ($sponsorContractController->addContract($contract)) {
        header("Location: AfficherPacks.php");
        exit;
    } else {
        $error = "Failed to add contract.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('../components/head-Packs.php'); ?>
<body>
<!-- Include your navigation bar -->
<?php require_once('../components/navbar.php'); ?>

<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Add a New Sponsor Contract</h5>
            <h1 class="mb-0">Add Contract Details</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-8 mx-auto">
                <!-- Display error message if any -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control border-0" id="start_date" name="start_date" placeholder="Start Date">
                                <label for="start_date">Start Date</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="date" class="form-control border-0" id="end_date" name="end_date" placeholder="End Date">
                                <label for="end_date">End Date</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control border-0" id="payment_method" name="payment_method">
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="PayPal">PayPal</option>
                                </select>
                                <label for="payment_method">Payment Method</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-control border-0" id="contract_status" name="contract_status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <label for="contract_status">Contract Status</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Add Contract</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../input-validation/Sponsor.js"></script>
<?php require_once('../components/footer.php'); ?>
</body>
</html>
