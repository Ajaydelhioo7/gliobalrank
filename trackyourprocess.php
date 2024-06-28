<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}
require 'db_connect.php';

// Get the user's globalRating
$user_id = $_SESSION['user_id'];
$sql = "SELECT globalRating FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($globalRating);
$stmt->fetch();
$stmt->close();

// Determine heading and paragraph based on globalRating
if ($globalRating >= 85) {
    $heading = "Your chance of clearing Prelims this Year is 9 of 10 times";
    $paragraph = "You have shown an Excellent Progress. Your chance of selection is very high.
 
With this level of progress you just need to keep revising regularly and attempt full length test occasionally, and then you are good to go. Attempt this year's Prelims very well.
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30.
";
    $successRate = 90;
} elseif ($globalRating >= 75) {
    $heading = "Your chance of clearing Prelims this Year is 8 out of 10 times";
    $paragraph = "You have shown Amazing Progress. You have a good preparation for this year's Prelims. We advise you to attempt this year’s Prelims.
 
With this level of progress you just need to keep revising regularly and attempt about 5 more full length tests, and then you are good to go. You can focus on key improvement areas as given below. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 80;
} elseif ($globalRating >= 70) {
    $heading = "Your chance is 7 out of 10 times";
    $paragraph = "You have good Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 
 
This is no time to remain anxious, with this level of progress you just need to keep revising regularly and attempt about 5-10 more full length tests, and then you are good to go. You can focus on key improvement areas as given below. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30.";
    $successRate = 70;
} elseif ($globalRating >= 65) {
    $heading = "Your chance is 6 out of 10 times";
    $paragraph = "You have good Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 
 
This is no time to remain anxious, with this level of progress you just need to keep revising regularly and attempt about 10 more full length tests, and then you are good to go. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly.
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. ";
    $successRate = 60;
} elseif ($globalRating >= 60) {
    $heading = "Your chance is 5 out of 10 times";
    $paragraph = "You have satisfactory Progress. You have a good preparation for this year's Prelims. Although you can improve even better, we advise you to attempt this year’s Prelims. 

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 
 
Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 50;
} elseif ($globalRating >= 55) {
    $heading = "Your chance is 4 out of 10 times";
    $paragraph = "You have satisfactory Progress. You have a good preparation for this year's Prelims. You should take the decision of attempting this year's Prelims cautiously. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 40;
} elseif ($globalRating >= 50) {
    $heading = "Your chance is 3 out of 10 times";
    $paragraph = "Your Progress is below satisfactory. You should take the decision of attempting this year's Prelims cautiously. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 30;
} elseif ($globalRating >= 45) {
    $heading = "Your chance is 2 out of 10 times";
    $paragraph = "Your Progress is below satisfactory. You should not attempt this year's Prelims. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious, with this level of progress you just need to keep revising regularly. You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. 

Adjust your biological cycle. Sleep on time. Practice during the exam hours, between 9:30 to 11:30. 
";
    $successRate = 20;
} elseif ($globalRating >= 40) {
    $heading = "Your chance is 1 out of 10 times";
    $paragraph = "Your Progress is not good. You should not attempt this year's Prelims. Do not take this attempt if you have very few remaining. If this is your first attempt, you might choose to try your luck

This is no time to remain anxious. You might choose to revisit the core content. This is possible by both self-study as well as through coaching. If you need to know how to move forward from here click on “this article”.

You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. Only then you will be ready for the Prelims.
";
    $successRate = 10;
} else {
    $heading = "Your chance is 0 out of 10 times";
    $paragraph = "Your Progress is not good. You should not attempt this year's Prelims. Definitely do not try your luck if you have very few remaining. 

This is no time to remain anxious. You might choose to revisit the core content. This is possible by both self-study as well as through coaching. If you need to know how to move forward from here click on “this article”.

You can focus on key improvement areas as given below and may even attempt more sectional tests accordingly. You should also cover all PYQs and then attempt about 10 more full length tests. Only then you will be ready for the Prelims.
";
    $successRate = 0;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Process</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="styles.css"> <!-- Link the new CSS file -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <div id="branding">
                <h5>Welcome, <?php echo htmlspecialchars($_SESSION['email']); ?></h5>
                <h2>Your Global Rating: <span id="globalRating"><?php echo number_format($globalRating, 2); ?></span></h2>
            </div>
            <nav>
                <ul>
                    <li><a href="logout.php" class="logout">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php include('./header.php')?>
    <div class="container mt-5">
        
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                <h2><?php echo $heading; ?></h2>
                <p><?php echo $paragraph; ?></p>
                <h2 class="mt-5 text-primary">Key areas where you can improve</h2>
                <p>Sorry, we cannot show this result currently because your subject-wise rating is not being monitored.</p>
                </div>
                <div class="col-md-5">
                <canvas id="myPieChart"></canvas>
                </div>
            </div>
        </div>
       
    </div>
    <script>
        const ctx = document.getElementById('myPieChart').getContext('2d');
        const data = {
            labels: ['Success', 'Failure'],
            datasets: [{
                data: [<?php echo $successRate; ?>, <?php echo 100 - $successRate; ?>],
                backgroundColor: ['#4caf50', '#f44336']
            }]
        };
        const config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + '%';
                            }
                        }
                    }
                }
            }
        };
        const myPieChart = new Chart(ctx, config);
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
