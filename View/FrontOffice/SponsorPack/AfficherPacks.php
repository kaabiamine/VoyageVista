<?php
include_once '../../../Model/SponsorPackModel.php'; // Ensure the correct path to your model
include_once "../../../Controller/SponsorPackController.php"; // Include the controller for data retrieval

$sponsorPackController = new SponsorPackController(); // Instantiate your controller
$sponsorPacks = $sponsorPackController->getAllSponsorPacks(); // Fetch sponsor packs
$uploadDirectory = '../../uploads/'; // Ensure this path leads to your uploads directory
?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('../components/head-Packs.php'); ?>

<body>

<?php require_once('../components/navbar.php'); ?>


<div class="container-fluid packages py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Packages</h5>
            <h1 class="mb-0">Awesome Sponsor Packages</h1>
        </div>
        <div class="packages-carousel owl-carousel">
            <?php foreach ($sponsorPacks as $pack ){?>
                <div class="packages-item">
                    <div class="packages-img">
                        <!-- Use array key access instead of getter methods -->
                        <img src="<?= $uploadDirectory . ($pack['image_pack'] ?: 'default-package.jpg') ?>" class="img-fluid w-100 rounded-top" alt="Package Image">
                        <div class="packages-info d-flex border-start-0 border-end-0 position-absolute" style="width: 100%; bottom: 0; left: 0; z-index: 5;">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt me-2"></i><?= $pack['pack_name'] ?? 'Unknown' ?></small>
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-calendar-alt me-2"></i><?= $pack['create_at'] ?? 'Unknown' ?></small>
                            <small class="flex-fill text-center py-2"><i class="fa fa-user me-2"></i><?= $pack['pack_status'] ?? 'Unknown' ?></small>
                        </div>
                        <div class="packages-price py-2 px-4">
                            $<?= number_format($pack['pack_price'], 2) ?>
                        </div>
                    </div>

                    <div class="packages-content bg-light">
                        <div class="p-4 pb-0">
                            <h5 class="mb-0"><?= $pack['pack_name'] ?></h5>
                            <small class="text-uppercase"><?= $pack['pack_description'] ?? 'No description' ?></small>
                            <div class="mb-3">
                                <?php for ($i = 0; $i < 5; $i++): ?>
                                    <small class="fa fa-star text-primary"></small>
                                <?php endfor; ?>
                            </div>

                            <p class="mb-4"><?= $pack['pack_description'] ?? 'No description available' ?></p>
                        </div>
                        <div class="row bg-primary rounded-bottom mx-0">
                            <div class="col-6 text-start px-0">
                                <a href="#" class="btn-hover btn text-white py-2 px-4">Read More</a> <!-- Verify the links -->
                            </div>
                            <div class="col-6 text-end px-0">
                                <?php
                                $packId = $pack['id'];
                                ?>
                                <a href="AjouterSponsor.php?pack_id=<?= htmlspecialchars($packId) ?>" class="btn-hover btn text-white py-2 px-4">Book Now</a>> <!-- Adjust booking link -->
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once('../components/footer.php'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/lightbox/js/lightbox.min.js"></script>


<!-- Template Javascript -->
<script src="js/main.js"></script>
</body>

</html>
