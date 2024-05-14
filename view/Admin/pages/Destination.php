<?php
require_once '../../../cnx1.php';
include '../../../controller/user_con.php';
include_once '../../../controller\DestinationsC.php'; // Fixed path
require_once '../../../model\Destination.php'; // Fixed path
include_once '../../../controller\ForfaitC.php'; // Fixed path
require_once '../../../model\Forfait.php'; // Fixed path


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

$destinationC = new DestinationsC(Cnx1::getConnexion());
$forfaitC = new ForfaitC(Cnx1::getConnexion());

// Check if search term is provided
if (isset($_GET['search'])) {
  $searchTerm = $_GET['search'];
  $listeforfait = $forfaitC->searchForfaitByNomForfait($searchTerm);
} else {
  // If no search term provided, fetch all forfaits
  $listeforfait = $forfaitC->listForfaits();
}

// Rest of your code
if (isset($_GET['id'])) {
  $destinationToEdit = $destinationC->getDestinationById($_GET['id']);
}

$listeDestinations = $destinationC->listDestinations();
?>

<!-- Your HTML code goes here -->

<?php
require_once '../../../controller/ForfaitC.php';

$forfaitC = new ForfaitC(Cnx1::getConnexion());
$forfaitsByDestination = $forfaitC->countForfaitsByDestination();

// Extracting labels and data from the result
$labels = [];
$data = [];
foreach ($forfaitsByDestination as $forfait) {
  $labels[] = $forfait['Nom_destinatio'];
  $data[] = $forfait['count_forfaits'];
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CelestialUI Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="row" id="proBanner">

  </div>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.php"><img src="../images/logo.svg" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="../images/logo-mini.svg" alt="logo" /></a>
        <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button"
          data-toggle="minimize">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item  d-none d-lg-flex">
            <a class="nav-link" href="#">
              Calendar
            </a>
          </li>
          <li class="nav-item  d-none d-lg-flex">
            <a class="nav-link active" href="#">
              Statistic
            </a>
          </li>
          <li class="nav-item  d-none d-lg-flex">
            <a class="nav-link" href="#">
              Employee
            </a>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item d-none d-lg-flex  mr-2">
            <a class="nav-link" href="#">
              Help
            </a>
          </li>
          <li class="nav-item dropdown d-flex">
            <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
              id="messageDropdown" href="#" data-toggle="dropdown">
              <i class="typcn typcn-message-typing"></i>
              <span class="count bg-success">2</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
              aria-labelledby="messageDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face4.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    The meeting is cancelled
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face2.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    New product launch
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="images/faces/face3.jpg" alt="image" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                  </h6>
                  <p class="font-weight-light small-text mb-0">
                    Upcoming board meeting
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-flex">

          </li>

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
              <i class="typcn typcn-user-outline mr-0"></i>
              <span class="nav-profile-name">Evan Morales</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="typcn typcn-cog text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="typcn typcn-power text-primary"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
          data-toggle="offcanvas">
          <span class="typcn typcn-th-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close typcn typcn-delete-outline"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options" id="sidebar-light-theme">
            <div class="img-ss rounded-circle bg-light border mr-3"></div>
            Light
          </div>
          <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
            <div class="img-ss rounded-circle bg-dark border mr-3"></div>
            Dark
          </div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles primary"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default border"></div>
          </div>
        </div>
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <?php require 'menu.php'; ?> 
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-target="#addDestinationModal">Add Destination</button>
                  <button onclick="generatePDF()" class="btn btn-primary">Generate PDF</button>
                  <!-- <a href="stat.php" class="btn btn-primary">Go stat</a> -->
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Go
                    stat</button>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModall">Go
                    Chat</button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des destinations</h4>
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nom</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Description</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listeDestinations as $destination): ?>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0"><?php echo $destination['idD']; ?></p>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $destination['Nom_destinatio']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $destination['Description']; ?></span>
                            </td>
                            <td class="align-middle">
                              <button type="button" class="btn btn-sm btn-secondary me-2 edit-destination-btn"
                                data-toggle="modal" data-target="#editDestinationModal"
                                data-id="<?php echo $destination['idD']; ?>"
                                data-description="<?php echo $destination['Description']; ?>"
                                data-name="<?php echo $destination['Nom_destinatio']; ?>">
                                Edit
                              </button>
                              <a href="process_destination.php?delete=<?php echo $destination['idD']; ?>"
                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                data-original-title="Delete destination">Delete</a>
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
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form action="" method="GET" class="mb-3">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search by Nom forfait" name="search">
                      <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                  </form>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addForfaitModal">
                    Add Forfait
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des destinations</h4>
                  <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">ID</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Nom
                            Forfait</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Prix
                          </th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Date
                            Départ</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Date
                            Retour</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Places
                            Dispo</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            Destination Name</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($listeforfait as $forfait): ?>
                          <tr>
                            <td>
                              <p class="text-xs font-weight-bold mb-0"><?php echo $forfait['id_forfait']; ?></p>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $forfait['nom_forfait']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="text-secondary text-xs font-weight-bold"><?php echo $forfait['prix']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $forfait['date_depart']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $forfait['date_retour']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $forfait['place_dispo']; ?></span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span
                                class="text-secondary text-xs font-weight-bold"><?php echo $forfait['destination_name']; ?></span>
                            </td>
                            <td class="align-middle">
                              <a href="#" class="btn btn-sm btn-secondary edit-forfait-btn" data-toggle="modal"
                                data-target="#editForfaitModal" data-id="<?php echo $forfait['id_forfait']; ?>"
                                data-nom="<?php echo $forfait['nom_forfait']; ?>"
                                data-prix="<?php echo $forfait['prix']; ?>"
                                data-date-depart="<?php echo $forfait['date_depart']; ?>"
                                data-date-retour="<?php echo $forfait['date_retour']; ?>"
                                data-place-dispo="<?php echo $forfait['place_dispo']; ?>">
                                Edit
                              </a>

                              <a href="process_forfait.php?delete=<?php echo $forfait['id_forfait']; ?>"
                                class="btn btn-sm btn-danger" data-toggle="tooltip"
                                data-original-title="Delete forfait">Delete</a>
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




















        <!-- Edit Destination Modal -->
        <div class="modal fade" id="editDestinationModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Edit Destination</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <!-- Form for editing destination -->
                <form method="POST" action="process_destination.php">
                  <input type="hidden" id="editDestinationId" name="id">
                  <div class="form-group">
                    <label for="editDestinationDescription">Description:</label>
                    <input type="text" class="form-control" id="editDestinationDescription" name="Description">
                  </div>
                  <div class="form-group">
                    <label for="editDestinationName">Nom_destinatio:</label>
                    <input type="text" class="form-control" id="editDestinationName" name="Nom_destinatio">
                  </div>
                  <button type="submit" class="btn btn-primary" name="edit">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Statistique</h4>
              </div>
              <div class="modal-body">

                <head>

                  <!-- Include Chart.js JavaScript library -->
                  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                </head>

                <body>


                  <!-- Div to display the chart -->
                  <div style="width: 500px; height: 400px;">
                    <canvas id="forfaitsChart"></canvas>
                  </div>

                  <script>
                    // Retrieve forfait data from PHP
                    var labels = <?php echo json_encode($labels); ?>; // Labels for X-axis (e.g., destination names)
                    var data = <?php echo json_encode($data); ?>; // Data for Y-axis (e.g., number of forfaits per destination)

                    // Create a new chart with Chart.js
                    var ctx = document.getElementById('forfaitsChart').getContext('2d');
                    var forfaitsChart = new Chart(ctx, {
                      type: 'bar', // Chart type (bar, pie, line, etc.)
                      data: {
                        labels: labels, // Labels for X-axis
                        datasets: [{
                          label: 'Forfaits', // Data series name
                          data: data, // Data for Y-axis
                          backgroundColor: 'rgba(75, 192, 192, 0.2)', // Background color of bars
                          borderColor: 'rgba(75, 192, 192, 1)', // Border color of bars
                          borderWidth: 1 // Border width of bars
                        }]
                      },
                      options: {
                        scales: {
                          yAxes: [{
                            ticks: {
                              beginAtZero: true // Start Y-axis at zero
                            }
                          }]
                        }
                      }
                    });
                  </script>
                </body>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>

        <!-- Add Destination Modal -->
        <div class="modal fade" id="addDestinationModal" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Add New Destination</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <!-- Add your form fields for adding a new destination here -->
                <form method="POST" action="process_destination.php" onsubmit="return validateForm()">
                  <div class="form-group">
                    <label for="destination_name">Destination Name:</label>
                    <input type="text" class="form-control" id="Nom_destinatio" name="Nom_destinatio">
                  </div>
                  <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
                  </div>
                  <button type="submit" name="add" class="btn btn-primary">Submit</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Add Forfait Modal -->
        <div class="modal fade" id="addForfaitModal" tabindex="-1" aria-labelledby="addForfaitModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addForfaitModalLabel">Add New Forfait</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Add your form fields for adding a new forfait here -->
                <form method="POST" action="process_forfait.php" onsubmit="return validateForfaitForm()">
                  <div class="mb-3">
                    <label for="Nom_forfait" class="form-label">Nom forfait</label>
                    <input type="text" class="form-control" id="Nom_forfait" name="Nom_forfait">
                  </div>
                  <!-- Other input fields... -->
                  <div class="mb-3">
                    <label for="Prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="Prix" name="Prix">
                  </div>
                  <div class="mb-3">
                    <label for="Date_depart" class="form-label">Date depart</label>
                    <input type="date" class="form-control" id="Date_depart" name="Date_depart">
                  </div>
                  <div class="mb-3">
                    <label for="Date_retour" class="form-label">Date retour</label>
                    <input type="date" class="form-control" id="Date_retour" name="Date_retour">
                  </div>
                  <div class="mb-3">
                    <label for="Place_dispo" class="form-label">Place disponible</label>
                    <input type="number" class="form-control" id="Place_dispo" name="Place_dispo">
                  </div>
                  <!-- Dropdown list for selecting destination -->
                  <div class="mb-3">
                    <label for="Destination" class="form-label">Destination</label>
                    <select class="form-select" id="Destination" name="Destination">
                      <!-- Populate options dynamically from database -->
                      <?php foreach ($listeDestinations as $destination): ?>
                        <option value="<?php echo $destination['idD']; ?>"><?php echo $destination['Nom_destinatio']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary" name="add_forfait">Add</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Forfait Modal -->
        <div class="modal fade" id="editForfaitModal" tabindex="-1" aria-labelledby="editForfaitModalLabel"
          aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editForfaitModalLabel">Edit Forfait</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <!-- Add your form fields for editing a forfait here -->
                <form method="POST" action="process_forfait.php" onsubmit="return validateForfaitForm()">
                  <input type="hidden" id="edit_forfait_id" name="id_forfait">
                  <div class="mb-3">
                    <label for="edit_Nom_forfait" class="form-label">Nom forfait</label>
                    <input type="text" class="form-control" id="edit_Nom_forfait" name="nom_forfait">
                  </div>
                  <!-- Other input fields... -->
                  <div class="mb-3">
                    <label for="edit_Prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="edit_Prix" name="prix">
                  </div>
                  <div class="mb-3">
                    <label for="edit_Date_depart" class="form-label">Date depart</label>
                    <input type="date" class="form-control" id="edit_Date_depart" name="date_depart">
                  </div>
                  <div class="mb-3">
                    <label for="edit_Date_retour" class="form-label">Date retour</label>
                    <input type="date" class="form-control" id="edit_Date_retour" name="date_retour">
                  </div>
                  <div class="mb-3">
                    <label for="edit_Place_dispo" class="form-label">Place disponible</label>
                    <input type="number" class="form-control" id="edit_Place_dispo" name="place_disponible">
                  </div>
                  <!-- Dropdown list for selecting destination -->
                  <button type="submit" class="btn btn-primary" name="edit_forfait">Update</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <script>
          function validateForm() {
            var Description = document.getElementById("Description").value;
            var Nom_destinatio = document.getElementById("Nom_destinatio").value;


            var errors = [];

            if (Description.trim() === "") {
              errors.push("Description is required");
            }

            if (Nom_destinatio.trim() === "") {
              errors.push("Nom_destinatio is required");
            }



            if (errors.length > 0) {
              // Display error messages
              var errorMessage = errors.join("\n");
              alert(errorMessage);
              return false; // Prevent form submission
            }

            return true; // Allow form submission
          }
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Modal -->
        <div class="modal fade" id="myModall" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">CHAT</h4>
              </div>
              <div class="chat-messages" id="chatMessages">
                <p>Welcome to the chatbot!</p>
              </div>
              <input type="text" id="userInput" class="chat-input" placeholder="Type your message...">
              <button onclick="sendMessage()" class="chat-button">Send</button>
            </div>

            <script>
              function sendMessage() {
                var message = document.getElementById("userInput").value;
                if (message.trim() !== "") {
                  displayMessage("You: " + message);
                  document.getElementById("userInput").value = "";

                  // Send message to PHP script
                  var xhr = new XMLHttpRequest();
                  xhr.open("POST", "simple_chatbot.php", true);
                  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                  xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      var response = JSON.parse(xhr.responseText);
                      displayMessage("Chatbot: " + response.response);
                    }
                  };
                  xhr.send("message=" + message);
                }
              }

              function displayMessage(message) {
                var chatMessages = document.getElementById("chatMessages");
                var p = document.createElement("p");
                p.textContent = message;
                chatMessages.appendChild(p);
                chatMessages.scrollTop = chatMessages.scrollHeight;
              }
            </script>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script>
      $(document).ready(function () {
        $('.edit-forfait-btn').click(function () {
          var forfaitId = $(this).data('id');
          var nomForfait = $(this).data('nom');
          var prix = $(this).data('prix');
          var dateDepart = $(this).data('date-depart');
          var dateRetour = $(this).data('date-retour');
          var placeDispo = $(this).data('place-dispo');
          $('#edit_forfait_id').val(forfaitId);
          $('#edit_Nom_forfait').val(nomForfait);
          $('#edit_Prix').val(prix);
          $('#edit_Date_depart').val(dateDepart);
          $('#edit_Date_retour').val(dateRetour);
          $('#edit_Place_dispo').val(placeDispo);
        });
      });

      $(document).ready(function () {
        $('.edit-destination-btn').click(function () {
          var id = $(this).data('id');
          var description = $(this).data('description');
          var name = $(this).data('name');

          $('#editDestinationId').val(id);
          $('#editDestinationDescription').val(description);
          $('#editDestinationName').val(name);
        });
      });
    </script>


    <style>
      .chat-container {
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 5px;
        overflow: hidden;
      }

      .chat-messages {
        padding: 10px;
        max-height: 300px;
        overflow-y: auto;
      }

      .chat-input {
        width: 100%;
        padding: 10px;
        border: none;
        border-top: 1px solid #ccc;
        outline: none;
      }

      .chat-button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
        outline: none;
      }
    </style>
    <script src="../vendors/js/vendor.bundle.base.js"></script>
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/template.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/todolist.js"></script>
    <script src="../vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <script src="../js/dashboard.js"></script>
    <script src="../admin/js/controle_de_saisie.js"></script>
    <script>
      function generatePDF() {
        window.location.href = 'generate_pdf.php';
      }
    </script>
</body>

</html>