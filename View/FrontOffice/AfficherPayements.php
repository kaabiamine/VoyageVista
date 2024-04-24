<?php
include_once '../../Model/PayementModel.php';
include_once "../../Controller/PayementController.php";
$payementController = new PayementController();
$payements = $payementController->getPayementsByUserId(2);
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./components/header.php'); ?>

<body>

<?php require_once('./components/navbar.php'); ?>

<div class="container-fluid bg-light service py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Payments</h5>
            <h1 class="mb-0">Your Payment History</h1>
        </div>
        <?php
        foreach ($payements as $payement) {
            ?>
            <div class="row m-3 justify-content-center">
                <div class="col-lg-8">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="service-content-inner d-flex bg-white border border-primary rounded p-4 ps-0">
                                <div class="service-icon p-4">
                                    <i class="fa fa-dollar-sign fa-4x text-primary"></i>
                                </div>
                                <div class="service-content d-flex flex-column w-100">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h5 class="mb-4">
                                                Reservation ID: <?= $payement->getReservationId(); ?>
                                            </h5>
                                            <p class="mb-0">
                                                Payment Date: <?= $payement->getDatePayement()->format('Y-m-d'); ?>
                                            </p>
                                            <p class="mb-0">
                                                Payment Method: <?= $payement->getMethodeDePayement(); ?>
                                            </p>
                                        </div>
                                        <div style="color: red; font-weight: bold; align-self: flex-start; margin-right: 10px;">
                                            <?= "$" . number_format($payement->getMantant(), 2); ?>
                                        </div>
                                    </div>

                                    <!-- Add the update form here -->
                                    <div class="d-flex justify-content-end">
                                        <form action="modifier-payement.php" method="get">
                                            <input type="hidden" name="idPayement" id="idPayement" value="<?= $payement->getId(); ?>">
                                            <button type="submit" class="btn btn-warning">Update</button>
                                        </form>

                                        <!-- Add the delete form here -->
                                        <form action="deletePayement.php" method="get" style="margin-left: 10px;">
                                            <input type="hidden" name="idPayement" value="<?= $payement->getId(); ?>">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>
        <div class="col-12">
            <div class="text-center">
                <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">More Payments</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('./components/footer.php'); ?>
</body>

</html>
