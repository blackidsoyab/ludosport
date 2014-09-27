<?php $session = $this->session->userdata('user_session'); ?>
<script>
//<![CDATA[
$(document).ready(function() {
    $("#edit").validate();

    $('.student_img').hide();
    $('.batch_img').hide();

    $('#student_selection').change(function(){
        if($('#student_selection').val() != ""){
            $('.student_img').show();
            $('.student_img img').attr('src', '<?php echo IMG_URL ."user_avtar/100X100/"; ?>' + $(this).find(':selected').data('student-avtar'));
        }else{
            $('.student_img').hide();
        }
    });

    $('#batch_selection').change(function(){
        if($('#batch_selection').val() != ""){
            $('.batch_img').show();
            $('.batch_img img').attr('src', '<?php echo IMG_URL ."batches/"; ?>' + $(this).find(':selected').data('batch-image'));
        }else{
            $('.batch_img').hide();
        }
    });

    $('#student_selection').trigger('change');
    $('#batch_selection').trigger('change');
});
//]]>
</script>
<h1 class="page-heading">
    <?php 
        if($session->role == 3) {
            echo $this->lang->line('make_batch_request_to_admin'); 
        }

        if($session->role == 4) {
            echo $this->lang->line('make_batch_request_to_rector'); 
        }

        if($session->role == 5) {
            echo $this->lang->line('make_batch_request_to_dean'); 
        }
    ?>
</h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'batchrequest/edit/'. $request_details->id; ?>">

        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('student'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="form-control required" name="student_id" id="student_selection">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('student'); ?></option>
                    <?php foreach ($student_details as $pupil) { ?>
                        <option value="<?php echo $pupil->id; ?>" data-student-avtar="<?php echo $pupil->avtar; ?>" <?php echo ($pupil->id == $request_details->student_id) ? 'selected' : ''; ?>><?php echo $pupil->firstname, ' ', $pupil->lastname; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="student_img">
                <img class="img-circle avatar-60" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('batch'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-6">
                <select class="form-control required" name="batch_id" id="batch_selection">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('batch'); ?></option>
                    <?php foreach ($batches as $batch) { ?>
                        <option value="<?php echo $batch->id; ?>" data-batch-image="<?php echo $batch->image; ?>" <?php echo ($batch->id == $request_details->batch_id) ? 'selected' : ''; ?>><?php echo $batch->{$session->language.'_name'}; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="batch_img">
                <img class="img-circle avatar-60" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-6">
                <textarea rows="5" class="form-control bold-border" name="description"><?php echo $request_details->description; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">&nbsp;</label>
            <div class="col-lg-6">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'batchrequest' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-2 control-label">&nbsp;</label>
            <div class="col-lg-6">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>