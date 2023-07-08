<?php
require_once "config.php";

$username = $password = $confirm_password = "";
$username_err = $password_err = $confirm_password_err = "";
if (isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['email']) && isset($_POST['gender']) &&
        isset($_POST['phone']) && isset($_POST['role']))
        {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
       

if ($_SERVER['REQUEST_METHOD'] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM user_registration WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already taken";
                    echo "<script type='text/javascript'>alert('$username_err');</script>"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
        }
    }

    mysqli_stmt_close($stmt);


// Check for password
if(empty(trim($_POST['password']))){
    $password_err = "Password cannot be blank";
    echo "<script type='text/javascript'>alert('$password_err');</script>";
}
elseif(strlen(trim($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
    echo "<script type='text/javascript'>alert('$password_err');</script>";
}
else{
    $password = trim($_POST['password']);
}

// Check for confirm password field
if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
    $password_err = "Passwords should not match";
    echo "<script type='text/javascript'>alert('$password_err');</script>";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
{
    $sql = "INSERT INTO user_registration (username, password, email, gender, phone, role) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $password, $email, $gender, $phone, $role);

        // Set these parameters
        $param_username = $username;
        $password = password_hash($password, PASSWORD_DEFAULT); //if we want hashed password

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
          echo "<script type='text/javascript'>alert('Your account has been created');</script>";
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
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
    <title>New Registration</title>
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
      background-image: url(./image/registerImage.jpg);
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

<div class="container mt-4">
<h3><strong>Register New User</strong></h3>
<hr>
<form action="register.php" method="post">
  <div class="form-row">
  <div class="mb-1">
		    <label class="form-label">Select User Type:</label>
		  </div>
		  <select class="form-select mb-3"
		          name="role" 
		          aria-label="Default select example">
			  <option selected value="user">User</option>
			  <option value="admin">Admin</option>
		  </select>
    <div class="form-group col-md-6">
      <label for="inputName"><strong>Username</strong></label>
      <input type="text" class="form-control" name="username" id="inputName" placeholder="Name">
    </div>
    <div class="form-group col-md-6 mb-2">
      <label for="inputPassword"><strong>Password</strong></label>
      <input type="password" class="form-control" name ="password" id="inputPassword" placeholder="Password">
    </div>
  </div>
  <div class="form-group mb-2">
      <label for="inputPassword"><strong>Confirm Password</strong></label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password">
    </div>
  <div class="form-group mb-2">
    <label for="inputEmail"><strong>Email-ID</strong></label>
    <input type="text" class="form-control" name="email" id="inputEmail" placeholder="example123@gmail.com">
  </div>

  <div class="form-row mb-2">
    <div class="form-group col-md-6">
      <label for="inputGender"><strong>Gender: </strong></label>
      <input type="Radio" name="gender" id="inputGender" value="Male" required> Male
      <input type="Radio" name="gender" id="inputGender" value="Female" required> Female
    </div>
    </div>

  <div class="form-group col-md-2 mb-2">
      <label for="inputPhone"><strong>Phone number</strong></label>
      <input type="text" class="form-control"  name="phone" id="inputPhone" placeholder="Enter your mobile number">
    </div>
        
    
    
 
  
  <button type="submit" class="btn btn-primary">Sign in</button><br> <Strong>Already have an Account ? </Strong><button type="link" class="btn btn-primary"><a class="nav-link" aria-current="page" href="login.php">Login here</a></button>
  </div>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>