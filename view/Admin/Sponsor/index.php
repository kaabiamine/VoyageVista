<?php
// Include the necessary files and controllers
require_once('../components/head.php');
require_once('../../../Controller/StatSponsorController.php');
// USER VERIFICATION ===========================================================
//include_once '../../../controller/verify_login.php';
//
//if (isset($_SESSION['user'])) {
//    $user1 = $_SESSION['id'];
//    $role = $_SESSION['role'];
//    if ($role == 2) {
//        header('Location: ../../login.php');
//    }
//}else{
//    header('Location: ../../login.php');
//}
//==============================================================================
// Fetching data using the previously defined functions
$totalContractsBySponsor = StatSponsorController::getTotalContractsBySponsor();
$totalRevenueBySponsor = StatSponsorController::getTotalRevenueBySponsor();
$contractsOverview = StatSponsorController::getContractsOverview();
$averageContractDuration = StatSponsorController::getAverageContractDurationBySponsor();
$activeContracts = StatSponsorController::getContractsByStatus(1); // 1 for active
$expiredContracts = StatSponsorController::getContractsByStatus(0); // 0 for expired

// Prepare data for charts
$sponsorNames = [];
$totalContractsData = [];
$totalRevenueData = [];

foreach ($totalContractsBySponsor as $contract) {
    $sponsorNames[] = $contract['sponsor_name'];
    $totalContractsData[] = $contract['total_contracts'];
}

foreach ($totalRevenueBySponsor as $revenue) {
    $totalRevenueData[] = $revenue['total_revenue'];
}

// Convert data to JavaScript-readable format
$sponsorNamesJsArray = json_encode($sponsorNames);
$totalContractsJsArray = json_encode($totalContractsData);
$totalRevenueJsArray = json_encode($totalRevenueData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php require_once('../components-sponsor/head.php'); ?>
    <title>Statistics Dashboard</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container-scroller">
    <!-- Navbar -->
    <?php
    $navbarConfig = $navbarConfig ?? [
        'activePage' => 'Dashboard',
        'userName' => 'Default User',
        'messages' => [],
        'notifications' => [],
        'navItems' => [
            ['name' => 'Sponsors', 'link' => 'AfficherSponsors.php'],
            ['name' => 'Packs', 'link' => '../SponsorPack/AfficherPacks.php'],
            ['name' => 'Contracts', 'link' => '../SponsorContract/AfficherSponsorContracts.php'],
        ],
        'helpLink' => '../path/to/help.php',
        'profile' => [
            'name' => 'Evan Morales',
            'settingsLink' => '#',
            'logoutLink' => '#'
        ]
    ];

    require_once('../components-sponsor/navbarSponsor.php'); ?>




        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Contracts by Sponsor</h4>
                                <canvas id="totalContractsChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Total Revenue by Sponsor</h4>
                                <canvas id="totalRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Average Contract Duration by Sponsor</h4>
                                <canvas id="avgContractDurationChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Active vs Expired Contracts</h4>
                                <canvas id="contractsOverviewChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->

            <!-- Footer -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-center text-sm-left d-block d-sm-inline-block">Copyright © bootstrapdash.com 2020</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Free Bootstrap dashboard templates from Bootstrapdash.com</span>
                </div>
            </footer>
            <!-- partial -->
        </div>

<script>
    // Convert PHP arrays to JavaScript arrays
    const sponsorNames = <?php echo $sponsorNamesJsArray; ?>;
    const totalContractsData = <?php echo $totalContractsJsArray; ?>;
    const totalRevenueData = <?php echo $totalRevenueJsArray; ?>;
    const avgDurations = <?php echo json_encode(array_column($averageContractDuration, 'avg_duration')); ?>;
    const activeContracts = <?php echo json_encode(array_column($contractsOverview, 'active_contracts')); ?>;
    const expiredContracts = <?php echo json_encode(array_column($contractsOverview, 'expired_contracts')); ?>;

    // Total Contracts by Sponsor - Bar Chart
    new Chart(document.getElementById('totalContractsChart'), {
        type: 'bar',
        data: {
            labels: sponsorNames,
            datasets: [{
                label: 'Total Contracts',
                data: totalContractsData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Total Revenue by Sponsor - Bar Chart
    new Chart(document.getElementById('totalRevenueChart'), {
        type: 'bar',
        data: {
            labels: sponsorNames,
            datasets: [{
                label: 'Total Revenue ($)',
                data: totalRevenueData,
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Average Contract Duration by Sponsor - Line Chart
    new Chart(document.getElementById('avgContractDurationChart'), {
        type: 'line',
        data: {
            labels: sponsorNames,
            datasets: [{
                label: 'Average Duration (Days)',
                data: avgDurations,
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    // Active vs Expired Contracts - Doughnut Chart
    new Chart(document.getElementById('contractsOverviewChart'), {
        type: 'doughnut',
        data: {
            labels: ['Active Contracts', 'Expired Contracts'],
            datasets: [{
                label: 'Contracts Overview',
                data: [activeContracts.reduce((a, b) => a + b, 0), expiredContracts.reduce((a, b) => a + b, 0)],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>

<!-- Include other scripts if needed -->
<?php require_once('../components/footer-scripts.php'); ?>
</body>
</html>
