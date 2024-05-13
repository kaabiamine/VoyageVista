<?php
$result = isset($_GET['result']) ? $_GET['result'] : null;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register</title>
  <!-- base:css -->
  <link rel="stylesheet" href="admin/vendors/typicons.font/font/typicons.css">
  <link rel="stylesheet" href="admin/vendors/css/vendor.bundle.base.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="admin/css/vertical-layout-light/style.css">
  <style>
    .error {
      color: red;
    }
  </style>
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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <?php
              switch ($result) {
                case '1':
                  echo '<div class="alert alert-success" role="alert">User created successfully !</div>
                            <div class="card bg-success mb-3 " style="max-width: 100rem;"></div>';
                  break;

                case '2':
                  echo '<div class="alert alert-danger" role="alert">An error occurred !</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;"></div>';
                  break;
                case '3':
                  echo '<div class="alert alert-danger" role="alert">Please submit the form.!</div>
                            <div class="card border-danger mb-3 " style="max-width: 100rem;"></div>';
                  break;
                case '4':
                  echo '<div class="alert alert-warning" role="alert">Email already exists.!</div>
                                    <div class="card border-warning mb-3 " style="max-width: 100rem;"></div>';
                  break;
                default:
                  echo '<div class="alert alert-primary" role="alert">Input the FORM !</div>
                            <div class="card border-dark mb-3 " style="max-width: 100rem;"></div>';
                  break;
              }
              ?>
              <form class="pt-3 needs-validation" action="../model/register.php" method="post" id="registrationForm" novalidate>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputName" name="name" placeholder="Name" required>
                  <div class="invalid-feedback">Name should not contain numbers.</div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputLastname" name="lastname" placeholder="Lastname">
                  <div class="invalid-feedback">LastName should not contain numbers.</div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="inputEmail" name="email" placeholder="Email" required>
                  <div class="invalid-feedback">Please enter a valid email address.</div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputPhone" name="phone" placeholder="Phone number" required>
                  <div class="invalid-feedback">Phone number should only contain numbers.</div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="inputAddress" name="address" placeholder="Address">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="inputPassword" name="password" placeholder="Password" required>
                  <div class="invalid-feedback">Password must contain at least one number, one uppercase letter, and one symbol.</div>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" style="background-color: #4695CC !important;" class="form-check-input" required>
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button type="submit" style="background-color: #4695CC !important;" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</button>
                </div>
                <div class="text-center  mt-4 font-weight-light" >
                  Already have an account? <a href="login.php" style="color: #4695CC !important;" class="text-primary">Login</a>
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
  <script src="admin/js/controle_de_saisie.js"></script>

</body>

</html>