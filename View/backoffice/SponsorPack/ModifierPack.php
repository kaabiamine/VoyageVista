<?php
// Include the necessary files
include_once '../../../Model/SponsorPackModel.php';
include_once "../../../Controller/SponsorPackController.php";

// Check if the pack ID is provided
if (isset($_GET['id'])) {
    $packId = (int)$_GET['id']; // Convert to integer for safety
} else {
    echo "Invalid pack ID.";
    exit;
}

$sponsorPackController = new SponsorPackController();

// Fetch the existing sponsor pack data by ID
$sponsorPack = $sponsorPackController->getPackByID($packId);

if (!$sponsorPack) {
    echo "Sponsor pack not found.";
    exit;
}

$uploadDirectory = '../../uploads/'; // Ensure the directory path has a trailing slash

// Check if the upload directory exists, create it if it doesn't
if (!is_dir($uploadDirectory)) {
    mkdir($uploadDirectory, 0777, true); // 0777 for full read/write access
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['pack_name']) &&
        isset($_POST['pack_description']) &&
        isset($_POST['pack_price']) &&
        isset($_POST['pack_status'])
    ) {
        // Handle the image upload if provided
        $imagePackPath = $sponsorPack['image_pack']; // Keep the existing image by default

        if (isset($_FILES['image_pack']) && $_FILES['image_pack']['error'] === UPLOAD_ERR_OK) {
            $imagePack = $_FILES['image_pack'];

            // Create a unique file name with a timestamp to avoid conflicts
            $uniqueFileName = uniqid(time() . '_') . basename($imagePack['name']);
            $uploadPath = $uploadDirectory . $uniqueFileName;

            if (move_uploaded_file($imagePack['tmp_name'], $uploadPath)) {
                // Update the image path if a new image is uploaded
                $imagePackPath = $uniqueFileName;
            } else {
                echo "Failed to upload the image. Please try again.";
                exit;
            }
        }

        // Create a SponsorPackModel object with the updated data
        $createdAt = new DateTime($sponsorPack['create_at']); // Convert the original creation date to DateTime

        $updatedSponsorPack = new SponsorPackModel(
            $_POST['pack_name'],
            $_POST['pack_description'],
            (float)$_POST['pack_price'],
            $_POST['pack_status'] === '1',
            $createdAt,
            new DateTime(),
            $imagePackPath
        );

        // Update the pack using the controller
        $updateResult = $sponsorPackController->updatePack( $updatedSponsorPack , $packId);

        if ($updateResult) {
            // Redirect after successful update
            header("Location: AfficherPacks.php");
            //exit;
        } else {
            echo "Failed to update the sponsor pack.";
        }
    } else {
        echo "Invalid form data. Please check all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Include head section -->
<?php require_once('../components/head.php'); ?>

<body>
<div class="container-scroller">
<!--    --><?php //require_once('../components/navbar.php'); ?>

    <div class="container-fluid page-body-wrapper">
<!--        --><?php //require_once('../components/sidebar.php'); ?><!-- <!-- Include sidebar -->-->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-8 grid-margin stretch-card d-flex justify-content-center">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Modify Sponsor Pack</h4>
                                <p class="card-description">Edit details for the sponsor pack</p>

                                <!-- Form for modifying the pack -->
                                <form class="forms-sample" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="pack_name">Pack Name</label>
                                        <input type="text" class="form-control" id="pack_name" name="pack_name" value="<?php echo htmlspecialchars($sponsorPack['pack_name']); ?>">
                                        <!-- Error span for Pack Name -->
                                        <span class="text-danger" id="pack_name_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_description">Pack Description</label>
                                        <textarea class="form-control" id="pack_description" name="pack_description"><?php echo htmlspecialchars($sponsorPack['pack_description']); ?></textarea>
                                        <!-- Error span for Pack Description -->
                                        <span class="text-danger" id="pack_description_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_price">Pack Price</label>
                                        <input type="number" step="0.01" class="form-control" id="pack_price" name="pack_price" value="<?php echo htmlspecialchars($sponsorPack['pack_price']); ?>">
                                        <!-- Error span for Pack Price -->
                                        <span class="text-danger" id="pack_price_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="pack_status">Pack Status</label>
                                        <select class="form-control" id="pack_status" name="pack_status">
                                            <option value="1" <?php if ($sponsorPack['pack_status'] == 1) echo 'selected'; ?>>Active</option>
                                            <option value="0" <?php if ($sponsorPack['pack_status'] == 0) echo 'selected'; ?>>Inactive</option>
                                        </select>
                                        <!-- Error span for Pack Status -->
                                        <span class="text-danger" id="pack_status_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="image_pack">Image Pack</label>
                                        <input type="file" class="form-control" id="image_pack" name="image_pack" accept="image/*">
                                        <!-- Error span for Image Pack -->
                                        <span class="text-danger" id="image_pack_error"></span>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                    <a href="AfficherPacks.php" class="btn btn-light">Cancel</a>
                                </form>


                                <script src="../input-validation/Modifier-SponsorPack.js"></script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
