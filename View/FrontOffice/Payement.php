<?php
require_once '../../Controller/PayementController.php';
require_once '../../Model/PayementModel.php';
require_once '../Libraries/FPDF/fpdf.php';
require_once '../../vendor/autoload.php';
require_once '../../Controller/ReservationController.php';

// Load the configuration
$config = require('../../config-API.php');

// Set Stripe's API key using the config
\Stripe\Stripe::setApiKey($config['stripe']['secret_key']);

$reservationID = $_GET['reservation_id'];
$getreservation = ReservationController::getReservationById($reservationID);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reservation = $_POST['reservationID'];
    $amount = $_POST['amount'];
    $rib = $_POST['rib'];
    $datePayment = new DateTime();

    // Convert amount to cents for Stripe
    $stripeAmount = (float)$amount * 100;

    // Create the payment object
    $payment = new PayementModel($reservation, $amount, 'Stripe', $rib, $datePayment);

    try {
        // Create a PaymentIntent with the order amount and currency
        $paymentIntent = \Stripe\PaymentIntent::create([
            'amount' => $stripeAmount,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);

        $clientSecret = $paymentIntent->client_secret;

        if ($paymentIntent) {
            require_once '../../vendor/pear/http_request2/HTTP/Request2.php';
            $request = new HTTP_Request2();
            $request->setUrl('https://qy2mvw.api.infobip.com/sms/2/text/advanced');
            $request->setMethod(HTTP_Request2::METHOD_POST);
            $request->setConfig(array(
                'follow_redirects' => TRUE
            ));
            $request->setHeader(array(
                'Authorization' => 'App ' . $config['twilio']['auth_token'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ));
            $phone = $getreservation->getTelephone();
            $countryCode = '216'; // Example country code for Tunisia
            $fullPhoneNumber = $countryCode . $phone;
            $requestBody = json_encode([
                "messages" => [
                    [
                        "destinations" => [
                            ["to" => $fullPhoneNumber]
                        ],
                        "from" => "ServiceSMS",
                        "text" => "Congratulations, successful payment of  ".$amount ."DT  ! Your reservation is ready.\nGo ahead and check the delivery report in the next step."
                    ]
                ]
            ]);
            $request->setBody($requestBody);
            try {
                $response = $request->send();
                if ($response->getStatus() == 200) {
                    echo $response->getBody();
                }
                else {
                    echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
                        $response->getReasonPhrase();
                }
            }
            catch(HTTP_Request2_Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }

        // Attempt to add the payment
        if (PayementController::addPayement($payment)) {
            // Create and save the PDF document
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Payment Receipt', 0, 1, 'C');
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Reservation ID: ' . $reservationID, 0, 1);
            $pdf->Cell(0, 10, 'Amount: ' . $amount, 0, 1);
            $pdf->Cell(0, 10, 'Payment Method: Stripe', 0, 1);
            $pdf->Cell(0, 10, 'RIB: ' . $rib, 0, 1);
            $pdf->Cell(0, 10, 'Date: ' . $datePayment->format('Y-m-d'), 0, 1);

            $pdfDir = '../PDF/Generation/';
            if (!file_exists($pdfDir)) {
                mkdir($pdfDir, 0777, true);
            }

            $pdfFileName = 'Payment_Receipt_' . $reservationID . '.pdf';
            $pdfFilePath = $pdfDir . $pdfFileName;
            $pdf->Output('F', $pdfFilePath);

            echo "PDF saved at: " . $pdfFilePath;
            header('Location: AfficherReservations.php');
        } else {
            echo "<script>alert('Error adding payment');</script>";
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('./components/header.php'); ?>
<body>
<?php require_once('./components/navbar.php'); ?>

<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Reservation Payment</h5>
            <h1 class="mb-0">This form is for payment of reservation</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <div class="bg-white rounded p-4">
                    <div class="text-center mb-4">
                        <i class="fa fa-map-marker-alt fa-3x text-primary"></i>
                        <h4 class="text-primary">Address</h4>
                        <p class="mb-0">123 Ranking Street, <br> New York, USA</p>
                    </div>
                    <div class="text-center mb-4">
                        <i class="fa fa-phone-alt fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Mobile</h4>
                        <p class="mb-0">+012 345 67890</p>
                    </div>
                    <div class="text-center">
                        <i class="fa fa-envelope-open fa-3x text-primary mb-3"></i>
                        <h4 class="text-primary">Email</h4>
                        <p class="mb-0">info@example.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="mb-2">Reservation Payment</h3>
                <form method="post" id="payment-form">
                    <input type="hidden" value="<?= $reservationID ?>" id="reservationID" name="reservationID">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="amount" name="amount" placeholder="Your Amount">
                                <label for="amount">Your Amount</label>
                                <span id="amount-error" class="error" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="rib" name="rib" placeholder="Your RIB">
                                <label for="rib">RIB:</label>
                                <span id="rib-error" class="error" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="col-12">
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Pay Now</button>
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

<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('pk_test_51PEK4wBUxX3Aadz65KtrNTTeQeDPP5oPx2lTReYwF7JKES0jg5JtKdB4TJ4n2xnWQs6pKMst7tJsP7laz2787bbx00nQMsNlgz');
    var elements = stripe.elements();
    var style = {
        base: {
            color: "#32325d",
        }
    };

    var card = elements.create("card", { style: style });
    card.mount("#card-element");

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createPaymentMethod({
            type: 'card',
            card: card,
            billing_details: {
                // Include any other relevant billing details
                name: 'Customer Name', // Replace with data from an input or your app context
            },
        }).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.paymentMethod.id);
            }
        });
    });

    function stripeTokenHandler(paymentMethod) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripePaymentMethodId');
        hiddenInput.setAttribute('value', paymentMethod);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

<?php require_once('./components/footer.php'); ?>
</body>
</html>
