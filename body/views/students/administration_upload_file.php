<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading h1"><?php echo $this->lang->line('student_administrations_menu_upload_file'); ?></h1>

<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                }
                else {
                    error.insertAfter(element);
                }
            }
        });

        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    });
    //]]>
</script>
<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'upload_file'; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('student_file_name'); ?><span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="name"  class="form-control required" placeholder="<?php echo $this->lang->line('student_file_name'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('student_file'); ?>&nbsp;<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control required" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="student_file" />
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_error_form')) {
                    echo '<label class="error">' . $this->session->flashdata('file_error_form') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('student_file_valid_till'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control datepicker required" name="valid_till">
                </div>
            </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'dashboard' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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