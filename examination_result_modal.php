<!-- Update Department Modal-->
<div class="modal fade" id="examination_result_modal_<?php echo $result['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Examination Result Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="modal-body">
                    <?php
                    $exam_result_id = $result['id'];
                    $result_details_query = mysqli_query($link, "SELECT *
                                FROM exam_result_details WHERE id = $exam_result_id");
                    $result_details = mysqli_fetch_array($result_details_query);
                    ?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="col-sm-6">
                                <strong>Correct Answer</strong>
                            </div>
                            <div class="col-sm-6">
                                <span><?php echo $result_details['correct_answer'] ?></span>
                            </div>

                            <div class="col-sm-6">
                                <strong>Total Question</strong>
                            </div>
                            <div class="col-sm-6">
                                <span><?php echo $result_details['total_questions'] ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-sm-6">
                                <strong>Correct Answer Points</strong>
                            </div>
                            <div class="col-sm-6">
                                <span><?php echo $result_details['correct_answer_points'] ?></span>
                            </div>

                            <div class="col-sm-6">
                                <strong>Total Points</strong>
                            </div>
                            <div class="col-sm-6">
                                <span><?php echo $result_details['total_points'] ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>