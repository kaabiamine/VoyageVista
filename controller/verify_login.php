<?php

session_start();

// Prevent this page from being cached by the browser.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");


if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit;
}

// The rest of your protected page code goes here.
?>