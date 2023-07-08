<?php
//This script will handle login
session_start();

// check if the user is already logged in
if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role'])) {
  header("location: welcome.php");
  exit;
}
include "config.php";

$username = $password = "";
$err = "";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (empty(trim($_POST['username']))) {
    header("Location: ./login.php?error=Username is Required");
  }
  if (empty(trim($_POST['password']))) {
    header("Location: ./login.php?error=Password is Required");
  } else {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
  }


  if (empty($err)) {
    $sql = "SELECT id, username, password , role FROM user_registration WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    $param_username = $username;


    // Try to execute this statement
    if (mysqli_stmt_execute($stmt)) {
      mysqli_stmt_store_result($stmt);
      if (mysqli_stmt_num_rows($stmt) == 1) {
        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
        if (mysqli_stmt_fetch($stmt)) {
          if (password_verify($password, $hashed_password)) {
            // this means the password is correct. Allow user to login

            $_SESSION["username"] = $username;
            $_SESSION["id"] = $id;
            $_SESSION["role"] = $role;
            $_SESSION["loggedin"] = true;
            header("location: welcome.php");
            if ($role === 'admin') {
              header("Location: login.php?error=Invalid Credentials");
            }
            //Redirect user to welcome page
          } else {
            header("Location: login.php?error=Incorect User name or password");
          }
        } else {
          header("Location: login.php?error=Incorect User name or password");
        }

      }

    }
  }


}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <title>Login | Dream Fitness Gym</title>
  <link rel="icon" type="image/x-icon" href="./image/barbell.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/5d5e293a3e.js" crossorigin="anonymous"></script>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    body {
      background-color: black;
      color: white;
      background-image: url(./image/loginPageImage.jpg);
      width: 100vw;
      height: 100vh;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    li {
      list-style: none;
    }

    .navbar-brand {
      color: orangered;
    }

    .navbar-brand:hover {
      color: orangered;
      cursor: default;
    }

    i {
      color: white;
    }

    .formBox {
      background: #eee;
      box-shadow: 0 8px 8px -4px lightblue;
    }

    .Button-container {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
  </style>
</head>

<body class="p-0 m-0 border-0 bd-example">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark ">
    <div class="container-fluid">
      <div>
        <a class="navbar-brand p-md-3"><i class="fa-solid fa-dumbbell"></i><strong> Dream Fitness
            Gym</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
          aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <ul>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle profile" href="#" role="button" data-bs-toggle="dropdown"
            aria-expanded="false"><strong>

              Sign-in
            </strong> </a>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="login.php">Login</a></li>
            <li><a class="dropdown-item" href="register.php">Register</a></li>


          </ul>

      </ul>

    </div>
  </nav>

  <!-- Multi User login system page -->

  <div class="d-flex">
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
      <form class="border shadow p-3 bg-transparent rounded formBox" action="" method="post" style="width: 450px;">
        <h1 class="text-center p-3">User Login</h1>
        <?php if (isset($_GET['error'])) { ?>
          <div id="error-alert" class="alert alert-danger" role="alert">
            <?= $_GET['error'] ?>
          </div>
        <?php } ?>

        <div class="mb-3">
          <label for="username" class="form-label"><strong>Username :</strong></label>
          <input type="text" class="form-control" placeholder="Enter Name Which You Register" name="username"
            id="username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><strong>Password :</strong></label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
        </div>
        <div class="Button-container">

          <button type="submit" class="btn btn-primary">LOGIN</button>
          <button type="link" class="btn btn-primary"><a class="nav-link" aria-current="page"
              href="register.php">Register New User</a></button>
        </div>

      </form>
    </div>

    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh">
      <form class="border shadow p-3 bg-transparent rounded formBox" action="checkAdminLogin.php" method="post"
        style="width: 450px;">
        <h1 class="text-center p-3">Admin Login</h1>
        <?php if (isset($_GET['adminErr'])) { ?>
          <div id="error-alert" class="alert alert-danger" role="alert">
            <?= $_GET['adminErr'] ?>
          </div>
        <?php } ?>
        <div class="mb-3">
          <label for="username" class="form-label"><strong>Admin Username :</strong></label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Enter Admin Username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label"><strong>Password :</strong></label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
        </div>

        <button type="submit" class="btn btn-primary">LOGIN</button>
      </form>
    </div>

  </div>

  <script>
    // To hide the error message
    setTimeout(function () {
      var errorAlert = document.getElementById('error-alert');
      if (errorAlert) {
        errorAlert.style.display = 'none';
      }
    }, 5000);
  </script>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>