<?php
// Include config file
require_once "includes/config.php";

if (isset($_POST['register'])) {
    $profile = strtotime(date('y-m-d H:i')) . '_' . $_POST['first_name'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email_address = $_POST['email_address'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (array_key_exists('profile', $_FILES)) {
        if ($_FILES['profile']['tmp_name'] != '') {
            $filename = 'profile' . '_' . strtotime(date('y-m-d H:i')) . '_' . basename($_FILES['profile']['name']);
            $move = move_uploaded_file($_FILES['profile']['tmp_name'], 'uploads/' . $filename);

            if ($move) {
                $profile = $filename;
            }
        }
    }

    $query = "INSERT INTO users(profile, first_name, last_name, email_address, username, password)
            VALUES ('$profile', '$first_name', '$last_name', '$email_address', '$username', '$password')";
    $query_run = mysqli_query($link, $query);

    if ($query_run) {
        $item_id = $link->insert_id;
        $query = "INSERT INTO images(item_id, file_name) VALUES ('$item_id', '$profile')";
        $query_run = mysqli_query($link, $query);
        $_SESSION['success_status'] = "You are successfully registered as a new user.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include 'includes/header.php'; ?>

<body class="main-bg-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card o-hidden border-0 shadow-lg my-3">
                    <div class="card-body p-0">
                        <div class="p-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account</h1>
                            </div>
                            <div>
                                <?php
                                    if (isset($_SESSION['success_status'])) {
                                    ?>
                                        <div class="alert alert-success alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <?php echo $_SESSION['success_status']; ?>
                                        </div>
                                    <?php
                                    unset($_SESSION['success_status']);
                                    }   
                                ?>
                            </div>
                            <form class="user" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data" novalidate>
                                <div class="form-group row">
                                    <div class="col-sm-3 mb-3 mb-sm-0">
                                        <img class="w-100 rounded-circle" src="images/male_avatar.svg" id="cimg">
                                    </div>
                                    <div class="col-sm-9 mt-3 mb-3 mb-sm-0">
                                        <label for="" class="control-label">Profile</label>
                                        <input type="file" class="form-control form-control-user" name="profile" onchange="displayImg(this,$(this))" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" name="first_name" class="form-control form-control-user" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="last_name" class="form-control form-control-user" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="email" name="email_address" class="form-control form-control-user" placeholder="Email Address">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="username" class="form-control form-control-user" placeholder="Username">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" name="password" class="form-control form-control-user" placeholder="Password">
                                    </div>
                                </div>
                                <button type="submit" name="register" class="btn btn-primary btn-user btn-block">
                                    Register
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <span>Already have an account? <a href="login.php"><strong>Login<strong></a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <script>
        function displayImg(input, _this) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cimg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>

</html>