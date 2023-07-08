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
    header("Location: ./login.php?adminErr=Username is Required");
  }
  if (empty(trim($_POST['password']))) {
    header("Location: ./login.php?adminErr=Password is Required");
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
           header("location: adminPage.php");
           if ($role === 'user') {
            header("Location: login.php?adminErr=Invalid Credentials");
          }


          } else {
            header("Location: login.php?adminErr=Incorect User name or password");
          }
        } else {
          header("Location: login.php?adminErr=Incorect User name or password");
        }

      }

    }
  }


}


?>