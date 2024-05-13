<?php
include '../Controller/user_con.php'; // Assuming UserController is implemented in this file
include '../Model/user.php'; // Assuming User model class is defined in this file

// Create an instance of the UserController
$userC = new Usercon("user");

// Check if all required POST data are available and not empty
if (isset($_POST['email'], $_POST['nom'], $_POST['prenom'], $_POST['tel'], $_POST['role'], $_POST['adresse'], $_POST['id'], $_POST['password']) &&
    !empty($_POST['email']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['tel']) && !empty($_POST['role']) && !empty($_POST['adresse']) && !empty($_POST['id']) && !empty($_POST['password'])) {
    
    // Sanitize and prepare data
    $id = $_POST['id'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $role = $_POST['role'];
    $adresse = $_POST['adresse'];
    $password = $_POST['password']; // Assuming password needs to be hashed

    // Hash the password
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update user in the database
    $result = $userC->updateUser($id, $email, $role, $nom, $prenom, $password, $adresse, $tel);
    if ($result == 'true') {
        header('Location: ../view/client/profile.php?&result=1'); // Success
        exit;
    } else {
        header('Location: ../view/client/profile.php?&result=2'); // Error during profile
        exit;
    }
} else {
    header('Location: ../view/client/profile.php?&result=3'); // Missing or incorrect form data
    exit;
}

?>
