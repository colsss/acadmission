<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$department_sql = "SELECT * FROM department";
$department_result = mysqli_query($link, $department_sql);
$departments = $department_result->fetch_all(MYSQLI_ASSOC);

$courses_sql = "SELECT * FROM courses";
$courses_result = mysqli_query($link, $courses_sql);
$courses = $courses_result->fetch_all(MYSQLI_ASSOC);

$question_types_sql = "SELECT * FROM question_types";
$question_types_result = mysqli_query($link, $question_types_sql);
$question_types = $question_types_result->fetch_all(MYSQLI_ASSOC);

$userId = $_SESSION["id"];
//save settings and questionnaires
if (isset($_POST['save_settings'])) {
    $settings['name'] = $_POST['name'];
    $settings['course'] = $_POST['course'];
    $settings['description'] = $_POST['description'];
    $settings['choose_timer'] = $_POST['choose_timer'];
    $settings['choose_timer_option'] = $_POST['choose_timer_option'];
    $settings['activation_date'] = $_POST['activation_date'];
    $jsonSettings = json_encode($settings);
    
    $question = $_POST['question'];
    $question_types = $_POST['question_types'];
    $answer = $_POST['answer'];
    $data = $_POST['data'];
    $points = $_POST['points'];

    $query = "INSERT INTO questionnaires(user_id, settings)
            VALUES ('$userId', '$jsonSettings')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $questionnaires_id = $link->insert_id;
        foreach ($question as $index => $questions) {
            $question_id = $index + 1;
            $question_type = $question_types[$index];
            $data_answer = $answer[$index];
            $data_point = $points[$index];

            $insertValuesSQL = '';
            foreach ($data as $id => $value) {
                $option = $data[$id];
                $insertValuesSQL .= "('" . $question_id . "', '" . $question_type . "', '" . $option . "'),";
            }

            if (!empty($insertValuesSQL)) {
                $option_query = "INSERT INTO options(question_id, question_type, options)
                    VALUES $insertValuesSQL";
                mysqli_query($link, $option_query);
            }

            $question_query = "INSERT INTO questions(user_id, questionnaires_id, question_id, question, question_type, answer, points)
                VALUES ('$userId', '$questionnaires_id', '$question_id', '$questions', '$question_type', '$data_answer', '$data_point')";
            mysqli_query($link, $question_query);
        } 

        $_SESSION['success_status'] = "You have successfully added a set of questionnaires";
        header("location: manage_questionnaires.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body id="page-top" data-spy="scroll" data-target="#navbar-example">

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <div class="container-fluid">
                    <div class="row p-2">
                        <div class="col-md-12" style="overflow: auto;">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="basic-settings" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <h5 class="text-gray-800">Questions Manager</h5>
                                    <div class="card">
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-8">
                                                        <div class="form-group">
                                                            <label for="course">Questionnaire's Name</label>
                                                            <input type="text" name="name" class="form-control" id="name" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-8">
                                                        <div class="form-group">
                                                            <label for="course">Course</label>
                                                            <select name="course" id="course" class="form-control" required>
                                                                <option value="" selected>Choose Course...</option>
                                                                <?php foreach ($courses as $course) { ?>
                                                                    <option value="<?php echo $course['id']; ?>"><?php echo $course['course']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-sm-8">
                                                        <div class="form-group">
                                                            <label for="course">Description</label>
                                                            <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label>Select test duration measuring method:</label>
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-8">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="choose_timer" value="1" id="flexRadioDefault1" checked>
                                                            <label class="form-check-label">
                                                                Time to complete the test: (hh:mm):
                                                                <input type="time" name="choose_timer_option[]" class="form-control" id="choose_timer_option">
                                                            </label>
                                                        </div>
                                                        <div class="form-check mt-4">
                                                            <input class="form-check-input" type="radio" name="choose_timer" value="2" id="flexRadioDefault2">
                                                            <label class="form-check-label">
                                                                Time limit for each test question (mm:ss):
                                                                <input type="time" name="choose_timer_option[]" class="form-control" id="choose_timer_option" min="00:00:00" max="20:00:00">
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-5">
                                                    <div class="col-md-4 col-sm-8">
                                                        <div class="form-group">
                                                            <div class="mb-3">
                                                                <label class="form-label">Test activation date</label>
                                                                <div class="form-group">
                                                                    <div class='input-group date'>
                                                                        <input type='date' class="form-control" name="activation_date" />
                                                                        <span class="input-group-addon">
                                                                            <span class="fa fas-calendar"></span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <hr/>
                                                <div class="mt-4">
                                                    <h5 class="text-gray-800">Add Questions</h5>

                                                    <button id="add-more-items" type="button" class="btn btn-primary mb-4">
                                                        <i class="fas fa-plus"></i>
                                                        Add More Question
                                                    </button>
                                                    <div>
                                                        <div id="content-panel"></div>
                                                    </div>

                                                    <div class="row float-right">
                                                        <div class="col-md-12 col-sm-8">
                                                            <div class="form-group">
                                                                <button type="submit" name="save_settings" class="btn btn-success next">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'includes/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

    <script>
        $(function() {
            $('#datetimepicker1').datetimepicker();
        });

        var addCols = function(num, cardLength) {

            for (var i = 1; i <= num; i++) {
                var $parentPanel = $('<div class="col-md-12 col-sm-12 mb-4"></div>');
                var $card = $(
                    '<div class="main-card card shadow mb-4">\
                        <input type="hidden" id="question-number"/>\
                        <a href="#card" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"\ aria-controls="collapseCardExample">\
                            <h6 class="m-0 font-weight-bold text-primary"><span class="title">Question 1</span><button type="button" class="close">\
                                    <span class="float-right">\
                                        <i class="fas fa-times-circle"></i>\
                                    </span>\
                                </button>\
                            </h6>\
                        </a>\
                        <div class="collapse show" id="card">\
                            <div class="card-body">\
                                <div class="row">\
                                    <div class="col-md-12 col-sm-12">\
                                        <div class="form-group">\
                                            <label for="course">Question</label>\
                                            <textarea name="question[]" class="form-control" id="question" rows="3" required></textarea>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="question_types">Question Type</label>\
                                            <select name="question_types[]" id="question-types" class="form-control question-types" required>\
                                                <option value="" selected>Choose question type...</option>\
                                                <option value="1">Abstract</option>\
                                                <option value="2">Mutiple Choices</option>\
                                                <option value="3">Identification</option>\
                                                <option value="4">True or False</option>\
                                                <option value="5">Essay</option>\
                                            </select>\
                                        </div>\
                                        <div id="child-panel" class="child-panel"></div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                </div>');

                if (cardLength == 0) {
                    $card.find(".btn-close").addClass('hidden');
                }

                var number = cardLength + 1;
                $card.find('.child-panel').attr('id', 'child-panel-' + number);
                $card.find('#question-number').val(cardLength + 1);

                $card.find('.card-header').attr('href', '#card-' + number);
                $card.find('.collapse').attr('id', 'card-' + number);

                $card.find('.title').text('Question ' + (cardLength + 1));
                $card.appendTo($parentPanel);
                $parentPanel.appendTo('#content-panel');
            }

            $('.close').on('click', function(e) {
                e.stopPropagation();
                var $target = $(this).parents('.col-sm-12');

                $target.hide('slow', function() {
                    $target.remove();
                });
            });

            $('.question-types').change(function() {
                var $target = $(this).parents('.col-sm-12');
                var selected = $target.find('select').find("option:selected").val();
                var $questionNumber = $target.find("#question-number").val();
                var $contentPanel = $target.find('div#child-panel-' + $questionNumber);

                var $points = $('<div class="col-md-6 mt-2">\
                    <div class="mb-3">\
                        <label class="form-label">Points for correct answer</label>\
                        <input type="number" class="form-control" name="points[]" placeholder="" required>\
                    </div>\
                </div>');

                $contentPanel.html("");
                //Abstract
                if (selected == 1) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-group">\
                            <input type="file" name="data[]" class="form-control mb-3" placeholder="Option 1" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="file" name="data[]" class="form-control mb-3" placeholder="Option 2" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="file" name="data[]" class="form-control mb-3" placeholder="Option 3" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="file" name="data[]" class="form-control mb-3" placeholder="Option 4" required>\
                        </div>\
                        <div class="form-group">\
                            <label for="answer">Answer</label>\
                            <select name="answer[]" class="form-control" required>\
                                <option value="1" selected>Option 1</option>\
                                <option value="2">Option 2</option>\
                                <option value="3">Option 3</option>\
                                <option value="4">Option 4</option>\
                            </select>\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //Multiple Choices
                } else if (selected == 2) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-group">\
                            <input type="text" name="data[]" class="form-control mb-3" placeholder="Option 1" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="text" name="data[]" class="form-control mb-3" placeholder="Option 2" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="text" name="data[]" class="form-control mb-3" placeholder="Option 3" required>\
                        </div>\
                        <div class="form-group">\
                            <input type="text" name="data[]" class="form-control mb-3" placeholder="Option 4" required>\
                        </div>\
                        <div class="form-group">\
                            <label for="answer">Answer</label>\
                            <select name="answer[]" class="form-control" required>\
                                <option value="1" selected>Option 1</option>\
                                <option value="2">Option 2</option>\
                                <option value="3">Option 3</option>\
                                <option value="4">Option 4</option>\
                            </select>\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //Identification
                } else if (selected == 3) {
                    var $content = $('<div class="col-md-12 mt-4">\
                        <div class="mb-3">\
                            <label for="Identification" class="form-label">Answer</label>\
                            <input name="answer[]" type="text" class="form-control" name="identification" id="Identification">\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //True or False
                } else if (selected == 4) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-group">\
                            <label for="answer">Answer</label>\
                            <select name="answer[]" class="form-control" required>\
                                <option value="1" selected>TRUE</option>\
                                <option value="2">FALSE</option>\
                            </select>\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                } 
            });

        };

        $(document).ready(function() {
            addCols('1', $('.main-card').length);
            return false;
        });

        $("#add-more-items").click(function() {
            addCols('1', $('.main-card').length);
            return false;
        });

        $('#date').datepicker({
            todayHighlight: true,
            format: 'dd/mm/yyyy',
            startDate: new Date()   
        });

    </script>

</body>

</html>