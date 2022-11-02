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

// print_r($questions);
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Questionnaries Info</h1>

                    <div class="row">
                        <?php
                        $settings = json_decode($questionnaire['settings']);
                        ?>
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary"><?php print $settings->{'name'}; ?></h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php print $settings->{'description'}; ?>

                                    <?php
                                    $course_id = $settings->{'course'};
                                    $result = mysqli_query($link, "SELECT *
                                                FROM courses WHERE id = $course_id");
                                    $course = mysqli_fetch_array($result);
                                    ?>

                                    <?php
                                    $department_id = $course['department_id'];
                                    $result = mysqli_query($link, "SELECT *
                                                FROM department WHERE id = $department_id");
                                    $department = mysqli_fetch_array($result);
                                    ?>

                                    <div class="mt-4">
                                        <span class="badge badge-primary"><?php echo $department['department']; ?></span>
                                    </div>

                                    <div class="mt-2">
                                        <span class="badge badge-secondary"><?php echo $course['course']; ?></span>
                                    </div>


                                    <div class="mt-4">
                                        <small><strong>Date Added:</strong>
                                            <?php echo date('m-d-Y', strtotime($questionnaire['date_added'])); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $counter = 1; ?>
                        <?php foreach($questions as $question) { ?>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-primary">Question <?php echo $counter; ?></h6>
                                    </div>
                                    <div class="card-body">
                                        <?php echo $question['question']; ?>

                                        <?php
                                            $question_id = $question['question_id'];
                                            $option_sql = "SELECT * FROM options 
                                               WHERE questionnaires_id = $questionnaire_id && question_id = $question_id";
                                            $options_result = mysqli_query($link, $option_sql);
                                            $options = $options_result->fetch_all(MYSQLI_ASSOC);
                                        ?>

                                        <div>
                                            <?php $count = 1; ?>
                                            <?php foreach($options as $option) { ?>
                                                <span>
                                                    <span class="badge badge-info"><?php echo $count; ?></span> 
                                                    <?php echo $option['options']; ?>
                                                </span><br/>
                                            <?php 
                                                $count++;
                                            } ?>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <span><strong>Answer:</strong>
                                                 <?php echo $question['answer']; ?>
                                            </span>
                                        </div>
                                        <div>
                                            <span><strong>Points:</strong>
                                                 <?php echo $question['points']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php 
                        $counter++;
                    } ?>
                    </div>
                </div>
            </div>

            <?php include 'includes/footer.php'; ?>
        </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Add New Student Modal-->
    <div class="modal fade" id="add_department" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Department</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="course">Department</label>
                                    <input type="text" name="department" class="form-control" id="department" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="add_department" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Add
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>
</body>

</html>