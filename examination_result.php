<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$examinee_id = $_SESSION['id'];

$examination_result_sql = "SELECT * FROM examination_result WHERE examinee_id = $examinee_id";
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
                                            <th>Exam Code</th>
                                            <th>Questionnaire's Title</th>
                                            <th>Course</th>
                                            <th>Grade</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($exam_results as $result) { ?>
                                            <tr>
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

    <!-- Add New Student Modal-->
    <div class="modal fade" id="add_new_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name</label>
                                    <input type="text" name="middle_name" class="form-control" id="middle_name" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div>
                                    <label for="gender">Gender</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="male" checked>
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="other">
                                    <label class="form-check-label" for="inlineRadio3">Other</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Email Address</label>
                                    <input type="email" name="email_address" class="form-control" id="email_address" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control" id="phone_number" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_choice">First Choice</label>
                                    <select id="first_choice" class="form-control">
                                        <option value="" selected>Choose your first course...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="second_choice">Second Choice</label>
                                    <select id="second_choice" class="form-control">
                                        <option value="" selected>Choose your second course...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Submit</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

</body>

</html>