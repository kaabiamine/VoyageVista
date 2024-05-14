<?php
require '../Controller/user_con.php'; 
require '../Model/user.php'; 

$userCon = new UserCon("user");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check all required fields are set and not empty
    if (isset($_POST['email'], $_POST['name'], $_POST['lastname'], $_POST['password'], $_POST['phone'], $_POST['address']) &&
        !empty($_POST['email']) && !empty($_POST['name']) && !empty($_POST['lastname']) && !empty($_POST['password']) && !empty($_POST['phone']) && !empty($_POST['address'])) {

        $email = $_POST['email'];
        $name = $_POST['name'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $role = 2; 

        $pdo = config::getConnexion();

        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            header('Location: ../view/register.php?result=4');
            exit;
        }

        // Hash the password
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add user to the database
        $result = $userCon->addUser($email, $role, $name, $lastname, $password, $address, $phone);
        if ($result == 'true') {
            header('Location: ../View/register.php?result=1');
            exit;
        } else {
            header('Location: ../View/register.php?result=2'.$result.' ');
            exit;
        }
    } else {
        header('Location: ../View/register.php?result=3');
        exit;
    }
} else {
    header('Location: ../View/register.php?result=2');
   
}