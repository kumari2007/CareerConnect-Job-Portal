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

<div class="dashboard-container">

    <div class="dashboard-card">

        <h1>
            Hi,
            <?php echo $_SESSION['user_name']; ?> 👋
        </h1>

        <p class="dashboard-text">

            Your dream job journey starts here ✨

        </p>

        <div class="quote-box">

            <p id="quote">
                “Success doesn’t come from what you do occasionally.
                It comes from what you do consistently.”
            </p>

        </div>

        <a href="logout.php"
        class="btn dashboard-btn">

        Logout

        </a>

    </div>

</div>


<script>

const quotes = [

"Success doesn’t come from what you do occasionally. It comes from what you do consistently.",

"Dream big. Start small. Act now.",

"Your future is created by what you do today, not tomorrow.",

"Every expert was once a beginner.",

"Opportunities don’t happen. You create them."

];

let index = 0;

const quote =
document.getElementById("quote");

setInterval(() => {

    index++;

    if(index >= quotes.length){
        index = 0;
    }

    quote.style.opacity = 0;

    setTimeout(() => {

        quote.innerText = quotes[index];

        quote.style.opacity = 1;

    }, 500);

}, 5000);

</script>

</body>
</html>