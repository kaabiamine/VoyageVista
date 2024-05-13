<?php
require 'C:/xampp/htdocs/web_1/controller/user_con.php';

// Vérifie si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password'], $_POST['confirm_password'], $_GET['token'])) {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $token = $_GET['token'];

    // Vérifie si les mots de passe correspondent
    if ($password !== $confirmPassword) {
        echo "Error: Passwords do not match.";
    } else {
        // Crée une instance de la classe UserCon
        $userCon = new UserCon();

        // Vérifie si le token est valide
        if ($userCon->validateToken($token)) {
            // Mettre à jour le mot de passe dans la base de données
            if ($userCon->ResetUserPassword($token, $password)) {
                // Redirection vers la page de connexion avec un message de succès
                header("Location: login.php?password_updated=true");
                exit;
            } else {
                echo "Failed to update password. Please try again later.";
            }
        } else {
            echo "Invalid or expired token.";
        }
    }
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="admin/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body>
<?php
    // Vérifie si le mot de passe a été mis à jour avec succès
    if (isset($_GET['password_updated']) && $_GET['password_updated'] == "true") {
        echo "<p>Password updated successfully.</p>";
    }
    ?>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <img src="admin/images/logo.png" alt="logo">
                            </div>
                            <form class="pt-3" action="" method="POST">
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="password" placeholder="Enter your new password:">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password"
                                        class="form-control form-control-lg" id="confirm_password"
                                        placeholder="Confirm your new password:">
                                </div>
                                <div class="mt-3">
                                    <input type="submit"
                                        style="background-color: #4695CC !important;"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        value="Reset Password">
                                </div>
                                <input type="hidden" name="token"
                                    value="<?php echo htmlspecialchars($_GET['token']); ?>">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="admin/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin/js/off-canvas.js"></script>
    <script src="admin/js/hoverable-collapse.js"></script>
    <script src="admin/js/template.js"></script>
    <script src="admin/js/settings.js"></script>
    <script src="admin/js/todolist.js"></script>
</body>

</html>
