<?php include 'includes/session.php'; ?>
<?php
if (isset($_SESSION['user'])) {
  header('location: cart_view.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block">
                  <img src="https://source.unsplash.com/480x600/?computer,register">
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
                     <!-- Form Username Input Section -->
   <?php
      if (isset($_SESSION['error'])) {
        echo "
          <div class='callout callout-danger text-center'>
            <p style='color:red;text-align:center'>" . $_SESSION['error'] . "</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
      if (isset($_SESSION['success'])) {
        echo "
          <div class='callout callout-success text-center'>
            <p style='color:red;text-align:center'>" . $_SESSION['success'] . "</p> 
          </div>
        ";
        unset($_SESSION['success']);
      }
      ?>
              <form class="user" action="register.php" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" name="firstname" id="exampleFirstName" placeholder="First Name" value="<?php echo (isset($_SESSION['firstname'])) ? $_SESSION['firstname'] : '' ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" name="lastname" id="exampleLastName" placeholder="Last Name" value="<?php echo (isset($_SESSION['lastname'])) ? $_SESSION['lastname'] : '' ?>">

                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email Address" onblur="userAvailability()" value="<?php echo (isset($_SESSION['email'])) ? $_SESSION['email'] : '' ?>">
                  <span id="user-availability-status1" style="font-size:12px;"></span>

                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" value="<?php echo (isset($_SESSION['password'])) ? $_SESSION['password'] : '' ?>">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" name="c-password" id="exampleRepeatPassword" placeholder="Repeat Password" value="<?php echo (isset($_SESSION['c-password'])) ? $_SESSION['c-password'] : '' ?>">
                  </div>
                </div>
                <button type="submit" name="signup" class="btn btn-primary btn-user btn-block">
                  Register Account
                </button>
                <hr>
                <a href="index.html" class="btn btn-google btn-user btn-block">
                  <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                  <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.php">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="admin/vendor/jquery/jquery.min.js"></script>
  <script src="admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin/js/sb-admin-2.min.js"></script>

</body>

</html>

<?php include 'includes/scripts.php' ?>


  <script>
    function userAvailability() {
      jQuery.ajax({
        url: "check_availability.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success: function(data) {
          $("#user-availability-status1").html(data);
        },
        error: function() {}
      });
    }
  </script>

<!--  <script>-->
<!--    function myFunction(x) {-->
<!--      x.classList.toggle("fa-eye-slash");-->
<!--    }-->
<!--  </script>-->
<!--  <script>-->
<!--    $("#showPassword").click(function() {-->
<!--      var foo = $(this).prev().attr("type");-->
<!--      if (foo == "password") {-->
<!--        $(this).prev().attr("type", "text");-->
<!--      } else {-->
<!--        $(this).prev().attr("type", "password");-->
<!--      }-->
<!--    });-->

<!--    $("#showPassword1").click(function() {-->
<!--      var foo = $(this).prev().attr("type");-->
<!--      if (foo == "password") {-->
<!--        $(this).prev().attr("type", "text");-->
<!--      } else {-->
<!--        $(this).prev().attr("type", "password");-->
<!--      }-->
<!--    });-->
<!--  </script>-->
<!--</body>-->

<!--</html>-->