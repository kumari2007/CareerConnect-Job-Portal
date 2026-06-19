<?php

session_start();

include 'config/db.php';

$message = "";

if(isset($_POST['admin_login'])){

    $email =
    mysqli_real_escape_string($conn,
    $_POST['email']);

    $password = $_POST['password'];

    $query = mysqli_query($conn,

    "SELECT * FROM users
    WHERE email='$email'
    AND role='admin'");

    if(mysqli_num_rows($query) > 0){

        $admin = mysqli_fetch_assoc($query);

        if(password_verify($password,
        $admin['password'])){

            $_SESSION['user_id'] =
            $admin['id'];

            $_SESSION['user_name'] =
            $admin['fullname'];

            $_SESSION['user_email'] =
            $admin['email'];

            $_SESSION['role'] =
            $admin['role'];

            header("Location: admin-dashboard.php");

        }else{

            $message =
            "Incorrect Password!";
        }

    }else{

        $message =
        "Admin account not found!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

<form class="auth-form" method="POST">

<h2>Admin Login 👨‍💼</h2>

<?php
if($message != ""){
    echo "<p class='message'>$message</p>";
}
?>

<div class="input-box">

<i class="fa-solid fa-envelope"></i>

<input type="email"
name="email"
placeholder="Admin Email"
required>

</div>

<div class="input-box">

<i class="fa-solid fa-lock"></i>

<input type="password"
name="password"
id="adminPassword"
placeholder="Password"
required>

<span class="toggle-password"
onclick="toggleAdminPassword()">

<i class="fa-solid fa-eye"
id="adminEye"></i>

</span>

</div>

<button type="submit"
name="admin_login"
class="auth-btn">

Login as Admin

</button>

</form>

</div>

<script>

function toggleAdminPassword(){

    const password =
    document.getElementById("adminPassword");

    const eye =
    document.getElementById("adminEye");

    if(password.type === "password"){

        password.type = "text";

        eye.className =
        "fa-solid fa-eye-slash";

    }else{

        password.type = "password";

        eye.className =
        "fa-solid fa-eye";
    }
}

</script>

</body>
</html>