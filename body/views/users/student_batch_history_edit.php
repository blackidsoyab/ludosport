<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#add").validate();

    $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startView: 2,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
    });
});
//]]>
</script>

<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('batch'); ?></h1>

<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'user_student/badge_history/edit/' . $batch_history->id; ?>">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('title'); ?></label>
            <div class="col-lg-5">
                <input type="text" class="form-control" disabled="disabled" value="<?php echo $batch->{$session->language.'_name'}; ?>">
            </div>
        </div>

        <?php if (!is_null($batch->image)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-5">
                    <img src="<?php echo IMG_URL . 'batches/' . $batch->image; ?>" class="img-batch" alt="Batch">
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('assign_by'); ?> <span class="text-danger">&nbsp</span></label>
            <div class="col-lg-5">
                <input type="text" class="form-control"disabled="disabled" value="<?php echo $assing_user['name']; ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('assign_date'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date" class="form-control required datepicker" value="<?php echo date('d-m-Y', strtotime($batch_history->assign_date))?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'user_student/badge_history/' . $batch_history->student_id;  ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>