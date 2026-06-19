<?php

session_start();

include 'config/db.php';

$query = mysqli_query($conn,

"SELECT applications.*, users.fullname,
users.email, jobs.title

FROM applications

JOIN users
ON applications.user_id = users.id

JOIN jobs
ON applications.job_id = jobs.id

ORDER BY applications.id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>View Applications</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="jobs-container">

<h1 class="job-heading">
Applications 📄
</h1>

<div class="jobs-grid">

<?php while($app = mysqli_fetch_assoc($query)){ ?>

<div class="job-card">

<h2>
<?php echo $app['fullname']; ?>
</h2>

<p>
<i class="fa-solid fa-envelope"></i>

<?php echo $app['email']; ?>
</p>

<p>
<i class="fa-solid fa-briefcase"></i>

<?php echo $app['title']; ?>
</p>

<p>
<i class="fa-solid fa-file"></i>

<?php echo $app['resume']; ?>
</p>

</div>

<?php } ?>

</div>

</div>

</body>
</html>