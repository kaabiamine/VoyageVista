<?php
include_once '../../../Model/SponsorModel.php';
include_once "../../../Controller/SponsorController.php";
$sponsorController = new SponsorController();

// If submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Create a new SponsorModel object from the POST data
    if (
        isset($_POST['sponsor_name']) && $_POST['sponsor_name'] !== '' &&
        isset($_POST['sponsor_logo']) && $_POST['sponsor_logo'] !== '' &&
        isset($_POST['sponsor_description']) && $_POST['sponsor_description'] !== '' &&
        isset($_POST['sponsor_email']) && $_POST['sponsor_email'] !== '' &&
        isset($_POST['sponsor_phone']) && $_POST['sponsor_phone'] !== '' &&
        isset($_POST['sponsor_address']) && $_POST['sponsor_address'] !== '' &&
        isset($_POST['sponsor_website']) && $_POST['sponsor_website'] !== ''
    ){   $newSponsor = new SponsorModel(
            0,
            $_POST['sponsor_name'],
            $_POST['sponsor_logo'],
            $_POST['sponsor_description'],
            $_POST['sponsor_email'],
            $_POST['sponsor_phone'],
            $_POST['sponsor_address'],
            $_POST['sponsor_website']
        );

        //var_dump($newSponsor->getSponsorName(), $newSponsor->getSponsorLogo(), $newSponsor->getSponsorDescription(), $newSponsor->getSponsorEmail(), $newSponsor->getSponsorPhone(), $newSponsor->getSponsorAddress(), $newSponsor->getSponsorWebsite());

        $addResult = $sponsorController->addSponsor($newSponsor);

        // Handle successful add
        if ($addResult) {
            // Redirect to AfficherSponsors.php with a success message (optional)
            header("Location: AfficherSponsors.php");
            exit; // Stop further script execution after redirect
        } else {
            // Handle failed add (e.g., display an error message)
            echo "Sponsor add failed!";
        }
    }

}

?>

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

                    <div class="col-8 grid-margin stretch-card d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add sponsor</h4>
                                <p class="card-description">
                                    Add sponsor
                                </p>
                                <form class="forms-sample" method="post" onsubmit="return validateFormSponsor()">
                                    <div class="form-group">
                                        <label for="sponsor_name">Sponsor Name</label>
                                        <input type="text" class="form-control" id="sponsor_name" name="sponsor_name">
                                        <span class="text-danger" id="sponsor_name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_logo">Sponsor Logo</label>
                                        <input type="text" class="form-control" id="sponsor_logo" name="sponsor_logo">
                                        <span class="text-danger" id="sponsor_logo_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_description">Sponsor Description</label>
                                        <textarea class="form-control" id="sponsor_description" name="sponsor_description"></textarea>
                                        <span class="text-danger" id="sponsor_description_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_email">Sponsor Email address</label>
                                        <input type="email" class="form-control" id="sponsor_email" name="sponsor_email">
                                        <span class="text-danger" id="sponsor_email_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_phone">Sponsor Téléphone</label>
                                        <input type="tel" class="form-control" id="sponsor_phone" name="sponsor_phone">
                                        <span class="text-danger" id="sponsor_phone_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_address">Sponsor Address</label>
                                        <input type="text" class="form-control" id="sponsor_address" name="sponsor_address">
                                        <span class="text-danger" id="sponsor_address_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="sponsor_website">Sponsor Website</label>
                                        <input type="url" class="form-control" id="sponsor_website" name="sponsor_website">
                                        <span class="text-danger" id="sponsor_website_error"></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <button class="btn btn-light">Cancel</button>
                                </form>

                                <script>
                                    function validateFormSponsor() {
                                        let isValid = true; // Flag to track overall validation status

                                        // Get references to error span elements
                                        const sponsorNameError = document.getElementById('sponsor_name_error');
                                        const sponsorLogoError = document.getElementById('sponsor_logo_error');
                                        const sponsorDescriptionError = document.getElementById('sponsor_description_error');
                                        const sponsorEmailError = document.getElementById('sponsor_email_error');
                                        const sponsorPhoneError = document.getElementById('sponsor_phone_error');
                                        const sponsorAddressError = document.getElementById('sponsor_address_error');
                                        const sponsorWebsiteError = document.getElementById('sponsor_website_error');

                                        // Validate each field for emptiness
                                        const fields = [
                                            { element: document.getElementById('sponsor_name'), errorSpan: sponsorNameError },
                                            { element: document.getElementById('sponsor_logo'), errorSpan: sponsorLogoError },
                                            { element: document.getElementById('sponsor_description'), errorSpan: sponsorDescriptionError },
                                            { element: document.getElementById('sponsor_email'), errorSpan: sponsorEmailError },
                                            { element: document.getElementById('sponsor_phone'), errorSpan: sponsorPhoneError },
                                            { element: document.getElementById('sponsor_address'), errorSpan: sponsorAddressError },
                                        ];

                                        for (const field of fields) {
                                            if (field.element.value.trim() === '') {
                                                field.errorSpan.textContent = 'This field is required';
                                                isValid = false;
                                            } else {
                                                field.errorSpan.textContent = ''; // Clear any previous error message
                                            }
                                        }
                                        const sponsorName = document.getElementById('sponsor_name').value;
                                        if (sponsorName.trim() === '') {
                                            sponsorNameError.textContent = 'Please enter a sponsor name';
                                            isValid = false;
                                        } else if (/\d/.test(sponsorName)) {
                                            sponsorNameError.textContent = 'Name cannot contain numbers';
                                            isValid = false;
                                        } else if (sponsorName.length < 5 || sponsorName.length > 20) {
                                            sponsorNameError.textContent = 'Name must be between 5 and 20 characters';
                                            isValid = false;
                                        } else {
                                            sponsorNameError.textContent = ''; // Clear any previous error message
                                        }

                                        // Phone number validation
                                        const sponsorPhone = document.getElementById('sponsor_phone').value;
                                        const phoneRegex = /^\d{8}$/; // Ensures exactly 8 digits
                                        if (!phoneRegex.test(sponsorPhone)) {
                                            sponsorPhoneError.textContent = 'Phone number must be 8 digits';
                                            isValid = false;
                                        } else {
                                            sponsorPhoneError.textContent = '';
                                        }

                                        // You can add more validation rules for other fields here

                                        return isValid; // Return true if all validations pass, false otherwise
                                    }
                                </script>


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
<?php //require_once('../components/footer-scripts.php'); ?>

</body>

</html>
