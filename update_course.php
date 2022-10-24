<!-- Update Course Modal-->
<div class="modal fade" id="update_course_<?php echo $course['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Course</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <?php
                                    $department_id = $course['department_id'];
                                    $result = mysqli_query($link, "SELECT *
                                                FROM department WHERE id = $department_id");
                                    $department = mysqli_fetch_array($result);
                                ?>
                                <label for="course">Course</label>
                                <input type="text" name="department" class="form-control" value="<?php echo $department['department']?>" id="department" readonly>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="course">Course</label>
                                <input type="hidden" name="course_id" class="form-control" value="<?php echo $course['id']?>" id="course_id">
                                <input type="text" name="course" class="form-control" value="<?php echo $course['course']?>" id="course" required>
                            </div>
                        </div>
                    </div>
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