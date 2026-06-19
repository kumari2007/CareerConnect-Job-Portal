<?php

session_start();

include 'config/db.php';

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,

"SELECT applications.*, jobs.title,
jobs.company, jobs.location

FROM applications

JOIN jobs

ON applications.job_id = jobs.id

WHERE applications.user_id='$user_id'

ORDER BY applications.id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Applications</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="jobs-container">

<h1 class="job-heading">
My Applications 📄
</h1>

<div class="jobs-grid">

<?php while($app = mysqli_fetch_assoc($query)){ ?>

<div class="job-card">

<h2>
<?php echo $app['title']; ?>
</h2>

<p>
<i class="fa-solid fa-building"></i>

<?php echo $app['company']; ?>
</p>

<p>
<i class="fa-solid fa-location-dot"></i>

<?php echo $app['location']; ?>
</p>

<p>
<i class="fa-solid fa-circle-check"></i>

Status:
<?php echo $app['status']; ?>
</p>

<p>
<i class="fa-solid fa-file"></i>

Resume:
<?php echo $app['resume']; ?>
</p>

</div>

<?php } ?>

</div>

</div>

</body>
</html>