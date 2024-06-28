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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>What is StoneAge?</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/quiz_style.css"> <!-- Link the new CSS file -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
            <nav>
                <ul>
                    <li><a href="trackyourprocess.php" class="logout">Track Your Progress</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <?php include('./header.php')?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7">
                <div class="content-section">
                    <h2>What is Stone Age?</h2>
                    <a href="https://99notes.in/upsc-notes/general-studies-1/history/ancient-india/the-stone-age/">Original Content Link</a>
                    <p>The Stone age refers to the prehistoric period during which stone tools were
the most prevalent form of articles used by early man. The use of stone tools
started about 2.5 million years ago with the arrival of the early humans (‘Homo
Habilis’ and Australopithecus). They were one of the earliest bipedal primates
and used tools to hunt primarily.</p>
<p>
The Stone age is classified as following based on the type and technology of
stone tools used -
</p>
<h2>Making of stone tools-</h2>
<p>A stone was shaped using an edge, a point, or a percussion surface, to make it
usable.
 Firstly, a base is formed to allow the worker to place the rough stone flat
on a surface.
 Then, blade flakes are removed to sharpen the stone from one end. In
the end, after some retouching, the stone tool is ready to be used.</p>
<h2>The Palaeolithic age (Old Stone Age)</h2>
<p>Palaeolithic is made from two Greek words, palaios and lithos, meaning old
and stone, respectively. Palaeolithic age dates from 2.5 million years ago to
12,000 years ago. Around 2.5 million years ago, the earliest form of the genus
homo, such as homo habilis, started using stone tools.</p>
<h2>The Mesolithic Age (Middle Stone Age)</h2>
<p>&#39;Mesolithic&#39; comes from two Greek words, &#39;mesos&#39; and &#39;lithos&#39;, meaning middle
and stone, respectively. It starts from the Last glacial maximum till the final
period of hunter-gatherer culture.</p>
                   

                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="dashboard-content">
                    <div class="form-group">
                        <label for="tagFilter">Select Tag:</label>
                        <select class="form-control" id="tagFilter" name="tagFilter">
                            <option value="">All StoneAge Questions</option>
                            <?php
                            $sql = "SELECT id, tag_name FROM tags WHERE parent_tag_name='stone_age' OR tag_name='stone_age'";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['tag_name']}</option>";
                                }
                            }
                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <div id="questions">
                        <!-- Questions will be loaded here via AJAX -->
                    </div>
                    <div id="question-container" class="mt-4">
                        <form id="question-form" class="question-form">
                            <div id="question-text" class="fade-in-right"></div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="1" id="option1" required>
                                <label class="form-check-label" for="option1" id="label-option1"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="2" id="option2" required>
                                <label class="form-check-label" for="option2" id="label-option2"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="3" id="option3" required>
                                <label class="form-check-label" for="option3" id="label-option3"></label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="answer" value="4" id="option4" required>
                                <label class="form-check-label" for="option4" id="label-option4"></label>
                            </div>
                            <input type="hidden" name="question_id" id="question_id">
                            <button type="submit" class="btn btn-primary mt-3">Submit and Next</button>
                            <div class="answer-result mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscription Modal -->
    <div class="modal fade" id="subscriptionModal" tabindex="-1" role="dialog" aria-labelledby="subscriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="subscriptionModalLabel">Subscription Required</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>You have attempted 5 questions. Please enter a promo code to continue.</p>
                    <div class="form-group">
                        <label for="promoCode">Promo Code:</label>
                        <input type="text" class="form-control" id="promoCode" placeholder="Enter promo code">
                    </div>
                    <div id="promoCodeError" class="text-danger" style="display: none;">Invalid promo code. Please try again.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submitPromoCode">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let questions = [];
            let currentQuestionIndex = 0;
            let attemptedQuestions = 0;
            let isSubscribed = false;

            function loadQuestion(index) {
                if (index < questions.length) {
                    const question = questions[index];
                    $('#question-text').hide().text(question.question).fadeIn(500).addClass('fade-in-right');
                    $('#label-option1').text(question.option1);
                    $('#label-option2').text(question.option2);
                    $('#label-option3').text(question.option3);
                    $('#label-option4').text(question.option4);
                    $('#question_id').val(question.id);
                    $('input[name="answer"]').prop('checked', false);
                    $('.answer-result').empty(); // Clear the previous answer result
                } else {
                    $('#question-container').html('<p>No more questions available.</p>');
                }
            }

            function updateGlobalRating() {
                $.ajax({
                    url: 'fetch_global_rating.php',
                    type: 'GET',
                    success: function(response) {
                        $('#globalRating').text(response);
                    }
                });
            }

            $('#tagFilter').change(function() {
                var tag_id = $(this).val();
                $.ajax({
                    url: 'fetch_questions_stone_age.php',
                    type: 'GET',
                    data: { tag_id: tag_id },
                    success: function(response) {
                        questions = JSON.parse(response);
                        currentQuestionIndex = 0;
                        loadQuestion(currentQuestionIndex);
                    }
                });
            });

            $('#question-form').submit(function(e) {
                e.preventDefault();

                if (attemptedQuestions >= 5 && !isSubscribed) {
                    $('#subscriptionModal').modal('show');
                    return;
                }

                var form = $(this);
                $.ajax({
                    url: 'submit_answer.php',
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        form.find('.answer-result').html(response); // Show the answer result
                        updateGlobalRating(); // Update globalRating after submitting an answer
                        currentQuestionIndex++;
                        attemptedQuestions++;
                        setTimeout(function() {
                            loadQuestion(currentQuestionIndex);
                        }, 2000); // Delay loading the next question to give time for the user to see the answer result
                    }
                });
            });

            $('#submitPromoCode').click(function() {
                const promoCode = $('#promoCode').val();
                if (promoCode === 'ajay') {
                    isSubscribed = true;
                    $('#subscriptionModal').modal('hide');
                    attemptedQuestions = 0; // Reset the counter so the user can attempt more questions
                    $('#promoCodeError').hide(); // Hide any previous error messages
                } else {
                    $('#promoCodeError').show();
                }
            });

            // Load questions on page load
            $('#tagFilter').trigger('change');

            // Update globalRating every 5 seconds
            setInterval(updateGlobalRating, 5000);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
