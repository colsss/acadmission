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

//adding courses
if (isset($_POST['add_department'])) {
    $department = $_POST['department'];
    $status = 1;

    $query = "INSERT INTO department(department, status)
            VALUES ('$department', '$status')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully added a new department.";
        header("location: manage_department.php");
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
                                <a class="nav-link active p-3" id="v-pills-home-tab" data-toggle="pill" href="#basic_settings" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <i class="fas fa-cog"></i>
                                    Basic Settings
                                </a>
                                <a class="nav-link p-3" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="fas fa-sliders-h"></i>
                                    Questions Manager
                                </a>
                                <a class="nav-link p-3" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                                    <i class="fas fa-clock"></i>
                                    Time Settings
                                </a>
                            </div>
                        </div>
                        <div class="col-md-9" style="overflow: auto;">
                            <div class="tab-content" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="basic_settings" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <h5 class="text-gray-800">Initial Settings</h5>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="form-group">
                                                        <label for="course">Test Name</label>
                                                        <input type="text" name="department" class="form-control" id="department" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-8 col-sm-8">
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
                                                <div class="col-md-8 col-sm-8">
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
                                                <div class="col-md-8 col-sm-8">
                                                    <div class="form-group">
                                                        <label for="course">Description</label>
                                                        <textarea name="description" class="form-control" id="description" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <h5 class="text-gray-800">Add Questions</h5>

                                    <button id="add-more-items" type="button" class="btn btn-primary mb-4">
                                        <i class="fas fa-plus"></i>
                                        Add More Question
                                    </button>

                                    <!-- <div class="card shadow mb-4">
                                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                                            <h6 class="m-0 font-weight-bold text-primary">Question 1</h6>
                                        </a>
                                        <div class="collapse show" id="collapseCardExample">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="course">Question</label>
                                                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="department">Question Type</label>
                                                            <select name="department" id="department" class="form-control" required>
                                                                <option value="" selected>Choose question type...</option>
                                                                <?php foreach ($question_types as $type) { ?>
                                                                    <option value="<?php echo $type['id']; ?>"><?php echo $type['type']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div>
                                        <div id="content-panel"></div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
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
                var $card = $('<div class="main-card card shadow mb-4">\
                        <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true"\ aria-controls="collapseCardExample">\
                            <h6 class="m-0 font-weight-bold text-primary"><span class="title">Question 1</span><button type="button" class="close">\
                                    <span class="float-right">\
                                        <i class="fas fa-times-circle"></i>\
                                    </span>\
                                </button>\</h6>\
                        </a>\
                        <div class="collapse show" id="collapseCardExample">\
                            <div class="card-body">\
                                <div class="row">\
                                    <div class="col-md-12 col-sm-12">\
                                        <div class="form-group">\
                                            <label for="course">Question</label>\
                                            <textarea name="description" class="form-control" id="description" rows="3"></textarea>\
                                        </div>\
                                        <div class="form-group">\
                                            <label for="department">Question Type</label>\
                                            <select name="department" id="department" class="form-control" required>\
                                                <option value="" selected>Choose question type...</option>\
                                                <option value="1">Abstract</option>\
                                                <option value="2">Mutiple Choices</option>\
                                                <option value="3">Identification</option>\
                                                <option value="4">True or False</option>\
                                                <option value="5">Fill in the blanks</option>\
                                                <option value="5">Essay</option>\
                                            </select>\
                                        </div>\
                                    </div>\
                                </div>\
                            </div>\
                        </div>\
                </div>');

                $('#file-upload').attr("name", "item_images");
                if (cardLength == 0) {
                    $card.find(".btn-close").addClass('hidden');
                }

                console.log(cardLength);
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

                if (($('.main-card').length - 1) >= 4) {
                    $("#add-more-items").removeAttr('disabled');
                }
            });
        };

        $(document).ready(function() {
            addCols('1', $('.main-card').length);
            return false;
        });

        $("#add-more-items").click(function() {
            addCols('1', $('.main-card').length);
            console.log($('.main-card').length);
            return false;
        });
    </script>

</body>

</html>