<!-- Update Examinee Modal-->
<div class="modal fade" id="update_examinee_<?php echo $examinee['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Examinee</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
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
                                            <input type="number" name="phone_number" class="form-control" id="phone_number" required>
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
                <div class="modal-footer">
                    <button type="submit" name="update_course" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>