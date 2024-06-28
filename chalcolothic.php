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
    <title>Chalcolothic Age</title>
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
                    <h2>Chalcolothic Age</h2>
                    <a href="https://99notes.in/upsc-notes/general-studies-1/history/ancient-india/chalcolithic-stone-copper-age/">Original Content Link</a>
                    <p>Chalcolithic is made from two Greek words, khalkos and lithos, meaning
copper and stone, respectively. It dates from 6,500 years ago to around 2500
years ago. This marks the beginning of the use of metalwork technology. For
the first time, people started using metals along with stone tools.</p>
<p>In the Indus valley and the adjoining areas, the Chalcolithic period started
around 6500 years ago for the sites such as Kalibangan. This early start is
attributed to the availability of copper mines in the nearby areas, such as the
Khetri mines.</p>
<p>The Chalcolithic age in the Indian subcontinent runs parallel to the Harappan
civilisation. However, due to the absence of &#39;Tin&#39;, these could not develop into
the Bronze culture. Nevertheless, these cultures were no less remarkable than
the Harappan culture.</p>
<h2>Features of the Chalcolithic Period: -</h2>
<ul>
    <li>Introduction of agriculture – People started producing cereals and
grains such as rice, wheat, pulses, bajra, and ragi. We find one of the
first pieces of evidence of the use of cotton.</li>
<li>Domestication of Animals – They domesticated many kinds of
animals: cows, sheep, goats, buffalo and dogs.</li>
<li>Shelter – They started to live in rural settlements with mud brick
houses.</li>
<li>Tools – They knew copper smelting. Copper was used for the first
time to make tools and other objects.</li>
<li>Art – The pottery made was black and red pottery and ochre-
coloured pottery.</li>
<li>Religion – The discovery of earth goddess clay images in chalcolithic
sites suggests some form of religion.</li>
<li>Jewellery – The discovery of jewellery in sites shows that they were
fond of ornaments and decorations.</li>
</ul>

  
                    
                </div>
            </div>
            <div class="col-md-5">
                <div class="dashboard-content">
                    <div class="form-group">
                        <label for="tagFilter">Select Tag:</label>
                        <select class="form-control" id="tagFilter" name="tagFilter">
                            <option value="">All Chalcolothic Questions</option>
                            <?php
                            $sql = "SELECT id, tag_name FROM tags WHERE parent_tag_name='History' OR tag_name='chalcolithic_age'";
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
                    url: 'fetch_questions_chalcolothic.php',
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
