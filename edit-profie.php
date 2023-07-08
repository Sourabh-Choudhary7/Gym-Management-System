
<!-- this page will edit or update the user information -->

<?php
require_once("config.php");
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}
$username = $_SESSION["username"];
$findresult = mysqli_query($conn, "SELECT * FROM user_registration WHERE username= '$username'");
if ($res = mysqli_fetch_array($findresult)) {
    $username = $res['username'];
    $oldusername = $res['username'];
    $email = $res['email'];
    $phone = $res['phone'];
    $gender = $res['gender'];
    $image = $res['image'];
}
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

    <div class="container">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">

                <form action="" method="POST" enctype='multipart/form-data'>
                    <div class="login_form">
                        <br>
                        <?php

                        if (isset($_POST['update_profile'])) {
                           
                            $email = $_POST['email'];
                            $phone = $_POST['phone'];
                            $folder = 'userProfileImages/';
                            $file = $_FILES['image']['tmp_name'];
                            $file_name = $_FILES['image']['name'];
                            $file_name_array = explode(".", $file_name);
                            $extension = end($file_name_array);
                            $new_image_name = 'profile_' . rand() . '.' . $extension;
                            if ($_FILES["image"]["size"] > 1000000) {
                                $error[] = 'Sorry, your image is too large. Upload less than 1 MB in size .';

                            }
                            if ($file != "") {
                                if (
                                    $extension != "jpg" && $extension != "png" && $extension != "jpeg"
                                    && $extension != "gif" && $extension != "PNG" && $extension != "JPG" && $extension != "GIF" && $extension != "JPEG"
                                ) {

                                    $error[] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed';
                                }
                            }

                            $sql = "SELECT * from user_registration where username='$username'";
                            $res = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($res) > 0) {
                                $row = mysqli_fetch_assoc($res);

                                if ($oldusername != $username) {
                                    if ($username == $row['username']) {
                                        $error[] = 'Username alredy Exists. Create Unique username';
                                    }
                                }
                            }
                            if (!isset($error)) {
                                if ($file != "") {
                                    $stmt = mysqli_query($conn, "SELECT image FROM  user_registration WHERE username='$username'");
                                    $row = mysqli_fetch_array($stmt);
                                    $deleteimage = $row['image'];
                                    unlink($folder . $deleteimage);
                                    move_uploaded_file($file, $folder . $new_image_name);
                                    mysqli_query($conn, "UPDATE user_registration SET image='$new_image_name' WHERE username='$username'");
                                }
                                $result = mysqli_query($conn, "UPDATE user_registration SET username='$username',email='$email',phone='$phone' WHERE username='$username'");
                                if ($result) {
                                    header("location:profile.php?profile_updated=1");
                                } else {
                                    $error[] = 'Something went wrong';
                                }

                            }


                        }
                        if (isset($error)) {

                            foreach ($error as $error) {
                                echo '<p class="errmsg">' . $error . '</p>';
                            }
                        }


                        ?>
                        <form method="post" enctype='multipart/form-data' action="">
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-6">
                                    <center>
                                        <?php if ($image == NULL) {
                                            echo '<img src="https://technosmarter.com/assets/icon/user.png">';
                                        } else {
                                            echo '<img src="userProfileImages/' . $image . '" style="height:80px;width:auto;border-radius:50%;">';
                                        } ?>
                                        <div class="form-group">
                                            <span style="color:white">Change Image &#8595;</span>
                                            <input class="form-control" type="file" name="image" style="width:100%;">
                                        </div>

                                    </center>
                                </div>
                                <div class="col">
                                    <p><a href="logout.php"><span style="color:red;">Logout</span> </a></p>
                                </div>
                            </div>
                                        <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <span style="color:white;"><strong>Username</strong></span>
                                    </div>
                                    <div class="col">
                                        <span style="color:yellow;"><?php echo $username; ?></span>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <span style="color:white;"><strong>Email</strong></span>
                                    </div>
                                    <div class="col">
                                        <input type="email" name="email" value="<?php echo $email; ?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-3">
                                        <span style="color:white;"><strong>Phone</strong></span>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="phone" value="<?php echo $phone; ?>"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-4">
                                </div>
                                <div class="col-sm-4">
                                    <button class="btn btn-success" name="update_profile">Save Profile</button>
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