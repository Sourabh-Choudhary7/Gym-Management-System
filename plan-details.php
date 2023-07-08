<?php
session_start();
include "config.php";
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
$username = $_SESSION["username"];
$findresult = mysqli_query($conn, "SELECT * FROM user_registration WHERE username= '$username'");
if ($res = mysqli_fetch_array($findresult)) {
    $username = $res['username'];
    $email = $res['email'];
    $phone = $res['phone'];
    $gender = $res['gender'];
    $image = $res['image'];
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">

    <title>Active Plans</title>
    <link rel="icon" type="image/x-icon" href="./image/barbell.png">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style.css">
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


    <h2 align="center">
        <strong>Your Active Membership Plan...</strong>
    </h2>
    <h2 align="center">

    </h2>
    <div class="container mt-4" align="center">

        <h5 align="center">
            <?php echo "Welcome! " . $_SESSION['username'] ?>
        </h5>
        <div class="p-3">
            <?php include './membership.php';
            if (mysqli_num_rows($res) > 0) { ?>

                <table class="table" style="color:white; width: 40rem;">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Plans</th>
                            <th scope="col">Description</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($rows = mysqli_fetch_assoc($res)) { ?>
                            <tr>
                                <th scope="row">
                                    <?= $i ?>
                                </th>
                                <td>
                                    <?= $rows['membership_package'] ?>
                                </td>
                                <td>
                                    <?= $rows['description'] ?>
                                </td>
                                <td>Rs
                                    <?= $rows['amount'] ?>
                                </td>
                                <td style="color: rgb(60, 235, 7);">
                                    <?= $rows['status'] ?>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>



        <!-- Step 2: Create a membership form -->
        <form method="POST" action="" style="color:white;">


            <span for="name"><strong>Username:</strong></span>
            <span>
                <?php echo $_SESSION['username'] ?>
            </span>
            <br>
            <span for="email"><strong>Email:</strong></span>
            <span>
                <?php echo $email ?>
            </span>
            <br>
            <span for="membership_plan">Membership Plan:</span>
            <select id="membership_plan" name="membership_plan" style="padding:8px 5px;">
                <option value="active">Simple package</option>
                <option value="active">Intermediate package</option>
                <option value="active">Advance package</option>
            </select>
            <!-- Other form fields as needed -->

            <!-- Step 6: Handle the payment response -->
            <!-- Integrate with a payment gateway SDK and include necessary fields -->


            <button type="submit" name="submit" class="btn btn-danger"
                value="<?php echo "successfull baught!!!" ?>">Buy</button>

        </form>

    </div>
    <div>

    </div>
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