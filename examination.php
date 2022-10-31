<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$questionnaire_id = $_GET["questionnaire_id"];
$questionnaires_sql = "SELECT * FROM questionnaires WHERE id = $questionnaire_id";
$questionnaires_result = mysqli_query($link, $questionnaires_sql);
$questionnaire = $questionnaires_result->fetch_array(MYSQLI_ASSOC);

$questions_sql = "SELECT * FROM questions WHERE questionnaires_id = $questionnaire_id";
$questions_result = mysqli_query($link, $questions_sql);
$questions = $questions_result->fetch_all(MYSQLI_ASSOC);

$data = [];
foreach ($questions as $question) {
    $jsonQuestion['question'] = $question['question'];

    $question_id = $question['question_id'];
    $option_sql = "SELECT * FROM options 
           WHERE question_id = $question_id";
    $options_result = mysqli_query($link, $option_sql);
    $options = $options_result->fetch_all(MYSQLI_ASSOC);

    $array = array();
    foreach ($options as $option) {
        array_push($array, $option['options']);
    }
    $jsonQuestion['answers'] = $array;
    $jsonQuestion['correctAnswer'] = $question['answer'];

    // echo json_encode($jsonQuestion);
    array_push($data, json_encode($jsonQuestion));
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .question {
        font-size: 30px;
        margin-bottom: 10px;
    }

    .answers {
        margin-bottom: 20px;
        text-align: left;
        display: inline-block;
    }

    .answers label {
        display: block;
        margin-bottom: 10px;
    }

    button {
        color: #fff;
        border: 0px;
        border-radius: 5px !important;
        padding: 10px !important;
        cursor: pointer;
        margin-bottom: 20px;
    }

    button:hover {
        background-color: #38a;
    }

    .slide {
        position: absolute;
        left: 0px;
        top: 0px;
        width: 100%;
        z-index: 1;
        opacity: 0;
        transition: opacity 0.5s;
    }

    .active-slide {
        opacity: 1;
        z-index: 2;
    }

    .quiz-container {
        width: 100%;
        position: relative;
    }
</style>

<?php include 'includes/header.php'; ?>

<body id="page-top">

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <div class="container-fluid">
                    <label>Time Remaining:</label>
                    <h2 class="h3 mb-4 text-gray-800"><span id="timerText">--:--</span></h2>
                    <div class="row m-2 card shadow mb-4 p-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Question <span id="question_number"></span></h6>
                        </div>
                        <div class="col-md-12 mt-4">
                            <div class="quiz-container">
                                <div id="quiz"></div>
                            </div>
                        </div>
                        <div class="row m-2">
                            <div style="margin-top: 200px;">
                                <button class="btn btn-secondary" id="previous">Previous Question</button>
                                <button class="btn btn-primary" id="next">Next Question</button>
                                <button class="btn btn-success" id="submit">Submit Exam</button>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="exam_results hidden row m-2 card shadow mb-4 p-4">
                        <div id="results"></div>
                    </div> -->
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Add New Student Modal-->
        <div class="modal fade" id="exam_result_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Examination Result</h5>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <div class="modal-body">
                            <div id="results"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add_department" class="btn btn-success">
                                <i class="fas fa-plus"></i>
                                Completed
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <?php include 'includes/scripts.php'; ?>
        <?php include 'includes/background.php'; ?>

        <script>
            $(function() {
                // Config
                var mins = 10; // Min test time
                var secs = 0; // Seconds (In addition to min) test time
                var timerDisplay = $('#timerText');

                //Globals: 
                var timeExpired = false;

                // Test time in seconds
                var totalTime = secs + (mins * 60);

                var countDown = function(callback) {
                    var interval;
                    interval = setInterval(function() {
                        if (secs === 0) {
                            if (mins === 0) {
                                timerDisplay.text('0:00');
                                clearInterval(interval);
                                callback();
                                return;
                            } else {
                                mins--;
                                secs = 60;
                            }
                        }
                        var minute_text;
                        if (mins > 0) {
                            minute_text = mins;
                        } else {
                            minute_text = '0';
                        }
                        var second_text = secs < 10 ? ('0' + secs) : secs;

                        timerDisplay.text(minute_text + ':' + second_text);
                        secs--;
                    }, 1000, timeUp);
                };

                // When time elapses: submit form
                var timeUp = function() {
                    alert("Time's Up!");
                    timeExpired = true;
                };

                // Start the clock
                countDown(timeUp);
            });
        </script>

        <script>
            (function() {
                var questionArray = <?php echo json_encode($data); ?>;

                // Functions
                function buildQuiz() {
                    // variable to store the HTML output
                    const output = [];

                    for (var i = 0; i < questionArray.length; i++) {
                        questionNumber = i;
                        currentQuestion = jQuery.parseJSON(questionArray[i]);

                        // variable to store the list of possible answers
                        const answers = [];

                        // and for each available answer...
                        for (letter in currentQuestion.answers) {
                            $option = parseInt(letter) + 1;
                            // ...add an HTML radio button
                            answers.push(
                                `<label>
                                <input type="radio" name="question${questionNumber}" value="${$option}">
                                    ${$option} :
                                    ${currentQuestion.answers[letter]}
                                </label>`
                            );
                        }

                        // add this question and its answers to the output
                        output.push(
                            `<div class="slide">
                                    <div class="question"> ${currentQuestion.question} </div>
                                    <div class="answers"> ${answers.join("")} </div>
                                </div>`
                        );
                    }

                    // finally combine our output list into one string of HTML and put it on the page
                    quizContainer.innerHTML = output.join('');
                }

                function showResults() {

                    // gather answer containers from our quiz
                    const answerContainers = quizContainer.querySelectorAll('.answers');

                    // keep track of user's answers
                    let numCorrect = 0;

                    for (var i = 0; i < questionArray.length; i++) {
                        questionNumber = i;
                        currentQuestion = jQuery.parseJSON(questionArray[i]);

                        // find selected answer
                        const answerContainer = answerContainers[questionNumber];
                        const selector = `input[name=question${questionNumber}]:checked`;
                        const userAnswer = (answerContainer.querySelector(selector) || {}).value;

                        // if answer is correct
                        if (userAnswer === currentQuestion.correctAnswer) {
                            // add to the number of correct answers
                            numCorrect++;
                        }
                    }

                    // show number of correct answers out of total
                    $(".exam_results").removeClass('hidden');
                    $('#exam_result_modal').modal('show');
                    resultsContainer.innerHTML = `${numCorrect} out of ${questionArray.length}`;
                }

                function showSlide(n) {
                    const questionNumberContainer = document.getElementById('question_number');
                    questionNumberContainer.innerHTML = `${n + 1} out of ${questionArray.length}`;

                    slides[currentSlide].classList.remove('active-slide');
                    slides[n].classList.add('active-slide');
                    currentSlide = n;
                    if (currentSlide === 0) {
                        previousButton.style.display = 'none';
                    } else {
                        previousButton.style.display = 'inline-block';
                    }
                    if (currentSlide === slides.length - 1) {
                        nextButton.style.display = 'none';
                        submitButton.style.display = 'inline-block';
                    } else {
                        nextButton.style.display = 'inline-block';
                        submitButton.style.display = 'none';
                    }
                }

                function showNextSlide() {
                    showSlide(currentSlide + 1);
                }

                function showPreviousSlide() {
                    showSlide(currentSlide - 1);
                }

                // Variables
                const quizContainer = document.getElementById('quiz');
                const resultsContainer = document.getElementById('results');
                const submitButton = document.getElementById('submit');

                // Kick things off
                buildQuiz();

                // Pagination
                const previousButton = document.getElementById("previous");
                const nextButton = document.getElementById("next");
                const slides = document.querySelectorAll(".slide");
                let currentSlide = 0;

                // Show the first slide
                showSlide(currentSlide);

                // Event listeners
                submitButton.addEventListener('click', showResults);
                previousButton.addEventListener("click", showPreviousSlide);
                nextButton.addEventListener("click", showNextSlide);
            })();
        </script>

</body>

</html>