<?php
include '../Controller/user_con.php';
include 'user.php';

// Création d'une instance du contrôleur des événements
$userC = new userCon("user");

// Création d'une instance de la classe Event
$user = null;



if (isset($_POST['id'])) {
    $current_id = $_POST['id'];
    
    $userC->deleteUser($current_id);
    
    header('Location:../view/login.php');
}
?>