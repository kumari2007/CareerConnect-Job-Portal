<?php

include 'config/db.php';

$message = "";

if(isset($_POST['register'])){

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Hash Password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check Existing Email
    $checkEmail = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($checkEmail) > 0){

        $message = "Email already exists!";

    }else{

        $insert = mysqli_query($conn,

        "INSERT INTO users(fullname,email,password,role)
        VALUES('$fullname','$email','$hashedPassword','$role')");

        if($insert){

    if($role == "admin"){

        header("Location: admin-login.php");

    }else{

        header("Location: login.php");
    }

}else{

    $message = "Something went wrong!";
}
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - CareerConnect</title>

    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

    <form class="auth-form" method="POST">

        <h2>Create Account</h2>

        <?php
        if($message != ""){
            echo "<p class='message'>$message</p>";
        }
        ?>

        <div class="input-box">
            <i class="fa-solid fa-user"></i>

            <input type="text"
            name="fullname"
            placeholder="Full Name"
            required>
        </div>

        <div class="input-box">
            <i class="fa-solid fa-envelope"></i>

            <input type="email"
            name="email"
            placeholder="Email Address"
            required>
        </div>

        <div class="input-box password-box">

             <i class="fa-solid fa-lock"></i>

            <input type="password"
            name="password"
            id="password"
            placeholder="Password"
            required>

            <span class="toggle-password"
            onclick="togglePassword()">

            <i class="fa-solid fa-eye"
            id="eyeIcon"></i>

            </span>

        </div>
        <div class="input-box role-box">

            <i class="fa-solid fa-user-tag"></i>

            <select name="role" required>

                <option value="">
                    Select Role
                </option>

                <option value="jobseeker">
                    User
                </option>

                <option value="admin">
                    Admin
                </option>

            </select>

         </div>
        <div id="strength-text"></div>
        <button type="submit"
        name="register"
        class="auth-btn">

        Register

        </button>

        <p class="bottom-text">
            Already have an account?
            <a href="login.php">Login</a>
        </p>

    </form>

</div>

<script>

function togglePassword(){

    const password =
    document.getElementById("password");

    const eyeIcon =
    document.getElementById("eyeIcon");

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
// PASSWORD STRENGTH CHECKER

const passwordInput =
document.getElementById("password");

const strengthText =
document.getElementById("strength-text");

passwordInput.addEventListener("keyup", () => {

    let password = passwordInput.value;

    if(password.length == 0){

        strengthText.innerHTML = "";

    }
    else if(password.length < 6){

        strengthText.innerHTML =
        "Weak Password";

        strengthText.style.color = "red";

    }
    else if(password.match(/[A-Z]/)
    && password.match(/[0-9]/)
    && password.length >= 8){

        strengthText.innerHTML =
        "Strong Password";

        strengthText.style.color = "#22c55e";

    }
    else{

        strengthText.innerHTML =
        "Medium Password";

        strengthText.style.color = "orange";
    }

});

</script>
</body>
</html>