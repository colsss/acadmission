<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$examination_result_sql = "SELECT * FROM examination_result";
$examination_result = mysqli_query($link, $examination_result_sql);
$exam_results = $examination_result->fetch_all(MYSQLI_ASSOC);
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
                    <h1 class="h3 mb-4 text-gray-800">Examination Result</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Examination Result</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Examinee Name</th>
                                            <th>Exam Code</th>
                                            <th>Questionnaire's Title</th>
                                            <th>Department</th>
                                            <th>Course</th>
                                            <th>Grade</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($exam_results as $result) { ?>
                                            <tr>
                                                <td>
                                                    <?php 
                                                        $examinee_id = $result['examinee_id'];
                                                        $examinee_result = mysqli_query($link, "SELECT *
                                                            FROM examinee WHERE id = $examinee_id");
                                                        $examinee = mysqli_fetch_array($examinee_result)
                                                    ?>
                                                    <?php echo $examinee['last_name'] ?> <?php echo $examinee['first_name'] ?> <?php echo $examinee['middle_name'] ?>
                                                </td>
                                                <td>
                                                    <a href="#" data-toggle="modal" data-target="#examination_result_modal_<?php echo $result['id']; ?>">
                                                        EXAM-<?php echo $result['exam_code'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                        $questionnaire_id = $result['questionnaire_id'];
                                                        $questionnaire_result = mysqli_query($link, "SELECT *
                                                            FROM questionnaires WHERE id = $questionnaire_id");
                                                        $questionnaire = mysqli_fetch_array($questionnaire_result);
                                                        $settings =json_decode($questionnaire['settings']);
                                                    ?>
                                                    <?php print $settings->{'name'}; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        $course_id = $settings->{'course'};
                                                        $course_result = mysqli_query($link, "SELECT *
                                                            FROM courses WHERE id = $course_id");
                                                        $course = mysqli_fetch_array($course_result);
                                                    ?>
                                                    <?php
                                                         $department_id = $course['department_id'];
                                                         $department_result = mysqli_query($link, "SELECT *
                                                             FROM department WHERE id = $department_id");
                                                         $department = mysqli_fetch_array($department_result);
                                                    ?>
                                                    <?php echo $department['department'] ?>
                                                </td>
                                                <td>
                                                    <?php echo $course['course'] ?>
                                                </td>
                                                <td><?php echo $result['grade'] ?></td>
                                                <td>
                                                    <?php if ($result['result'] == "Passed") { ?>
                                                        <span class="badge badge-success" style="font-size: 16px;"><?php echo $result['result'] ?></span>
                                                    <?php } else { ?>
                                                        <span class="badge badge-danger" style="font-size: 16px;"><?php echo $result['result'] ?></span>
                                                    <?php } ?>
                                                </td>
                                                <?php include 'examination_result_modal.php'; ?>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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

</body>

</html>