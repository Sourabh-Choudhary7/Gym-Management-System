<?php
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {


    $sql = "SELECT * FROM membership_packages ORDER BY id ASC";
    $res = mysqli_query($conn, $sql);
}else{
	header("Location: login.php");
}
?>