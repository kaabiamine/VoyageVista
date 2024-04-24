<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";
$reservationController = new ReservationController();
$reservations = $reservationController->getReservationsByUserID(1);
?>


<!DOCTYPE html>
<html lang="en">

<?php require_once('./components/header.php'); ?>

<body>

<?php require_once('./components/navbar.php'); ?>
<!-- Services Start -->
<div class="container-fluid bg-light service py-5">
    <div class="text-center mt-4">
        <a class="btn btn-info rounded-pill py-3 px-5" href="AfficherPayements.php">View Payment History</a>
    </div>
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Reservations</h5>
            <h1 class="mb-0">Your reservations</h1>
        </div>

        <?php
        foreach ($reservations as $reservation){
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
                                            <h5 class="mb-4"><?= $reservation->getNom() . " " . $reservation->getPrenom(); ?></h5>
                                            <p class="mb-0"> <?= $reservation->getDateReservation(); ?></p>
                                        </div>
                                        <div style="color: red; font-weight: bold; align-self: flex-start; margin-right: 10px;">
                                            $99.99 <!-- Example price -->
                                        </div>
                                    </div>
                                    <?php
                                    if ($reservation->isStatus()) {
                                        ?>
                                        <form method="GET" action="Payement.php" class="align-self-end">
                                            <input type="hidden" name="reservation_id" id="reservation_id" value="<?= $reservation->getId(); ?>">
                                            <button class="btn btn-primary align-self-end">Payement</button>
                                        </form>
                                        <?php
                                    }
                                    ?>
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
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-2" href="">Reservations More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Services End -->





<?php require_once('./components/footer.php'); ?>
</body>

</html>
