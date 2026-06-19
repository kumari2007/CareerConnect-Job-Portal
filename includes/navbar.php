<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

?>

<div class="navbar">

    <div class="logo">

        <i class="fa-solid fa-briefcase"></i>

        CareerConnect

    </div>

    <div class="nav-links">

        <a href="index.php">Home</a>

        <?php if(isset($_SESSION['user_id'])){ ?>

            <?php if($_SESSION['role'] == 'admin'){ ?>

                <a href="add-job.php">
                    Add Jobs
                </a>

                <a href="view-applicants.php">
                    View Applications
                </a>

                <a href="view-users.php">
                    View Users
                </a>

                <a href="admin-dashboard.php">

                    Hi, Admin
                    <?php echo $_SESSION['user_name']; ?>

                </a>

            <?php } else { ?>

                <a href="jobs.php">
                    Jobs
                </a>

                <a href="my-applications.php">
                    My Applications
                </a>

                <a href="dashboard.php">

                    Dashboard

                </a>

                <a href="dashboard.php">

                    Hi,
                    <?php echo $_SESSION['user_name']; ?>

                </a>

            <?php } ?>

            <a href="logout.php">
                Logout
            </a>

        <?php } else { ?>

            <a href="login.php">
                Login
            </a>

            <a href="register.php">
                Register
            </a>

        <?php } ?>

    </div>

</div>