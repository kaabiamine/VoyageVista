<?php
session_start(); // Start the session to access session variables
require '../Controller/user_con.php'; // Include UserController
require '../Model/user.php'; // Include User model class

// Create an instance of the UserController
$userC = new Usercon("user");

// Check if all required POST data are available
if (isset($_POST['id'], $_POST['current_password'], $_POST['new_password'], $_POST['confirm_password'])) {
    // Retrieve user data from database
    $user = $userC->getUser($_POST['id']);

    // Check if current password is correct
    if ($_POST['current_password'] == $user['password']) {
        // Check if new password and confirm password match
        if ($_POST['new_password'] === $_POST['confirm_password']) {
            // Update password in the database
            $result = $userC->updateUserPassword($_POST['id'], $_POST['new_password']);
            if ($result) {
                header('Location: ../view/client/change_password.php?result=1'); // Success
                exit;
            } else {
                header('Location: ../view/client/change_password.php?result=2'); // Error during update
                exit;
            }
        } else {
            header('Location: ../view/client/change_password.php?result=3'); // Passwords do not match
            exit;
        }
    } else {
        header('Location: ../view/client/change_password.php?result=4'); // Incorrect current password
        exit;
    }
} else {
    header('Location: ../view/client/change_password.php?result=5'); // Missing POST data
    exit;
}

?>
