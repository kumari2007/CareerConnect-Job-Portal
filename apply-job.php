<?php

session_start();

include 'config/db.php';

// Check Login
if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
}

$user_id = $_SESSION['user_id'];

$job_id = $_GET['id'];

$message = "";

// Fetch Job
$jobQuery = mysqli_query($conn,
"SELECT * FROM jobs WHERE id='$job_id'");

$job = mysqli_fetch_assoc($jobQuery);

// Apply Job
if(isset($_POST['apply'])){

    // Resume Upload
    $resumeName =
    $_FILES['resume']['name'];

    $tempName =
    $_FILES['resume']['tmp_name'];

    $resumePath =
    "assets/uploads/resumes/" . $resumeName;

    // Check Duplicate Apply
    $checkApply = mysqli_query($conn,
    "SELECT * FROM applications
    WHERE user_id='$user_id'
    AND job_id='$job_id'");

    if(mysqli_num_rows($checkApply) > 0){

        $message =
        "You already applied for this job!";

    }else{

        move_uploaded_file($tempName, $resumePath);

        mysqli_query($conn,
        "INSERT INTO applications
        (user_id,job_id,resume)
        VALUES
        ('$user_id','$job_id','$resumeName')");

        $message =
        "Application Submitted Successfully!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Apply Job</title>

<link rel="stylesheet"
href="assets/css/style.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

<?php include 'includes/navbar.php'; ?>

<div class="auth-container">

<form class="auth-form"
method="POST"
enctype="multipart/form-data">

<h2>Apply Job 🚀</h2>

<?php
if($message != ""){
    echo "<p class='message'>$message</p>";
}
?>

<div class="job-preview">

    <h3>
        <?php echo $job['title']; ?>
    </h3>

    <p>
        <?php echo $job['company']; ?>
    </p>

</div>

<div class="input-box">

<input type="file"
name="resume"
required>

</div>

<button type="submit"
name="apply"
class="auth-btn">

Submit Application

</button>

</form>

</div>

</body>
</html>