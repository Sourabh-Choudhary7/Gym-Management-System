<?php require_once("config.php");
require_once("config.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
header("location: login.php");
}
  $username=$_SESSION["username"];

 ?> 
 <!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>Edit Your Profile</title>
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

    <!-- chnage password -->
<div class="container">
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-6">
           
     <form action="" method="POST">
  <div class="login_form">
<br> <?php 
 if(isset($_POST['change_password'])){
 $currentPassword=$_POST['currentPassword']; 
  $password=$_POST['password'];  
 $passwordConfirm=$_POST['passwordConfirm']; 
$sql="SELECT password from user_registration where username='$username'";
$res = mysqli_query($conn,$sql);
      $res=mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($res);
       if(password_verify($currentPassword,$row['password'])){
if($passwordConfirm ==''){
            $error[] = 'Please confirm the password.';
        }
        if($password != $passwordConfirm){
            $error[] = 'Passwords do not match.';
        }
          if(strlen($password)<5){ // min 
            $error[] = 'The password is 6 characters long.';
        }
        
         if(strlen($password)>20){ // Max 
            $error[] = 'Password: Max length 20 Characters Not allowed';
        }
if(!isset($error))
{
      $options = array("cost"=>4);
    $password = password_hash($password,PASSWORD_BCRYPT,$options);

     $result = mysqli_query($conn,"UPDATE user_registration SET password='$password' WHERE username='$username'");
           if($result)
           {
       header("location:profile.php?password_updated=1");
           }
           else 
           {
            $error[]='Something went wrong';
           }
}

        } 
        else 
        {
            $error[]='Current password does not match.'; 
        }   
    }
        if(isset($error)){ 

foreach($error as $error){ 
  echo '<p class="errmsg">'.$error.'</p>'; 
}
}
        ?> 
     <form method="post" enctype='multipart/form-data' action="">
         <h3 style="text-align: center;"> Change Your Password</h3>

          <div class="form-group mb-4">
          <div class="row"> 
             <div class="col" style="color: white;">
                <span>Current Password:- </span>
                <input type="password" name="currentPassword" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row mb-4"> 
             <div class="col" style="color: white;">
                 <span>New Password:- </span>
                <input type="password" name="password"  class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group mb-4">
 <div class="row">  
             <div class="col" style="color: white;">
                 <span>Confirm New Password:-</span>
                <input type="password" name="passwordConfirm"  class="form-control">
            </div>
          </div>
      </div>
           <div class="row">
            <div class="col-sm-10">
            </div>
            <div class="col-sm-10">
<button  class="btn btn-success" name="change_password">Change Password</button>
            </div>
           </div>
       </form>
        </div>
        <div class="col-sm-3">
        </div>
    </div>
</div> 
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
</html>