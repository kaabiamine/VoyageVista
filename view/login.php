<?php
$page = isset($_GET['failed']) ? $_GET['failed'] : null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CelestialUI Admin</title>
  <link rel="stylesheet" href="admin/vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="admin/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-center py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="admin/images/logo.png" alt="logo">
              </div>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="../model/login.php" method="POST" >
                <?php
                if ($page == '1') {
                  echo '<div class="alert alert-danger" role="alert">Incorrect password !!</div>';
                } elseif ($page == '2') {
                  echo '<div class="alert alert-danger" role="alert">No user found with that email address. !!</div>';
                } elseif ($page == '3') {
                  echo '<div class="alert alert-danger" role="alert">Email and password are required.. !!</div>';
                } elseif ($page == '4') {
                  echo '<div class="alert alert-danger" role="alert">Please use the login form to submit your data.</div>';
                }
                ?>
                <div class="form-group">
                  <input type="email" name="mail" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <input type="submit" style="background-color: #4695CC !important;" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="SIGN IN">
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="forgot_password.php" class="auth-link text-black">Forgot password?</a>
                </div>

                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.php"style="color: #4695CC !important;" class="text-primary">Create</a>
                </div>
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