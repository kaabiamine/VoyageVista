<?php
// Include necessary models, controllers, and FPDF library
include_once '../../../Model/SponsorContractModel.php';
include_once "../../../Controller/SponsorContractController.php";
include_once "../../../Controller/SponsorController.php";
include_once "../../../Controller/SponsorPackController.php";
include_once '../../Libraries/FPDF/fpdf.php'; // FPDF for PDF generation

// Get sponsor and pack IDs from the URL parameters
$sponsor_id = $_GET['sponsor_id'];
$pack_id = $_GET['pack_id'];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the POST request
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $payment_method = $_POST['payment_method'];
    $contract_status = $_POST['contract_status'] === '1'; // Convert to boolean

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

    // Instantiate the controllers
    $sponsorContractController = new SponsorContractController();
    $sponsorController = new SponsorController();
    $sponsorPackController = new SponsorPackController();

    // Get the sponsor and sponsor pack data
    $sponsor = $sponsorController->getSponsorById($sponsor_id);
    $sponsorPack = $sponsorPackController->getPackByID($pack_id);

    // Attempt to add the contract
    if ($sponsorContractController->addContract($contract) ){
        // Create a PDF for the contract
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 15, 'Sponsor Contract', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);


        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(0, 10, 'Sponsor Details', 0, 1, 'L', true);
        $pdf->Cell(0, 10, 'Sponsor Name: ' . $sponsor->getSponsorName(), 0, 1);
        $pdf->Cell(0, 10, 'Sponsor Email: ' . $sponsor->getSponsorEmail(), 0, 1);
        $pdf->Cell(0, 10, 'Sponsor Phone: ' . $sponsor->getSponsorPhone(), 0, 1);
        $pdf->Cell(0, 10, 'Sponsor Address: ' . $sponsor->getSponsorAddress(), 0, 1);
        $pdf->Cell(0, 10, 'Sponsor Website: ' . $sponsor->getSponsorWebsite(), 0, 1);
        $pdf->Ln(5);

        // Section: Sponsor Pack Details
        $pdf->SetFillColor(220, 220, 220); // Light gray background
        $pdf->Cell(0, 10, 'Sponsor Pack Details', 0, 1, 'L', true);
        $pdf->Cell(0, 10, 'Pack Name: ' . $sponsorPack['pack_name'], 0, 1);
        $pdf->Cell(0, 10, 'Pack Description: ' . $sponsorPack['pack_description'], 0, 1);
        $pdf->Cell(0, 10, 'Pack Price: ' . number_format($sponsorPack['pack_price'], 2), 0, 1);
        $pdf->Ln(5);

        // Section: Contract Details
        $pdf->SetFillColor(230, 230, 230); // Slightly darker gray
        $pdf->Cell(0, 10, 'Contract Details', 0, 1, 'L', true);
        $pdf->Cell(0, 10, 'Start Date: ' . $start_date, 0, 1);
        $pdf->Cell(0, 10, 'End Date: ' . $end_date, 0, 1);
        $pdf->Cell(0, 10, 'Payment Method: ' . $payment_method, 0, 1);
        $pdf->Cell(0, 10, 'Contract Status: ' . ($contract_status ? 'Active' : 'Inactive'), 0, 1);

        $pdfDir = '../PDF/Contrat/';
        if (!file_exists($pdfDir)) {
            mkdir($pdfDir, 0777, true); // Create the directory if it doesn't exist
        }


        $pdfFileName = 'Sponsor_Contract_' . $sponsor_id . '_' . time() . '.pdf';
        $pdfFilePath = $pdfDir . $pdfFileName;
        $pdf->Output('F', $pdfFilePath); // Save the PDF to the specified directory
        echo "PDF saved at: " . $pdfFilePath;
        header("Location: AfficherPacks.php");
        exit;
    } else {
        echo "Failed to add contract.";
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
