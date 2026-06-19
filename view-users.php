<?php

session_start();

include 'config/db.php';

$users = mysqli_query($conn,
"SELECT * FROM users ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>View Users</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="jobs-container">

<h1 class="job-heading">
Registered Users 👥
</h1>

<div class="jobs-grid">

<?php while($user = mysqli_fetch_assoc($users)){ ?>

<div class="job-card">

<h2>
<?php echo $user['fullname']; ?>
</h2>

<p>
<i class="fa-solid fa-envelope"></i>

<?php echo $user['email']; ?>
</p>

<p>
<i class="fa-solid fa-user"></i>

Role:
<?php echo $user['role']; ?>
</p>

</div>

<?php } ?>

</div>

</div>

</body>
</html>