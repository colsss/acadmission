<?php 
    // Include config file
    require_once "includes/config.php";

    // Initialize the session
    session_start();

    $temp_password = substr(md5(uniqid(rand(1,6))), 0, 8);
    $_SESSION["pass"]= $temp_password;

    $courses_sql = "SELECT * FROM courses";
    $courses_result = mysqli_query($link, $courses_sql);
    $courses = $courses_result->fetch_all(MYSQLI_ASSOC);

    // if (isset($_POST['save_examinee'])) {
    //     $last_name = $_POST['last_name'];
    //     $first_name = $_POST['first_name'];
    //     $middle_name = $_POST['middle_name'];
    //     $address = $_POST['address'];
    //     $gender = $_POST['gender'];
    //     $email_address = $_POST['email_address'];
    //     $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //     $phone_number = $_POST['phone_number'];
    //     $first_choice = $_POST['first_choice'];
    //     $second_choice = $_POST['second_choice'];
    //     $status = 1;

    //     $query = "INSERT INTO examinee(last_name, first_name, middle_name, address, gender, email_address, password, phone_number, first_choice, second_choice, status)
    //             VALUES ('$last_name', '$first_name', '$middle_name', '$address', '$gender', '$email_address' , '$password', '$phone_number', '$first_choice' , '$second_choice', '$status')";
    //     $query_run = mysqli_query($link, $query);

    //     if ($query_run) {
    //         $_SESSION['success_status'] = "You have successfully added a new examinee.";
    //         header("location: manage_examinee.php");
    //     }
    // }
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

                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add New Examinee</h1>
                    </div>
                    <form  method="POST" class="" action="send_email.php">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Examinee</h6>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                                            <input type="text" name="password" class="form-control" id="password" value="<?php echo $temp_password; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="phone_number">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" id="phone_number" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_choice">First Choice</label>
                                            <select name="first_choice" id="first_choice" class="form-control" required>
                                                <option value="" selected>Choose Course...</option>
                                                <?php foreach ($courses as $course) { ?>
                                                    <option value="<?php echo $course['id']; ?>"><?php echo $course['course']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="second_choice">Second Choice</label>
                                            <select name="second_choice" id="second_choice" class="form-control" required>
                                                <option value="" selected>Choose Course...</option>
                                                <?php foreach ($courses as $course) { ?>
                                                    <option value="<?php echo $course['id']; ?>"><?php echo $course['course']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <button type="submit" name="save_examinee" class="btn btn-info btn-lg btn-icon-split">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-save"></i>
                                            </span>
                                            <span class="text">Save</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
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

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>
    <?php include 'includes/background.php'; ?>

</body>

</html>