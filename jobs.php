<?php

include 'config/db.php';

$jobs = mysqli_query($conn,
"SELECT * FROM jobs ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Jobs - CareerConnect</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="jobs-container">

    <h1 class="job-heading">
        Explore Latest Jobs 🚀
    </h1>

    <div class="jobs-grid">

        <?php while($job = mysqli_fetch_assoc($jobs)){ ?>

        <div class="job-card">

            <h2>
                <?php echo $job['title']; ?>
            </h2>

            <p>
                <i class="fa-solid fa-building"></i>

                <?php echo $job['company']; ?>
            </p>

            <p>
                <i class="fa-solid fa-location-dot"></i>

                <?php echo $job['location']; ?>
            </p>

            <p>
                <i class="fa-solid fa-money-bill"></i>

                <?php echo $job['salary']; ?>
            </p>

            <p>
                <i class="fa-solid fa-briefcase"></i>

                <?php echo $job['job_type']; ?>
            </p>

            <div class="job-description">

                <?php echo $job['description']; ?>

            </div>

            <?php if(isset($_SESSION['user_id'])){ ?>

                <a href="apply-job.php?id=<?php echo $job['id']; ?>"
                class="btn">

                Apply Job

                </a>

            <?php } else { ?>

                <a href="login.php"
                class="btn">

                Login to Apply

                </a>

            <?php } ?>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>