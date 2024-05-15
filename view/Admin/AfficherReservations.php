<?php
include_once '../../model/ReservationModel.php';
include_once "../../controller/ReservationController.php";

// USER VERIFICATION ===========================================================
include_once '../../controller/verify_login.php';

if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['id'];
    $role = $_SESSION['role'];
    if ($role == 2) {
        header('Location: ../login.php');
    }
}else{
    header('Location: ../login.php');
}
//==============================================================================





$reservationController = new ReservationController();
//$reservations = $reservationController->getReservationsByUserID(1);
$reservations = $reservationController->getAllReservations();





?>


<!DOCTYPE html>
<html lang="en">


<?php require_once('./components/head.php'); ?>

<body>
<div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php require_once('./components/navbar.php'); ?>
    <!-- partial -->
        <!-- partial:../../partials/_settings-panel.html -->


        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Reservations </h4>

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>
                                                User
                                            </th>
                                            <th>
                                                First name
                                            </th>
                                            <th>
                                                Phone number
                                            </th>
                                            <th>
                                                Progress
                                            </th>
                                            <th>
                                                nb_Adultes
                                            </th>
                                            <th>
                                                nombre Enfants
                                            </th>
                                            <th>
                                                Deadline
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        foreach ($reservations as $reservation) {
                                            $reservationId = $reservation->getId();
                                            ?>
                                            <tr>
                                                <td class="py-1">
                                                    <img src="./template/images/faces/face1.jpg" alt="image"/>
                                                </td>
                                                <td>
                                                    <?php echo $reservation->getNom(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $reservation->getTelephone(); ?>
                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php echo $reservation->getNbAdultes(); ?>
                                                </td>
                                                <td>
                                                    <?php echo $reservation->getNbEnfants(); ?>
                                                <td>
                                                    <?php echo $reservation->getDateReservation(); ?>
                                                </td>
                                                <td>
                                                    <form action="ModifierReservation.php" method="get">
                                                        <input type="hidden" name="reservationId" value="<?php echo $reservationId; ?>">
                                                        <button type="submit" class="btn btn-primary" id="update-button-<?php echo $reservationId; ?>">
                                                            Update
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="deleteReservation.php" method="post">
                                                        <input type="hidden" name="reservationId" value="<?php echo $reservationId; ?>">
                                                        <button type="submit" class="btn btn-danger" id="delete-button-<?php echo $reservationId; ?>">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="confirmer-payement.php" method="get">
                                                        <input type="hidden" name="reservationId" value="<?php echo $reservationId; ?>">

                                                        <?php if ($reservation->isStatus()): ?> <!-- Check if status is true -->
                                                            <button type="submit" class="btn btn-success" id="confirmer-button-<?php echo $reservationId; ?>" disabled> <!-- Green button, disabled -->
                                                                Confirmed
                                                            </button>
                                                        <?php else: ?> <!-- If status is false, button is blue and enabled -->
                                                            <button type="submit" class="btn btn-info" id="confirmer-button-<?php echo $reservationId; ?>"> <!-- Blue button, enabled -->
                                                                Confirmer
                                                            </button>
                                                        <?php endif; ?>

                                                    </form>
                                                </td>



                                            </tr>
                                            <?php
                                        }
                                        ?>


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

<!-- page-body-wrapper ends -->

<?php require_once('./components/footer-scripts.php'); ?>
</body>

</html>
