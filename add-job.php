<?php

session_start();

include 'config/db.php';

// Login Check
if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
}

// Admin Check
$email = $_SESSION['user_email'];

$userQuery = mysqli_query($conn,
"SELECT * FROM users WHERE email='$email'");

$user = mysqli_fetch_assoc($userQuery);

if($user['role'] != 'admin'){

    header("Location: dashboard.php");
}

$message = "";

// Add Job
if(isset($_POST['add_job'])){

    $title =
    mysqli_real_escape_string($conn,
    $_POST['title']);

    $company =
    mysqli_real_escape_string($conn,
    $_POST['company']);

    $location =
    mysqli_real_escape_string($conn,
    $_POST['location']);

    $salary =
    mysqli_real_escape_string($conn,
    $_POST['salary']);

    $job_type =
    mysqli_real_escape_string($conn,
    $_POST['job_type']);

    $description =
    mysqli_real_escape_string($conn,
    $_POST['description']);

    $insert = mysqli_query($conn,

    "INSERT INTO jobs
    (title,company,location,salary,job_type,description)

    VALUES

    ('$title','$company','$location',
    '$salary','$job_type','$description')");

    if($insert){

        $message =
        "Job Added Successfully!";

    }else{

        $message =
        "Failed to Add Job!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Add Job</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

<form class="auth-form"
method="POST">

<h2>Add New Job 🚀</h2>

<?php
if($message != ""){
    echo "<p class='message'>$message</p>";
}
?>

<div class="input-box">

<input type="text"
name="title"
placeholder="Job Title"
required>

</div>

<div class="input-box">

<input type="text"
name="company"
placeholder="Company Name"
required>

</div>

<div class="input-box">

<input type="text"
name="location"
placeholder="Location"
required>

</div>

<div class="input-box">

<input type="text"
name="salary"
placeholder="Salary"
required>

</div>

<div class="input-box">

<select name="job_type" required>

<option value="">
Select Job Type
</option>

<option value="Full Time">
Full Time
</option>

<option value="Part Time">
Part Time
</option>

<option value="Internship">
Internship
</option>

<option value="Remote">
Remote
</option>

</select>

</div>

<div class="input-box">

<textarea
name="description"
placeholder="Job Description"
required></textarea>

</div>

<button type="submit"
name="add_job"
class="auth-btn">

Add Job

</button>

</form>

</div>

</body>
</html>