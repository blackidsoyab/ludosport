<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('email_template'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'email/edit/' . @$email->id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('type'); ?></label>
            <div class="col-lg-8">
                <input type="text" class="form-control" value="<?php echo $email->type ?>" disabled="disabled"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('subject'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <input type="text" class="form-control required" name="subject" value="<?php echo $email->subject ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('message'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control required summernote-sm" name="message"><?php echo $email->message; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('attachment'); ?></label>
            <div class="col-lg-8">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            Browse… <input type="file" name="attachment">
                        </span>
                    </span>
                </div>
                <?php if (!empty($email->attachment)) { ?>
                    <div class="pull-right">
                        <a href="<?php echo base_url() . 'assets/email_attachments/' . $email->attachment; ?>" class="text-primary" target="_blank"><?php echo $this->lang->line('show'), ' ', $this->lang->line('attachment'); ?></a>&nbsp;&nbsp;<a href="<?php echo base_url() . 'email/remove_attachment/' . $email->id; ?>" class="text-danger"><?php echo $this->lang->line('remove'), ' ', $this->lang->line('attachment'); ?></a>
                    </div>
                <?php } ?>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('pre_format'); ?></label>
            <div class="col-lg-8">
                <pre class="prettyprint linenums"><?php echo $email->format_info; ?></pre>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-8">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'email' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-8">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>