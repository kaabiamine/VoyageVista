<?php
require_once '../../Controller/PayementController.php';
require_once '../../Model/PayementModel.php';
require_once '../Libraries/FPDF/fpdf.php'; // Include FPDF

$reservationID = $_GET['reservation_id']; // Get the reservation ID from the URL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation = $_POST['reservationID'];
    $mantant = $_POST['mantant'];
    $paymentMethod = $_POST['paymentMethod'];
    $rib = $_POST['rib'];
    $datePayement = new DateTime();

    // Create the payment object
    $payement = new PayementModel($reservation, $mantant, $paymentMethod, $rib, $datePayement);

    // Attempt to add the payment
    if (PayementController::addPayement($payement)) {
        // Create the PDF document
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 12);

        // Add content to the PDF
        $pdf->Cell(0, 10, 'Payment Receipt', 0, 1, 'C');
        $pdf->Ln(10); // Line break
        $pdf->Cell(0, 10, 'Reservation ID: ' . $reservationID, 0, 1);
        $pdf->Cell(0, 10, 'Amount: ' . $mantant, 0, 1);
        $pdf->Cell(0, 10, 'Payment Method: ' . $paymentMethod, 0, 1);
        $pdf->Cell(0, 10, 'RIB: ' . $rib, 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . $datePayement->format('Y-m-d'), 0, 1);

        // Ensure the PDF directory exists
        $pdfDir = '../PDF/Generation/';
        if (!file_exists($pdfDir)) {
            mkdir($pdfDir, 0777, true); // Create the directory with full permissions
        }

        // Save the PDF to the specified directory
        $pdfFileName = 'Payment_Receipt_' . $reservationID . '.pdf'; // Unique filename
        $pdfFilePath = $pdfDir . $pdfFileName;
        $pdf->Output('F', $pdfFilePath); // Save the PDF to the directory

        echo "PDF saved at: " . $pdfFilePath;

        // Redirect to the reservation list page
        header('Location: AfficherReservations.php');
    } else {
        echo "<script>alert('Error adding payment');</script>";
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
                    <input type="hidden" value="<?= $reservationID ?>" id="reservationID" name="reservationID">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="mantant" name="mantant" placeholder="Your Montant">
                                <label for="mantant">Your Montant</label>
                                <span id="mantant-error" class="error" style="color: red;"></span> <!-- Error span -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="nav-item dropdown">
                                <select class="form-select p-3" id="paymentMethod" name="paymentMethod">
                                    <option value="" selected disabled>Choose a payment method</option> <!-- Default disabled option -->
                                    <option value="Paypal">Paypal</option>
                                    <option value="Mastercard">Mastercard</option>
                                    <option value="Visa">Visa</option>
                                    <option value="Cash">Cash</option>
                                </select>
                                <span id="payment-method-error" class="error" style="color: red;"></span> <!-- Error span -->
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="rib" name="rib" placeholder="Your RIB">
                                <label for="rib">RIB:</label>
                                <span id="rib-error" class="error" style="color: red;"></span> <!-- Error span -->
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
