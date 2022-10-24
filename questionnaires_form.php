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

//save settings
if (isset($_POST['save_settings'])) {
    $json['name'] = $_POST['name'];
    $json['department'] = $_POST['department'];
    $json['course'] = $_POST['course'];
    $json['description'] = $_POST['description'];

    echo json_encode($json);
}

if (isset($_POST['save_questions'])) {
    $questions = $_POST['question'];
    $question_types = $_POST['question_types'];
    $details = $_POST['details'];
    $points = $_POST['points'];

    foreach ($question as $index => $questions) {
        $s_title = $titles;
        $s_user_id = $user_id;
        $s_category = $category[$index];
        $s_details = $details[$index];
        $s_item_images = strtotime(date('y-m-d H:i')) . '_' . $user_id;
        $s_token = $token[$index];
        $s_status = 1;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body id="page-top">

    <div id="wrapper">

        <?php include 'includes/sidebar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                <?php include 'includes/navbar.php'; ?>

                <div class="container-fluid">

                    <div class="row p-2">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link active p-3" id="v-pills-home-tab" data-toggle="pill" href="#basic-settings" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <i class="fas fa-cog"></i>
                                    Basic Settings
                                </a>
                                <a class="nav-link p-3" id="v-pills-profile-tab" data-toggle="pill" href="#question-manager" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="fas fa-sliders-h"></i>
                                    Questions Manager
                                </a>
                                <a class="nav-link p-3" id="v-pills-settings-tab" data-toggle="pill" href="#time-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                    <i class="fas fa-clock"></i>
                                    Time Settings
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9" style="overflow: auto;">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="basic-settings" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <h5 class="text-gray-800">Basic Settings</h5>
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
                                                            <label for="department">Department</label>
                                                            <select name="department" id="department" class="form-control" required>
                                                                <option value="" selected>Choose Department...</option>
                                                                <?php foreach ($departments as $department) { ?>
                                                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['department']; ?></option>
                                                                <?php } ?>
                                                            </select>
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
                                                <div class="row float-right">
                                                    <div class="col-md-12 col-sm-8">
                                                        <div class="form-group">
                                                            <button type="submit" name="save_settings" class="btn btn-success">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="question-manager" role="tabpanel">
                                    <h5 class="text-gray-800">Add Questions</h5>

                                    <button id="add-more-items" type="button" class="btn btn-primary mb-4">
                                        <i class="fas fa-plus"></i>
                                        Add More Question
                                    </button>
                                    <div>
                                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                            <div id="content-panel"></div>
                                            <div class="float-right">
                                                <div class="col-md-12 col-sm-8">
                                                    <div class="form-group">
                                                        <button type="submit" name="save_questions" class="btn btn-success">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="time-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <h5 class="text-gray-800">Time Settings</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <label>Select test duration measuring method:</label>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-8">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                                        <label class="form-check-label" for="flexRadioDefault1">
                                                            Time to complete the test: (hh:mm):
                                                            <input type="text" name="department" class="form-control" id="department" required>
                                                        </label>
                                                    </div>
                                                    <div class="form-check mt-4">
                                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                        <label class="form-check-label" for="flexRadioDefault2">                                                    
                                                            Time limit for each test question (mm:ss):
                                                            <input type="text" name="department" class="form-control" id="department" required>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row mt-5">
                                                <div class="col-md-12 col-sm-8">
                                                    <div class="form-group">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Test activation date</label>
                                                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row pull-right">
                                                <div class="col-md-12 col-sm-8">
                                                    <div class="form-group">
                                                        <a id="v-pills-profile-tab" data-toggle="pill" href="#question-manager" role="tab" aria-controls="v-pills-profile" class="btn btn-success">Save</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                var $contentPanel = $target.find('div#child-panel-'+ $questionNumber);

                var $points = $('<div class="col-md-6 mt-2">\
                    <div class="mb-3">\
                        <label class="form-label">Points for correct answer</label>\
                        <input type="number" class="form-control" name="points[]" placeholder="">\
                    </div>\
                </div>');

                $contentPanel.html("");
                //Abstract
                if (selected == 1) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="abstract" value="1" checked>\
                            <input type="file" class="form-control mb-3" placeholder="Option 1">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="abstract" value="2">\
                            <input type="file" class="form-control mb-3" placeholder="Option 2">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="abstract" value="3">\
                            <input type="file" class="form-control mb-3" placeholder="Option 3">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="abstract" value="4">\
                            <input type="file" class="form-control mb-3" placeholder="Option 4">\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //Multiple Choices
                } else if (selected == 2) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="multiple_choices" value="1" checked>\
                            <input type="text" class="form-control mb-3" placeholder="Option 1">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="multiple_choices" value="2">\
                            <input type="text" class="form-control mb-3" placeholder="Option 2">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="multiple_choices" value="3">\
                            <input type="text" class="form-control mb-3" placeholder="Option 3">\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="multiple_choices" value="4">\
                            <input type="text" class="form-control mb-3" placeholder="Option 4">\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //Identification
                } else if (selected == 3) {
                    var $content = $('<div class="col-md-12 mt-4">\
                        <div class="mb-3">\
                            <label for="Identification" class="form-label">Answer</label>\
                            <input type="text" class="form-control" name="identification" id="Identification">\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //True or False
                } else if (selected == 4) {
                    var $content = $('<div class="col-md-12">\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="true_or_false" id="true-or-false" value="1" checked>\
                            <label class="form-check-label" for="true-or-false">\
                                TRUE\
                            </label>\
                        </div>\
                        <div class="form-check">\
                            <input class="form-check-input" type="radio" name="true_or_false" id="true-or-false" value="2">\
                            <label class="form-check-label" for="flexRadioDefault2">\
                                FALSE\
                            </label>\
                        </div>\
                    </div>');
                    $content.appendTo($contentPanel);
                    $points.appendTo($contentPanel);
                    //Essay
                } else if (selected == 5) {
                    var $content = $('<div class="col-md-12">\
                        <div class="mb-3">\
                            <label for="essay" class="form-label">Answer</label>\
                            <textarea class="form-control" name="essay" id="essay" rows="3"></textarea>\
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
    </script>

</body>

</html>