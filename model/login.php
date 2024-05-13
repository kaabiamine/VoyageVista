<?php
require '../Controller/connect.php'; 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['mail']) && !empty($_POST['password'])) {
        $mail = trim($_POST['mail']);
        $password = $_POST['password']; 

        $pdo = config::getConnexion();

        $stmt = $pdo->prepare("SELECT id, email, password, role FROM user WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $mail);
        $stmt->execute();

        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            
            if ($password == $user['password']){
                
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['user'] = $user; 


                
                switch ($user['role']) {
                    case '1':
                        header('Location: ../view/admin/index.php'); 
                        exit;
                    case '2':
                        header('Location: ../view/client/index.php'); 
                        exit;
                    default:
                        echo 'Undefined user role.';
                }
            } else {
                header('Location: ../view/login.php?failed=1'); 
                exit;
            }
        } else {
            header('Location: ../view/login.php?failed=2'); 
            exit;
        }
    } else {
        header('Location: ../view/login.php?failed=3'); 
        exit;
 
    }
} else {
    header('Location: ../view/index.php?failed=4'); 
    exit;
}

?>
