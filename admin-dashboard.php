<?php

session_start();

include 'config/db.php';

// Check Login
if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
}

// Check Admin
$email = $_SESSION['user_email'];

$userQuery = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

$user = mysqli_fetch_assoc($userQuery);

if($user['role'] != 'admin'){

    header("Location: dashboard.php");
}

// Dashboard Stats
$totalJobs =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM jobs"));

$totalApplications =
mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM applications"));

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Admin Dashboard</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="dashboard-container">

<div class="dashboard-card">

<h1>
Admin Dashboard 👨‍💼
</h1>

<p class="dashboard-text">
Manage your job portal professionally 🚀
</p>

<div class="admin-stats">

<div class="stat-card">

<h2>
<?php echo $totalJobs; ?>
</h2>

<p>Total Jobs</p>

</div>

<div class="stat-card">

<h2>
<?php echo $totalApplications; ?>
</h2>

<p>Total Applications</p>

</div>

</div>

<div class="admin-buttons">

<a href="add-job.php"
class="btn">

Add Job

</a>

<a href="view-applicants.php"
class="btn">

View Applicants

</a>

</div>

</div>

</div>

</body>
</html>