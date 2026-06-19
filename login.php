<?php

session_start();

include 'config/db.php';

$message = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $password = $_POST['password'];

    $checkUser = mysqli_query($conn,
        "SELECT * FROM users
        WHERE email='$email'
        AND role='jobseeker'");

    if(mysqli_num_rows($checkUser) > 0){

        $user = mysqli_fetch_assoc($checkUser);

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];

            $_SESSION['user_name'] = $user['fullname'];

            $_SESSION['user_email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");

        }else{

            $message = "Incorrect Password!";
        }

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

    <title>Login - CareerConnect</title>

    <link rel="stylesheet"
    href="assets/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

    <form class="auth-form" method="POST">

        <h2>User Login</h2>

        <?php
        if($message != ""){
            echo "<p class='message'>$message</p>";
        }
        ?>

        <div class="input-box">

            <i class="fa-solid fa-envelope"></i>

            <input type="email"
            name="email"
            placeholder="Email Address"
            required>

        </div>

        <div class="input-box">

            <i class="fa-solid fa-lock"></i>

            <input type="password"
            name="password"
            id="loginPassword"
            placeholder="Password"
            required>

            <span class="toggle-password"
            onclick="toggleLoginPassword()">

                <i class="fa-solid fa-eye"
                id="loginEyeIcon"></i>

            </span>

        </div>

        <button type="submit"
        name="login"
        class="auth-btn">

        Login

        </button>
        

        <p class="bottom-text">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </form>

</div>

<script>

function toggleLoginPassword(){

    const password =
    document.getElementById("loginPassword");

    const eyeIcon =
    document.getElementById("loginEyeIcon");

    if(password.type === "password"){

        password.type = "text";

        eyeIcon.className =
        "fa-solid fa-eye-slash";

    }
    else{

        password.type = "password";

        eyeIcon.className =
        "fa-solid fa-eye";
    }
}

</script>

</body>
</html>