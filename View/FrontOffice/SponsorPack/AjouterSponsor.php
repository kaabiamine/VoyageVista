<?php
include_once '../../../Model/SponsorModel.php';
include_once "../../../Controller/SponsorController.php";
// Handle form submission
$idPack = $_GET['pack_id'];
echo $idPack;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the file was uploaded
    if (isset($_FILES['sponsor_logo']) && $_FILES['sponsor_logo']['error'] === UPLOAD_ERR_OK) {
        // Get the uploaded file information
        $fileTempPath = $_FILES['sponsor_logo']['tmp_name'];
        $fileName = $_FILES['sponsor_logo']['name'];
        $fileType = $_FILES['sponsor_logo']['type'];
        $fileSize = $_FILES['sponsor_logo']['size'];

        // Define acceptable file types and maximum file size (e.g., 2MB)
        $acceptableFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB

        // Validate file type and size
        if (in_array($fileType, $acceptableFileTypes) && $fileSize <= $maxFileSize) {
            $targetDir = '../../uploads/'; // Update with your target directory
            $targetFilePath = $targetDir . $fileName;

            // Move the file to the target directory
            if (move_uploaded_file($fileTempPath, $targetFilePath)) {
                // File successfully uploaded
                // Create a new SponsorModel with the submitted data
                $newSponsor = new SponsorModel(
                    0,
                    $_POST['sponsor_name'],
                    $fileName, // Save the file path
                    $_POST['sponsor_description'],
                    $_POST['sponsor_email'],
                    $_POST['sponsor_phone'],
                    $_POST['sponsor_address'],
                    $_POST['sponsor_website']
                );

                // Attempt to add the sponsor
                $sponsorController = new SponsorController();
                $newSponsorID = $sponsorController->addSponsor($newSponsor);
                if ($newSponsorID > 0) {
                    // Redirect to a success page or back to the sponsor list
//                    $newSponsorID = $sponsorController->getLastInsertId();
                    header("Location: AjouterContrat.php?sponsor_id=$newSponsorID&pack_id=$idPack");
                    exit; // Ensure script does not continue executing after redirection
                } else {
                    $error = "Failed to add sponsor. Please try again.";
                }
            } else {
                $error = "Error moving the uploaded file.";
            }
        } else {
            $error = "Invalid file type or size.";
        }
    } else {
        $error = "All fields are required, including a valid image for the logo.";
    }
}

// Display error message if any
if (isset($error)) {
    echo "<div class='alert alert-danger'>" . htmlspecialchars($error) . "</div>";
}

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once('../components/head-Packs.php'); ?>
<body>
<!-- Include your navigation bar -->
<?php require_once('../components/navbar.php'); ?>

<!-- Form to add a sponsor -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Add a New Sponsor</h5>
            <h1 class="mb-0">Add Sponsor Details</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-8 mx-auto">
                <!-- Display error message if any -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" id="sponsorForm" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="sponsor_name" name="sponsor_name" placeholder="Sponsor Name">
                                <label for="sponsor_name">Sponsor Name</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <!-- File input for uploading images -->
                                <input type="file" class="form-control border-0" id="sponsor_logo" name="sponsor_logo" placeholder="Sponsor Logo" accept="image/*">
                                <label for="sponsor_logo">Sponsor Logo (Image)</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control border-0" id="sponsor_email" name="sponsor_email" placeholder="Sponsor Email">
                                <label for="sponsor_email">Sponsor Email</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="sponsor_phone" name="sponsor_phone" placeholder="Sponsor Phone">
                                <label for="sponsor_phone">Sponsor Phone</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="sponsor_address" name="sponsor_address" placeholder="Sponsor Address">
                                <label for="sponsor_address">Sponsor Address</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control border-0" id="sponsor_website" name="sponsor_website" placeholder="Sponsor Website">
                                <label for="sponsor_website">Sponsor Website</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control border-0" id="sponsor_description" name="sponsor_description" placeholder="Sponsor Description" style="height: 160px"></textarea>
                                <label for="sponsor_description">Sponsor Description</label>
                            </div>
                            <span class="error-message text-danger"></span> <!-- Space for error messages -->
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Add Sponsor</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="../input-validation/Sponsor.js"></script>
<!-- Include your footer -->
<?php require_once('../components/footer.php'); ?>
</body>
</html>
