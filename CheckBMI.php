<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

  <title>Check Your BMI</title>
  <link rel="icon" type="image/x-icon" href="./image/barbell.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./BMIStyle.css">
  <script src="https://kit.fontawesome.com/5d5e293a3e.js" crossorigin="anonymous"></script>
  <style>
    
  </style>
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
    <div class="container mt-4">

<h2 align="center"><?php echo "Welcome " . $_SESSION['username'] ?></h2>

</div>
  
  <h3 align="center" style="color: white;">
    <strong>Check Your Body Mass Index</strong>
  </h3>
  <!-- BMI calculator -->
  <div class="container">
  <div class="box">
    <h1>BMI Calculator</h1>
    <div class="content">
      <div class="input">
        <label for="height">Height(cm)</label>
        <input type="number" id="height">
      </div>
      <div class="input">
        <label for="weight">Weight(kg)</label>
        <input type="number" id="weight">
      </div>
      <button id="calculate">Calculate BMI</button>
    </div>
    <div class="result">
      <p>Your BMI is</p>
      <div id="result">00.00</div>
      <p class="comment"></p>
    </div>
  </div>
</div>
<section class="BMIimage">
  <img src="./image/BMI.jpg" alt="bmi">
</section>
<script>
  const btn = document.getElementById("calculate");

btn.addEventListener("click", function () {
  let height = document.querySelector("#height").value;
  let weight = document.querySelector("#weight").value;

  if (height == "" || weight == "") {
    alert("Please fill out the input fields!");
    return;
  }

  // BMI = weight in KG / (height in m * height in m)

  height = height / 100;

  let BMI = weight / (height * height);

  BMI = BMI.toFixed(2);

  document.querySelector("#result").innerHTML = BMI;

  let status = "";

  if (BMI < 18.5) {
    status = "Underweight";
  }
  if (BMI >= 18.5 && BMI < 25) {
    status = "Healthy";
  }
  if (BMI >= 25 && BMI < 30) {
    status = "Overweight";
  }
  if (BMI >= 30 && BMI <= 34.9) {
    status = "Obese";
  }
  if (BMI >= 35) {
    status = "Extreamely Obese";
  }
  document.querySelector(
    ".comment"
  ).innerHTML = `Comment: you are <span id="comment">${status}</span>`;
});

</script>

 

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>