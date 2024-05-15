<?php
include_once '../../../Model/SponsorPackModel.php';
include_once "../../../Controller/SponsorPackController.php";
// USER VERIFICATION ===========================================================
include_once '../../../controller/verify_login.php';

if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['id'];
    $role = $_SESSION['role'];
    if ($role == 2) {
        header('Location: ../../login.php');
    }
}else{
    header('Location: ../../login.php');
}
//==============================================================================
$sponsorPackController = new SponsorPackController();

$uploadDirectory = '../../uploads/'; // Ensure the directory path has a trailing slash

// Check if the upload directory exists, create it if it doesn't
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true); // 0777 for full read/write access
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['pack_name']) &&
        isset($_POST['pack_description']) &&
        isset($_POST['pack_price']) &&
        isset($_POST['pack_status']) &&
        isset($_POST['updated_at'])
    ) {
        if (isset($_FILES['image_pack']) && $_FILES['image_pack']['error'] === UPLOAD_ERR_OK) {
            $imagePack = $_FILES['image_pack'];

            // Create a unique file name with a timestamp to avoid conflicts
            $uniqueFileName = uniqid(time() . '_') . basename($imagePack['name']);

            $uploadPath = $uploadDirectory . $uniqueFileName; // Correct path with a slash

            if (move_uploaded_file($imagePack['tmp_name'], $uploadPath)) {
                // Store the file path, not the actual image, in the database
                $packStatus = $_POST['pack_status'] === '1'; // Convert to boolean

                $newSponsorPack = new SponsorPackModel(
                    $_POST['pack_name'],
                    $_POST['pack_description'],
                    (float)$_POST['pack_price'],
                    $packStatus,
                    new DateTime(),
                    new DateTime($_POST['updated_at']),
                    $uniqueFileName // Store the file path
                );

                $addResult = $sponsorPackController->addPack($newSponsorPack);

                if ($addResult) {
                    header("Location: AfficherPacks.php");
                    exit;
                } else {
                    echo "Failed to add sponsor pack.";
                }
            } else {
                echo "Failed to upload the image. Please try again.";
            }
        } else {
            // Display a detailed message based on error code
            echo "Image upload error: " . getUploadErrorMessage($_FILES['image_pack']['error']);
        }
    } else {
        echo "Invalid form data. Please check all required fields.";
    }
}

// Function to return error messages for file upload issues
function getUploadErrorMessage($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_OK:
            return "No error.";
        case UPLOAD_ERR_INI_SIZE:
            return "File size exceeds server limits.";
        case UPLOAD_ERR_FORM_SIZE:
            return "File size exceeds form limits.";
        case UPLOAD_ERR_PARTIAL:
            return "File was partially uploaded.";
        case UPLOAD_ERR_NO_FILE:
            return "No file was uploaded.";
        case UPLOAD_ERR_NO_TMP_DIR:
            return "Temporary folder is missing.";
        case UPLOAD_ERR_CANT_WRITE:
            return "Failed to write to disk.";
        case UPLOAD_ERR_EXTENSION:
            return "A PHP extension stopped the upload.";
        default:
            return "Unknown error.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">


<?php require_once('../components-sponsor/head.php'); ?>

<body>

<!-- partial:../../partials/_navbar.html -->
<?php require_once('../components-sponsor/navbarSponsor.php'); ?>


        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-8 grid-margin stretch-card d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add Sponsor Pack</h4>
                                <p class="card-description">Provide details to add a new sponsor pack</p>

                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="pack_name">Pack Name</label>
                                        <input type="text" class="form-control" id="pack_name" name="pack_name">
                                        <span class="text-danger" id="pack_name_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_description">Pack Description</label>
                                        <textarea class="form-control" id="pack_description" name="pack_description"></textarea>
                                        <span class="text-danger" id="pack_description_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_price">Pack Price</label>
                                        <input type="text" class="form-control" id="pack_price" name="pack_price">
                                        <span class="text-danger" id="pack_price_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_status">Pack Status</label>
                                        <select class="form-control" id="pack_status" name="pack_status">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="updated_at">Updated At</label>
                                        <input type="date" class="form-control" id="updated_at" name="updated_at">
                                        <span class="text-danger" id="updated_at_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_pack">Image Pack</label>
                                        <input type="file" class="form-control" id="image_pack" name="image_pack" accept="image/*">
                                        <span class="text-danger" id="image_pack_error"></span>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <a href="AfficherPacks.php" class="btn btn-light">Cancel</a>
                                </form>


                                <script src="../input-validation/SponsorPack.js"></script>

                            </div> <!-- End of card body -->
                        </div> <!-- End of card -->
                    </div> <!-- End of col-8 -->
                </div> <!-- End of row -->
            </div> <!-- End of content-wrapper -->
        </div> <!-- End of main-panel -->
</body>
</html>

