<?php
// Default configuration for the navbar if not provided by the page including this component
$navbarConfig = $navbarConfig ?? [
    'activePage' => 'Dashboard',
    'userName' => 'Default User',
    'messages' => [],
    'notifications' => [],
    'navItems' => [
        ['name' => 'Calendar', 'link' => '../path/to/calendar.php'],
        ['name' => 'Statistic', 'link' => '../path/to/statistics.php'],
        ['name' => 'Employee', 'link' => '../path/to/employees.php'],
    ],
    'helpLink' => '../path/to/help.php',
    'profile' => [
        'name' => 'Evan Morales',
        'settingsLink' => '#',
        'logoutLink' => '#'
    ]
];
?>

<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="../template/index.php"><img src="../template/images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../template/index.php"><img src="../template/images/logo-mini.svg" alt="logo"/></a>
        <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <?php foreach ($navbarConfig['navItems'] as $item): ?>
                <li class="nav-item d-none d-lg-flex <?= ($navbarConfig['activePage'] == $item['name']) ? 'active' : ''; ?>">
                    <a class="nav-link" href="<?= $item['link']; ?>"><?= $item['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item d-none d-lg-flex mr-2">
                <a class="nav-link" href="<?= $navbarConfig['helpLink']; ?>">Help</a>
            </li>
            <li class="nav-item dropdown d-flex">
                <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-message-typing"></i>
                    <span class="count bg-success"><?= count($navbarConfig['messages']); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                    <?php foreach ($navbarConfig['messages'] as $message): ?>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <img src="<?= $message['img']; ?>" alt="image" class="profile-pic">
                            </div>
                            <div class="preview-item-content flex-grow">
                                <h6 class="preview-subject ellipsis font-weight-normal"><?= $message['name']; ?></h6>
                                <p class="font-weight-light small-text mb-0"><?= $message['text']; ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item dropdown d-flex">
                <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="typcn typcn-bell mr-0"></i>
                    <span class="count bg-danger"><?= count($navbarConfig['notifications']); ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <?php foreach ($navbarConfig['notifications'] as $notification): ?>
                        <a class="dropdown-item preview-item">
                            <div class="preview-thumbnail">
                                <div class="preview-icon bg-<?= $notification['type']; ?>">
                                    <i class="typcn <?= $notification['icon']; ?> mx-0"></i>
                                </div>
                            </div>
                            <div class="preview-item-content">
                                <h6 class="preview-subject font-weight-normal"><?= $notification['title']; ?></h6>
                                <p class="font-weight-light small-text mb-0"><?= $notification['description']; ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </li>
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="typcn typcn-user-outline mr-0"></i>
                    <span class="nav-profile-name"><?= $navbarConfig['profile']['name']; ?></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="<?= $navbarConfig['profile']['settingsLink']; ?>">
                        <i class="typcn typcn-cog text-primary"></i>
                        Settings
                    </a>
                    <a class="dropdown-item" href="<?= $navbarConfig['profile']['logoutLink']; ?>">
                        <i class="typcn typcn-power text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="typcn typcn-th-menu"></span>
        </button>
    </div>
</nav>
