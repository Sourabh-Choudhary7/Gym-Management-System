<?php

session_start();
include "config.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header("location: login.php");
  exit;
}


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
  <title>Administrator | Dream Fitness Gym</title>
  <link rel="icon" type="image/x-icon" href="./image/barbell.png">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/5d5e293a3e.js" crossorigin="anonymous"></script>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    body {
      /* background-color: black;
      color: white;
      background-image: url(./image/loginPageImage.jpg);
      width: 100vw;
      height: 100vh;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center; */
      background-color: white;
    }

    li {
      list-style: none;
    }

    .navbar-brand {
      color: orangered;
    }
    .navbar {
      background-color: black;
      color: white;
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

              Administrator
            </strong> </a>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="change-password.php">Setting</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>


          </ul>

      </ul>

    </div>
  </nav>

  <div class="container d-flex justify-content-center align-items-center"
      style="min-height: 100vh">
      	<?php if ($_SESSION['role'] == 'admin') {?>
      		<!-- For Admin -->
      		<div class="card" style="width: 18rem;">
			  <img src="./image/admin-default.png" 
			       class="card-img-top" 
			       alt="admin image">
			  <div class="card-body text-center">
			    <h5 class="card-title">
			    	<?=$_SESSION['username']?>
			    </h5>
			    <a href="logout.php" class="btn btn-dark">Logout</a>
			  </div>
			</div>
			<div class="p-3">
				<?php include './userMembers.php';
                 if (mysqli_num_rows($res) > 0) {?>
                  
				<h1 class="display-4 fs-1">Members</h1>
				<table class="table" 
				       style="width: 32rem;">
				  <thead>
				    <tr>
				      <th scope="col">Id</th>
				      <th scope="col">User name</th>
				      <th scope="col">Role</th>
				      <th scope="col">Gender</th>
				      <th scope="col">Email</th>
				      <th scope="col">Phone</th>
				      <th scope="col">Joining Time</th>
				      
              
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$i =1;
				  	while ($rows = mysqli_fetch_assoc($res)) {?>
				    <tr>
				      <th scope="row"><?=$i?></th>
				      <td><?=$rows['username']?></td>
				      <td><?=$rows['role']?></td>
				      <td><?=$rows['gender']?></td>
				      <td><?=$rows['email']?></td>
				      <td><?=$rows['phone']?></td>
				      <td><?=$rows['register_time']?></td>
				    </tr>
				    <?php $i++; }?>
				  </tbody>
				</table>
				<?php }?>
			</div>
      	
      </div>
</body>
</html>
<?php } else{
	header("Location: login.php");
} ?>