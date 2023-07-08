<?php
require_once "config.php";

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}

$name = "";
$name_err = "";
if (isset($_POST['name']) && isset($_POST['email']) &&
        isset($_POST['phone']) && isset($_POST['subject']) &&
        isset($_POST['message']))
        {
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if ($_SERVER['REQUEST_METHOD'] == "POST"){

  // Check if name is empty
  if(empty(trim($_POST["name"]))){
      $name_err = "name cannot be blank";
  }
  else{
      $sql = "SELECT id FROM send_us_msg WHERE name = ?";
      $stmt = mysqli_prepare($conn, $sql);
      if($stmt)
      {
          mysqli_stmt_bind_param($stmt, "s", $param_name);

          // Set the value of param name
          $param_name = trim($_POST['name']);

          // Try to execute this statement
          if(mysqli_stmt_execute($stmt)){
              mysqli_stmt_store_result($stmt);
              if(mysqli_stmt_num_rows($stmt) == 1)
              {
                  $name_err = "This name is already taken";
                  echo "<script type='text/javascript'>alert('$name_err');</script>"; 
              }
              else{
                  $name = trim($_POST['name']);
              }
          }
          else{
              echo "Something went wrong";
          }
      }
  }

  mysqli_stmt_close($stmt);




// If there were no errors, go ahead and insert into the database
if(empty($name_err) )
{
  $sql = "INSERT INTO send_us_msg (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  if ($stmt)
  {
      mysqli_stmt_bind_param($stmt, "sssss", $param_name, $email, $phone, $subject, $message);

      // Set these parameters
      $param_name = $name;
      
      // Try to execute the query
      if (mysqli_stmt_execute($stmt))
      {
        echo "<script type='text/javascript'>alert('Message is sent');</script>";
          
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
  <title>Contact us</title>
  <link rel="icon" type="image/x-icon" href="./image/barbell.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script> -->
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/5d5e293a3e.js" crossorigin="anonymous"></script>

</head>

<body class="p-0 m-0 border-0 bd-example">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <div>
                <a class="navbar-brand p-md-3" href="#"><i class="fa-solid fa-dumbbell"></i><strong> Dream Fitness
                        Gym</strong></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="welcome.php"><strong>Home</strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php"><strong>About</strong></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle features" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <strong>Features</strong>
                        </a>
                        <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="plan-details.php">Membership</a></li>
                <li><a class="dropdown-item" href="CheckBMI.php">Check your BMI</a></li>

              </ul>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="Contact_us.php"><strong>Contact us</strong></a>
                    </li>
            </div>

            <ul>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle profile" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false"><strong>
                            <i class="fa-solid fa-user"></i>
                            <?php echo " " . $_SESSION['username'] ?>
                        </strong> </a>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>


                    </ul>

            </ul>

        </div>
    </nav>
    <div class="container">
    <h1>Contact Us</h1>
    <p>Feel free to reach out to us with any questions or inquiries.</p>

    <div class="row">
      <div class="col-md-6">
        <h2>Contact Information</h2>
        <p><strong>Phone:</strong> 123-456-7890</p>
        <p><strong>Email:</strong> info@dreamfitness.com</p>
        <p><strong>Address:</strong> 123 Fitness Street, West Bengal, India</p>
      </div>

      <div class="col-md-6">
        <h2>Send us a Message</h2>
        <form action="Contact_us.php" method="POST">
          <div class="form-group">
            <span for="name" style="color:white;">Name:</span>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>

          <div class="form-group mt-2">
            <span for="email" style="color:white;">Email:</span>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>

          <div class="form-group mt-2">
            <span for="phone" style="color:white;">Phone:</span>
            <input type="tel" class="form-control" id="phone" name="phone">
          </div>

          <div class="form-group mt-2">
            <span for="subject" style="color:white;">Subject:</span>
            <select class="form-control" id="subject" name="subject" required>
              <option value="">Select One</option>
              <option value="membership">Membership</option>
              <option value="exercise">Exercises</option>
              <option value="feedback">Feedback</option>
              <option value="other">Other</option>
            </select>
          </div>

          <div class="form-group mt-2 mb-2">
            <span for="message" style="color:white;">Message:</span>
            <textarea class="form-control" id="message" name="message" required></textarea>
          </div>

          <button type="submit" class="btn btn-primary mt-2">Submit</button>
        </form>
      </div>
    </div>
  </div>

  <footer class="bg-dark text-center mt-4 mb-6">
    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link" href="welcome.php#faq">FAQ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="terms.html">Terms of Service</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="privacy.html">Privacy Policy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.facebook.com/gymmanagement" target="_blank"><i class="fa-brands fa-facebook"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.instagram.com/gymmanagement" target="_blank"><i class="fa-brands fa-instagram"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://www.twitter.com/gymmanagement" target="_blank"><i class="fa-brands fa-twitter"></i></a>
      </li>
    </ul>
    <p>&copy; 2023 Dream Fitness Gym. All rights reserved.</p>
  </footer>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
