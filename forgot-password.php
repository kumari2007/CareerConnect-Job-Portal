<?php

session_start();

include 'config/db.php';

$message = "";

if(isset($_POST['send_otp'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $checkEmail = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($checkEmail) > 0){

        // Generate OTP
        $otp = rand(100000,999999);

        // Delete old OTP
        mysqli_query($conn,
        "DELETE FROM otp_verification
        WHERE email='$email'");

        // Insert new OTP
        mysqli_query($conn,
        "INSERT INTO otp_verification(email,otp)
        VALUES('$email','$otp')");

        // Save session
        $_SESSION['reset_email'] = $email;

        // Later we will send mail here

        header("Location: reset-password.php");

    }else{

        $message = "Email not found!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Forgot Password</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

<form class="auth-form" method="POST">

<h2>Forgot Password</h2>

<?php
if($message != ""){
    echo "<p class='message'>$message</p>";
}
?>

<div class="input-box">

<i class="fa-solid fa-envelope"></i>

<input type="email"
name="email"
placeholder="Enter Registered Email"
required>

</div>

<button type="submit"
name="send_otp"
class="auth-btn">

Send OTP

</button>

</form>

</div>

</body>
</html>