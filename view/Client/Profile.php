<?php
include "../../controller/verify_login.php";
include "../../controller/user_con.php";
$result = isset($_GET['result']) ? $_GET['result'] : null;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user'])) {
    $user1 = $_SESSION['user'];
} else {
    header('Location: ../login.php');
    exit;
}
$user = new UserCon("user");
$user = $user->getUser($user1['id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Travela - Tourism Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600&family=Roboto&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <div class="container-fluid bg-primary px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href=""><i class="fab fa-instagram fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle" href=""><i class="fab fa-youtube fw-normal"></i></a>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a href="#"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Register</small></a>
                    <a href="#"><small class="me-3 text-light"><i class="fa fa-user me-2"></i>Hello <?= htmlspecialchars($user['nom']); ?> !!</small></a>
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle text-light" data-bs-toggle="dropdown"><small><i class="fa fa-home me-2"></i> My Dashboard</small></a>
                        <div class="dropdown-menu rounded">
                            <a href="Profile.php" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-comment-alt me-2"></i> Inbox</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-bell me-2"></i> Notifications</a>
                            <a href="change_password.php" class="dropdown-item"><i class="fas fa-cog me-2"></i> Change password</a>
                            <a href="#" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i><img src="logo.png" alt=""></h1>
                <!-- <img src="img/logo.png" alt="Logo"> -->
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Gestion des réclamation</a>
                            <div class="dropdown-menu m-0">
                                <a href="addReclamation.php" class="dropdown-item">Ajouter une reclamation</a>
                                <a href="listeReclamation.php" class="dropdown-item">Liste des réclamation</a>
                                <a href="listeReponse.php" class="dropdown-item">Liste des réponses</a>
                             
                            </div>
                        </div>
                    <a href="services.html" class="nav-item nav-link">Services</a>
                    <a href="packages.html" class="nav-item nav-link">Packages</a>
                    <a href="blog.html" class="nav-item nav-link">Blog</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="destination.html" class="dropdown-item">Destination</a>
                            <a href="tour.html" class="dropdown-item">Explore Tour</a>
                            <a href="booking.html" class="dropdown-item">Travel Booking</a>
                            <a href="gallery.html" class="dropdown-item">Our Gallery</a>
                            <a href="guides.html" class="dropdown-item">Travel Guides</a>
                            <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            <a href="404.html" class="dropdown-item">404 Page</a>
                        </div>
                    </div>
                    <a href="contact.html" class="nav-item nav-link active">Contact</a>
                </div>
                <a href="" class="btn btn-primary rounded-pill py-2 px-4 ms-lg-4">Book Now</a>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4">Edit your Profile</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active text-white">Profile</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Contact Start -->
    <div class="container-fluid contact bg-light py-5">
        <div class="container py-5">
            <div class="mx-auto text-center mb-5" style="max-width: 900px;">
                <h5 class="section-title px-3">Edit Profile</h5>
            </div>
            <div class="row g-5 align-items-center">

                <div class="col-lg-8">
                    <h3 class="mb-2">Profile</h3>

                    <br>
                    <form action="../../model/update.php" class="needs-validation" id="registrationForm" method="POST" novalidate>
                        <?php
                        switch ($result) {
                            case '1':
                                echo '<div class="alert alert-success" role="alert">Profile updated successfully!</div>';
                                break;
                            case '2':
                                echo '<div class="alert alert-danger" role="alert">An error occurred!</div>';
                                break;
                            case '3':
                                echo '<div class="alert alert-danger" role="alert">Please submit the form.</div>';
                                break;
                            default:
                                echo '<div class="alert alert-primary" role="alert">Fill in the form to update your Profile.</div>';
                                break;
                        }
                        ?>
                        <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <input type="hidden" name="password" value="<?= $user['password']; ?>">
                        <input type="hidden" name="role" value="<?= $user['role']; ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="nom" value="<?= $user['nom'] ?>" type="text" class="form-control border-0" id="inputName" placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                    <div class="invalid-feedback">Name should not contain numbers.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="prenom" value="<?= $user['prenom'] ?>" type="text" class="form-control border-0" id="inputLastname" placeholder="Your Name">
                                    <label for="name">Your Lastname</label>
                                    <div class="invalid-feedback">LastName should not contain numbers.</div>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input name="email" value="<?= $user['email'] ?>" type="email" class="form-control border-0" id="inputEmail" placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                    <div class="invalid-feedback">Please enter a valid email address.</div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="adresse" value="<?= $user['adresse'] ?>" type="text" class="form-control border-0" id="Adress" placeholder="Adress">
                                    <label for="Adress">Adress</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input name="tel" value="<?= $user['tel'] ?>" type="text" class="form-control border-0" id="inputPhone" placeholder="Phone">

                                    <label for="message">Phone Number</label>
                                    <div class="invalid-feedback">Phone number should only contain numbers.</div>

                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium w-100  auth-form-btn">Update your credentials</button>
                            </div>
                        </div>
                    </form>

                </div>
                <form action="../../model/delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
                    <input type="hidden" name="id" value="<?= $user['id']; ?>">
                    <div class="col-8">
                        <input type="submit" class="btn btn-danger w-100 py-3" value="Delete your account ?">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <!-- Subscribe Start -->
    <div class="container-fluid subscribe py-5">
        <div class="container text-center py-5">
            <div class="mx-auto text-center" style="max-width: 900px;">
                <h5 class="subscribe-title px-3">Subscribe</h5>
                <h1 class="text-white mb-4">Our Newsletter</h1>
                <p class="text-white mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum tempore nam, architecto doloremque velit explicabo? Voluptate sunt eveniet fuga eligendi! Expedita laudantium fugiat corrupti eum cum repellat a laborum quasi.
                </p>
                <div class="position-relative mx-auto">
                    <input class="form-control border-primary rounded-pill w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                    <button type="button" class="btn btn-primary rounded-pill position-absolute top-0 end-0 py-2 px-4 mt-2 me-2">Subscribe</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Subscribe End -->

    <!-- Footer Start -->
    <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Get In Touch</h4>
                        <a href=""><i class="fas fa-home me-2"></i> 123 Street, New York, USA</a>
                        <a href=""><i class="fas fa-envelope me-2"></i> info@example.com</a>
                        <a href=""><i class="fas fa-phone me-2"></i> +012 345 67890</a>
                        <a href="" class="mb-3"><i class="fas fa-print me-2"></i> +012 345 67890</a>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-share fa-2x text-white me-2"></i>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn-square btn btn-primary rounded-circle mx-1" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Company</h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> About</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Careers</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Blog</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Press</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Gift Cards</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Magazine</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Support</h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Contact</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Legal Notice</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Privacy Policy</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Terms and Conditions</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Sitemap</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Cookie policy</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <div class="row gy-3 gx-2 mb-4">
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border" id="select1">
                                            <option value="1">Arabic</option>
                                            <option value="2">German</option>
                                            <option value="3">Greek</option>
                                            <option value="3">New York</option>
                                        </select>
                                        <label for="select1">English</label>
                                    </div>
                                </form>
                            </div>
                            <div class="col-xl-6">
                                <form>
                                    <div class="form-floating">
                                        <select class="form-select bg-dark border" id="select1">
                                            <option value="1">USD</option>
                                            <option value="2">EUR</option>
                                            <option value="3">INR</option>
                                            <option value="3">GBP</option>
                                        </select>
                                        <label for="select1">$</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <h4 class="text-white mb-3">Payments</h4>
                        <div class="footer-bank-card">
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-amex fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-visa fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fas fa-credit-card fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-mastercard fa-2x"></i></a>
                            <a href="#" class="text-white me-2"><i class="fab fa-cc-paypal fa-2x"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-cc-discover fa-2x"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright text-body py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-6 text-center text-md-end mb-md-0">
                    <i class="fas fa-copyright me-2"></i><a class="text-white" href="#">Your Site Name</a>, All right reserved.
                </div>
                <div class="col-md-6 text-center text-md-start">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="text-white" href="https://htmlcodex.com">HTML Codex</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById('registrationForm');
            form.addEventListener('submit', function(event) {
                let isValid = true;

                const inputName = document.getElementById('inputName');
                const inputLastName = document.getElementById('inputLastname');
                const inputEmail = document.getElementById('inputEmail');
                const inputPhone = document.getElementById('inputPhone');

                // Validate Name
                if (/\d/.test(inputName.value)) {
                    isValid = false;
                    inputName.classList.add('is-invalid');
                } else {
                    inputName.classList.remove('is-invalid');
                }

                // Validate LastName
                if (/\d/.test(inputLastName.value)) {
                    isValid = false;
                    inputLastName.classList.add('is-invalid');
                } else {
                    inputLastName.classList.remove('is-invalid');
                }

                // Validate Email
                if (!/^\S+@\S+\.\S+$/.test(inputEmail.value)) {
                    isValid = false;
                    inputEmail.classList.add('is-invalid');
                } else {
                    inputEmail.classList.remove('is-invalid');
                }

                // Validate Phone Number
                if (!/^\d+$/.test(inputPhone.value)) {
                    isValid = false;
                    inputPhone.classList.add('is-invalid');
                } else {
                    inputPhone.classList.remove('is-invalid');
                }

                if (!isValid) {
                    event.preventDefault();
                    event.stopPropagation(); 
                }
            });

            Array.from(document.querySelectorAll('.needs-validation'))
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }

                        
                    }, false);
                });
        });
    </script>


    <script src="js/main.js"></script>
</body>

</html>