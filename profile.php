
<?php 
    require_once("config.php");
    session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}
  $username=$_SESSION["username"];
  $findresult = mysqli_query($conn, "SELECT * FROM user_registration WHERE username= '$username'");
if($res = mysqli_fetch_array($findresult))
{
$username = $res['username']; 
$email = $res['email'];  
$phone = $res['phone'];   
$gender = $res['gender'];  
$image= $res['image'];
}
 ?> 

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>Your Profile</title>
    <link rel="icon" type="image/x-icon" href="./image/barbell.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
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

  
<!-- User Profile -->
   
 
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            
        </div>
        <div class="col-sm-6">
  <div class="login_form">
    <br> 
     
          <div class="row">
            <div class="col"></div>
           <div class="col-6"> 
             <?php if(isset($_GET['profile_updated'])) 
      { ?>
    <div class="success-msg" style="color:#33CC00;">Profile saved ..</div>
      <?php } ?>
        <?php if(isset($_GET['password_updated'])) 
      { ?>
    <div class="successmsg" style="color:#33CC00;">Password has been changed...</div>
      <?php } ?>
            <center>
            <?php if($image==NULL)
                {
                 echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                } else { echo '<img src="userProfileImages/'.$image.'" style="height:80px;width:auto;border-radius:50%;">';}?> 
<p>Welcome!</p>
  <p><span style="color:#33CC00"><?php echo $username; ?></span> </p>
  </center>
           </div>
            <div class="col"><p><a href="logout.php"><span style="color:red;">Logout</span> </a></p>
         </div>
          </div>

          <table class="table" style="color: white;">
          <tr>
              <th>Username </th>
              <td><?php echo $username; ?></td>
          </tr>
          <tr>
              <th>Email </th>
              <td><?php echo $email; ?></td>
          </tr>
          <tr>
              <th>Phone </th>
              <td><?php echo $phone; ?></td>
          </tr>
           <tr>
              <th>Gender </th>
              <td><?php echo $gender; ?></td>
          </tr>
          </table>
           <div class="row">
            <div class="col-sm-2">
            </div>
             <div class="col-sm-4">
                <a href="edit-profie.php"><button type="button" class="btn btn-primary">Edit Profile</button></a>
            </div>
            <div class="col-sm-6">
         <a href="change-password.php"><button type="button" class="btn btn-warning">Change Password</button></a>
            </div>
           </div>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div> 
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>