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
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('batch'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'batch/edit/' . $batch->id; ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="type">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?></option> 
                    <option value="D" <?php echo ($batch->type == 'D') ? 'selected' : '' ?>><?php echo $this->lang->line('degrees'); ?></option>
                    <option value="H" <?php echo ($batch->type == 'H') ? 'selected' : '' ?>><?php echo $this->lang->line('honors'); ?></option>
                    <option value="Q" <?php echo ($batch->type == 'Q') ? 'selected' : '' ?>><?php echo $this->lang->line('qualifications'); ?></option>
                    <option value="S" <?php echo ($batch->type == 'S') ? 'selected' : '' ?>><?php echo $this->lang->line('securities'); ?></option> 
                </select>
            </div>
        </div>

        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('batch'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $batch->{$key . '_name'}; ?>"/>
                </div>
            </div>
        <?php } ?>

        <?php if (!is_null($batch->image)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <img src="<?php echo IMG_URL . 'batches/' . $batch->image; ?>" class="img-batch" alt="Batch">
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('image'); ?>&nbsp;<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control required" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="batch_image">
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control summernote-sm" name="description"><?php echo $batch->description; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'batch' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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