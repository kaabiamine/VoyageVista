<?php
include_once '../../Model/ReservationModel.php';
include_once "../../Controller/ReservationController.php";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

        // Retrieve form data
        $date_reservation = $_POST['datetime'];
        $nom = $_POST['name'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $telephone = $_POST['phone'];
        $nb_enfants = $_POST['CategoriesSelect'] ;
        $nb_adultes = $_POST['SelectPerson'] - $nb_enfants;

        if (isset ($_POST['datetime']) && isset($_POST['name']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['SelectPerson']) && isset($_POST['CategoriesSelect'])) {
            // Create a new ReservationModel instance
            $reservation = new ReservationModel($date_reservation, $nom, $prenom, $email, $telephone, $nb_enfants, $nb_adultes,0 , 1);
//            echo $reservation->getDateReservation();
//            echo $reservation->getNom();
//            echo $reservation->getPrenom();
//            echo $reservation->getEmail();
//            echo $reservation->getTelephone();
//            echo $reservation->getNbEnfants();
//            echo $reservation->getNbAdultes();

            $reservationController = new ReservationController();
            $result = $reservationController->createReservation($reservation);
            if ($result) {
                echo "Reservation added successfully!";
            } else {
                echo "Failed to add reservation.";
            }
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php require_once('./components/header.php'); ?>

<body>

<?php require_once('./components/navbar.php'); ?>

<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <p class="text-white mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur maxime ullam esse fuga blanditiis accusantium pariatur quis sapiente, veniam doloribus praesentium? Repudiandae iste voluptatem fugiat doloribus quasi quo iure officia.
                </p>
                <a href="#" class="btn btn-light text-primary rounded-pill py-3 px-5 mt-2">Read More</a>
            </div>
            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book A Tour Deals</h1>
                <p class="text-white mb-4">Get <span class="text-warning">50% Off</span> On Your First Adventure Trip With Travela. Get More Deal Offers Here.</p>
                <form method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="name" name="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" name="prenom" id="prenom" placeholder="Your prenom">
                                <label for="prenom">Your Prenom</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0" id="email" name="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control bg-white border-0" id="phone" name="phone" placeholder="Your Phone number">
                                <label for="phone">Your Phone number</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="datetime-local" class="form-control bg-white border-0" id="datetime" name="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" />
                                <label for="datetime">Date & Time</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson" name="SelectPerson">
                                    <option value="1">Persons 1</option>
                                    <option value="2">Persons 2</option>
                                    <option value="3">Persons 3</option>
                                    <option value="4">Persons 4</option>
                                    <option value="5">Persons 5</option>
                                    <option value="6">Persons 6</option>
                                </select>
                                <label for="SelectPerson">Persons</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="CategoriesSelect" name="CategoriesSelect">
                                    <option value="1">Kids</option>
                                    <option value="2">1</option>
                                    <option value="3">2</option>
                                    <option value="3">3</option>
                                </select>
                                <label for="CategoriesSelect">Categories</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit" value="submit">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tour Booking End -->

<?php require_once('./components/footer.php'); ?>
</body>

</html>
