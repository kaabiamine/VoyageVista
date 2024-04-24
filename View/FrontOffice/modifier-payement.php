<?php
require_once '../../Controller/PayementController.php';
require_once '../../Model/PayementModel.php';
$payementID = $_GET['idPayement'] ?? null; // Using null coalescing to avoid undefined index error
$payement = null;

if ($payementID) {
    $payementData = PayementController::getPayementById($payementID);
    $reservationId = $payementData->getReservationId();
    $mantant = $payementData->getMantant();
    $methodeDePayement = $payementData->getMethodeDePayement();
    $rib = $payementData->getRib();
    $datePayement = $payementData->getDatePayement();

    $payement = new PayementModel($reservationId, $mantant, $methodeDePayement, $rib, $datePayement);
}

if ($payement === null) {
    echo "Invalid Payment ID: No payment found with ID " . htmlspecialchars($payementID);
    exit; // Exit or provide further guidance to the user
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $reservation = $_POST['reservationID'];
    $mantant = $_POST['mantant'];
    $paymentMethod = $_POST['paymentMethod'];
    $rib = $_POST['rib'];

    $payement = new PayementModel($reservation, $mantant, $paymentMethod, $rib, $datePayement);

    if (PayementController::updatePayementById($payementID, $payement)) {
        header('Location: AfficherPayements.php');
    } else {
        echo "<script>alert('Error adding payement');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./components/header.php'); ?>

<body>

<?php require_once('./components/navbar.php'); ?>
<!-- Services Start -->

<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Reservation Payement</h5>
            <h1 class="mb-0">this form is for payement of reservation</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <div class="bg-white rounded p-4">
                    <div class="text-center mb-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                        <h4 class="text-primary"><Address></Address></h4>
                        <p class="mb-0">123 ranking Street, <br> New York, USA</p>
                    </div>
                    <div class="text-center mb-4">
                        <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Mobile</h4>
                        <p class="mb-0">+012 345 67890</p>
                        <p class="mb-0">+012 345 67890</p>
                    </div>

                    <div class="text-center">
                        <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Email</h4>
                        <p class="mb-0">info@example.com</p>
                        <p class="mb-0">info@example.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="mb-2">Reservation Payement</h3>
                <p class="mb-4"></a>.</p>
                <form method="post">
                    <!-- Populate hidden reservation ID -->
                    <input type="hidden" value="<?= $payement->getReservationId(); ?>" id="reservationID" name="reservationID">

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- Pre-fill mantant with data from $payement -->
                                <input type="text"
                                       class="form-control border-0"
                                       id="mantant"
                                       name="mantant"
                                       placeholder="Your Montant"
                                       value="<?= htmlspecialchars($payement->getMantant()); ?>"> <!-- Important: use htmlspecialchars -->
                                <label for="mantant">Your Montant</label>
                                <span id="mantant-error" class="error" style="color: red;"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="nav-item dropdown">
                                <select class="form-select p-3" id="paymentMethod" name="paymentMethod">
                                    <!-- Set selected based on current payment method -->
                                    <option value="Paypal" <?= ($payement->getMethodeDePayement() == 'Paypal') ? 'selected' : ''; ?>>Paypal</option>
                                    <option value="Mastercard" <?= ($payement->getMethodeDePayement() == 'Mastercard') ? 'selected' : ''; ?>>Mastercard</option>
                                    <option value="Visa" <?= ($payement->getMethodeDePayement() == 'Visa') ? 'selected' : ''; ?>>Visa</option>
                                    <option value="Cash" <?= ($payement->getMethodeDePayement() == 'Cash') ? 'selected' : ''; ?>>Cash</option>
                                </select>
                                <span id="payment-method-error" class="error" style="color: red;"></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <!-- Pre-fill RIB -->
                                <input type="text"
                                       class="form-control border-0"
                                       id="rib"
                                       name="rib"
                                       placeholder="Your RIB"
                                       value="<?= htmlspecialchars($payement->getRib()); ?>"> <!-- Use htmlspecialchars -->
                                <label for="rib">RIB:</label>
                                <span id="rib-error" class="error" style="color: red;"></span>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                <div class="rounded">
                    <iframe class="rounded w-100"
                            style="height: 450px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387191.33750346623!2d-73.97968099999999!3d40.6974881!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1694259649153!5m2!1sen!2sbd"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->



<script src="./controle-saisie/payement-validation.js"></script>
<?php require_once('./components/footer.php'); ?>
</body>

</html>

