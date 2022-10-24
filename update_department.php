<!-- Update Department Modal-->
<div class="modal fade" id="update_department_<?php echo $department['id']?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Department</h5>
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
                                <input type="hidden" name="department_id" class="form-control" value="<?php echo $department['id']?>" id="department_id">
                                <input type="text" name="department" class="form-control" value="<?php echo $department['department']?>" id="department" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="update_department" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>