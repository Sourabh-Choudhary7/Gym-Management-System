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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
  <title>Welcome to our fitness zone</title>
  <link rel="icon" type="image/x-icon" href="./image/barbell.png">
  <link rel="stylesheet" href="./style.css">
  <script src="https://kit.fontawesome.com/5d5e293a3e.js" crossorigin="anonymous"></script>
</head>

<body class="p-0 m-0 border-0 bd-example">

  <header class="gymIntro">
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
    <!-- main section-->
    <section class="gymLine">
      <div class="lines">
        <h2>WHEN LIFE GIVES</h2>
        <h3>YOU PAIN, </h3>
        <h1>GO TO</h1>
        <h1>THE GYM.</h1>
      </div>
    </section>


  </header>
  <hr>

  <!-- Gym Info section -->
  <section class="gymInfo">
    <div class="motivationalLine">
      <h2>THE PAIN</h2>
      <h3>YOU FEEL TODAY,</h3>
      <h1>WILL BE</h1>
      <h1>THE STRENGTH</h1>
      <H2>TOU FEEL</H2>
      <H1>TOMORROW.</H1>
      <button class="btn">Check Me Out</button>
    </div>

  </section>

  <hr>

  <section class="gymVideo1">


    <div class="heading-and-paragraph">
      <h1>Achieve Your Goals</h1>
      <p>“The body achieves what <br> the mind believes.”</p>
    </div>
    <div class="image-video-viewing-content">

      <video src="./image/girlsAnimatedGym.mp4" class="girlsAnimatedGym" controls muted height="500px"
        width="500px"></video>

    </div>
  </section>
  <hr>
  <section class="gymVideo1">
    <div class="image-video-viewing-content">

      <video src="./image/trainersSupport.mp4" class="girlsAnimatedGym" controls muted height="500px"
        width="500px"></video>

    </div>

    <div class="heading-and-paragraph" id="trainer">
      <h1>Trainers Support</h1>
      <p>Having a personal trainer to guide you <br> through the correct positioning <br> and form is invaluable. <br>
        They can help ensure that you're performing <br> the exercise most effectively for your body.<br></p>
    </div>

  </section>
  <hr>

  <section class="gymVideo1">


    <div class="heading-and-paragraph">
      <h1>Train Your Legs</h1>
      <p>“The hard days are the best <br> because that's when champions are made, <br> so if you push through, you can
        <br> push through anything.”
      </p>
      <a href="CheckBMI.php"><button class="btn" >Check Your BMI</button></a>
    </div>
    <div class="image-video-viewing-content">

      <video src="./image/pexels-tima-miroshnichenko-5319759 (2160p).mp4" class="girlsAnimatedGym" controls muted
        height="500px" width="500px"></video>

    </div>
  </section>
  <hr>
  <section class="gymVideo1">
    <div class="image-video-viewing-content">

      <video src="./image/pexels-taryn-elliott-7580364 (2160p).mp4" class="girlsAnimatedGym" controls muted
        height="500px" width="500px"></video>

    </div>
    <div class="heading-and-paragraph">
      <h1>Drink More Water</h1>
      <p> Drinking water during exercise will help <br> fuel your muscles and boost <br> energy levels so you don't
        <br>feel tired as quickly, it will <br> replenish the fluid you <br> use to sweat which helps to control <br>
        your body temperature.
      </p>
    </div>
  </section>
  <hr>

  <!-- Frequently Ask question  Section of Netflix-->
  <section class="Frequently-ask-Question" id="faq">
    <div class="heading-question">
      <h1>Frequently Asked Questions</h1>
    </div>
    <ul class="accordion">
      <li>
        <input type="checkbox" name="accordion" id="first">
        <label for="first">What are the operating hours of the gym?</label>
        <div class="content">
          <p>
            Typically, gyms have both weekday and weekend hours, and they may have different hours for different days of
            the week. Basically open in Morning at 6 AM closes at Night 10 PM.
          </p>
        </div>
      </li>
      <li>
        <input type="checkbox" name="accordion" id="second">
        <label for="second">What facilities and equipment do you have at the gym?</label>
        <div class="content">
          <p>
            At our gym, we offer a wide range of facilities and equipment to support your fitness journey. Here are some
            of the key amenities you can expect to find:

            Cardiovascular Machines: We have a variety of cardio equipment such as treadmills, stationary bikes,
            elliptical trainers, and rowing machines. These machines help improve cardiovascular endurance and burn
            calories.

            Strength Training Equipment: Our gym is equipped with a diverse selection of strength training equipment,
            including free weights (dumbbells, barbells), weight machines, and functional training equipment like
            kettlebells and resistance bands.

            Group Fitness Studios: We have dedicated studios where we conduct a variety of group fitness classes. These
            may include options like Zumba, yoga, spinning, HIIT (High-Intensity Interval Training), and more. Our
            certified instructors will guide and motivate you through these classes.



          </p>
        </div>
      </li>
      <li>
        <input type="checkbox" name="accordion" id="third">
        <label for="third">Is there a minimum age requirement to join the gym?</label>
        <div class="content">
          <p>
            Yes, there is typically a minimum age requirement to join our gym. The specific age requirement may vary
            depending on the policies and regulations of the gym. However, as a general guideline, our gym typically
            requires members to be at least 16 years old to join independently.
          </p>
        </div>
      </li>
      <li>
        <input type="checkbox" name="accordion" id="forth">
        <label for="forth">Are there locker rooms and shower facilities available?</label>
        <div class="content">
          <p>
            Our gym provides separate locker rooms for both males and females. You can safely store your belongings in
            the lockers and freshen up after your workout using our clean and convenient shower facilities.
          </p>
        </div>
      </li>
      <li>
        <input type="checkbox" name="accordion" id="fifth">
        <label for="fifth">Is there parking available at the gym?</label>
        <div class="content">
          <p>
            Yes, we provide parking facilities for our gym members. We understand the importance of convenience and
            accessibility when it comes to reaching the gym. Our parking area is designed to accommodate a sufficient
            number of vehicles to ensure that members have a place to park while they attend their workouts.
          </p>
        </div>
      </li>
      <li>
        <input type="checkbox" name="accordion" id="sixth">
        <label for="sixth">IS Gym importants in our Life?</label>
        <div class="content">
          <p>

            Gyms play a significant role in improving and maintaining our overall health and well-being.
          </p>
        </div>
      </li>
    </ul>

    <h5>Ready to begin? Enter your email to create or restart your membership.
    </h5>
    <div class="email-submit-section">
      <input type="email" placeholder="Email address" required>
      <button type="submit">Get Started ></button>
    </div>

    </div>
  </section>
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

    <!-- Footer section of netflix  -->

    <section class="footer">
        <h2>Questions? Call 123-456-7890</h2>
        <div class="row">
          <div class="col">
            <a href="#faq">FAQ</a>
            <a href="#">Investor Relations</a>
            <a href="about.php">Privacy</a>
            <a href="#">Speed Test</a>
          </div>
          <div class="col">
            <a href="Contact_us.php">Help Center</a>
            <a href="#">Cookies Prefences</a>
            <a href="#">Legal Notices</a>
          </div>
          <div class="col">
            <a href="profile.php">Account</a>
            <a href="#">Ways to Begin</a>
            <a href="CheckBMI.php">BMI</a>
            <a href="#trainer">Only on fitness</a>
          </div>
          <div class="col">
            <a href="plan-details.php">Membership</a>
            <a href="about.php">Terms of Use</a>
            <a href="Contact_us.php">Contact Us</a>
          </div>
        </div>
        <div class="left-footer-button">
        <select>
            <option>English</option>
            <option>हिन्दी</option>
        </select>
    </div>
        <p class="right-txt">&copy; Dream Fitness Gym India</p>
    
    </section>

</html>