<?php

include_once '../../../Model/SponsorPackModel.php'; // Include the SponsorPackModel class
include_once "../../../Controller/SponsorPackController.php"; // Include the SponsorPackController class

$sponsorPackController = new SponsorPackController();
$sponsorPacks = $sponsorPackController->getAllSponsorPacks(); // Retrieve all sponsor packs
$uploadDirectory = '../../uploads/';
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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">

                            <div class="card-body">
                                <a href="AjouterPack.php" class="btn btn-primary m-4">Add Sponsor Pack</a>
                                <h4 class="card-title">List of Sponsor Packs</h4>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Image</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($sponsorPacks as $sponsorPack) : ?>
                                            <tr>
                                                <td><?php echo $sponsorPack['id']; ?></td>
                                                <td><?php echo $sponsorPack['pack_name']; ?></td>
                                                <td><?php echo $sponsorPack['pack_description']; ?></td>
                                                <td><?php echo $sponsorPack['pack_price']; ?></td>
                                                <td>
                                                    <?php if ($sponsorPack['pack_status']) { ?>
                                                        <button class="btn btn-success" disabled>Active</button>
                                                    <?php } else { ?>
                                                        <button class="btn btn-danger" disabled>Inactive</button>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $sponsorPack['create_at']; ?></td>
                                                <td><?php echo $sponsorPack['updated_at']; ?></td>
<!--                                                <td><img src="--><?php //echo $uploadDirectory.$sponsorPack['image_pack']; ?><!--" alt="Pack Image" width="100"></td>-->
                                                <td><img src="<?php echo $uploadDirectory.$sponsorPack['image_pack']; ?>" alt="Pack Image" width="100"></td>
<!--                                                <td> --><?php //echo $uploadDirectory.$sponsorPack['image_pack']; ?><!--</td>-->
                                                <td>
                                                    <a href="ModifierPack.php?id=<?php echo $sponsorPack['id']; ?>"
                                                       class="btn btn-warning">Edit</a>
                                                    <a href="SupprimerPack.php?id=<?php echo $sponsorPack['id']; ?>&action=delete"
                                                       class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
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
</div>
<!-- page-body-wrapper ends -->
</div>
<?php require_once('../components/footer-scripts.php'); ?>
</body>

</html>

