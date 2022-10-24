<?php
// Include config file
require_once "includes/config.php";

// Initialize the session
session_start();

$user_id = $_SESSION["id"];
$user_sql = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($link, $user_sql);
$user = $user_result->fetch_array(MYSQLI_ASSOC);

//adding courses
if (isset($_POST['update_department'])) {
    $department_id = $_POST['department_id'];
    $department = $_POST['department'];

    $query = "UPDATE department SET department = $department WHERE id = $department_id";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $_SESSION['success_status'] = "You have successfully update the department.";
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
                    <div class="container">
                        <div class="row gutters">
                            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="account-settings">
                                            <div class="user-profile">
                                                <div class="user-avatar">
                                                    <img src="uploads/<?php echo $user['profile']; ?>" alt="<?php echo $user['username']; ?>">
                                                </div>
                                                <h5 class="user-name"><?php echo $user['first_name']; ?> <?php echo $user['last_name']; ?></h5>
                                                <h6 class="user-email"><?php echo $user['email_address']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <h6 class="mb-2 text-primary">Personal Details</h6>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="lastName">First Name</label>
                                                    <input type="text" class="form-control" id="first_name" value="<?php echo $user["first_name"]; ?>" placeholder="Enter full name">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="lastName">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" value="<?php echo $user["last_name"]; ?>" placeholder="Enter full name">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="eMail">Email</label>
                                                    <input type="email" class="form-control" id="email" value="<?php echo $user["email_address"]; ?>" placeholder="Enter email ID">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" class="form-control" id="username" value="<?php echo $user["username"]; ?>" placeholder="Enter phone number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="text-right">
                                                    <button type="button" id="submit" name="submit" class="btn btn-secondary">Cancel</button>
                                                    <button type="button" id="submit" name="submit" class="btn btn-primary">Update</button>
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

</body>

</html>