<?php

session_start();

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="stylesheet"
    href="assets/css/style.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

    <div class="auth-form">

        <h2>
            Welcome,
            <?php echo $_SESSION['user_name']; ?>
        </h2>

        <p class="bottom-text">
            Login Successful 🎉
        </p>

        <br>

        <div style="text-align:center; margin-top:20px;">

    <a href="logout.php"
    class="btn">

    Logout

    </a>

</div>

    </div>

</div>

</body>
</html>