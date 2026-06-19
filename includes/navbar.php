<?php
session_start();
?>

<div class="navbar">

    <div class="logo">
        <i class="fa-solid fa-briefcase"></i>
        CareerConnect
    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <a href="jobs.php">Jobs</a>

        <?php if(isset($_SESSION['user_id'])){ ?>
        <a href="my-applications.php">
My Applications
</a>

            <a href="dashboard.php">

                Hi,
                <?php echo $_SESSION['user_name']; ?> 👋

            </a>

            <a href="logout.php">Logout</a>

        <?php } else { ?>

            <a href="login.php">Login</a>

            <a href="register.php">Register</a>

        <?php } ?>

    </div>

</div>