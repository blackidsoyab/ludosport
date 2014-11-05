<?php $session = $this->session->userdata('user_session'); ?>
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
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('solution_course'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'solutioncourse/edit/' . $solutioncourse->id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="academy_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option>
                    <?php foreach ($academies as $academy) { ?>
                        <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == $solutioncourse->academy_id) ? 'selected' : ''; ?>><?php echo $academy->{$session->language . '_academy_name'}; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('age_criteria'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="type_1">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('age_criteria'); ?></option>
                    <?php foreach ($solution_type_1 as $type_1) { ?>
                        <option value="<?php echo $type_1['id']; ?>" <?php echo ($type_1['id'] == $solutioncourse->type_1) ? 'selected' : ''; ?>><?php echo $type_1[$session->language . '_name']; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('enrolment'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="type_2">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('enrolment'); ?></option>
                    <?php foreach ($solution_type_2 as $type_2) { ?>
                        <option value="<?php echo $type_2['id']; ?>" <?php echo ($type_2['id'] == $solutioncourse->type_2) ? 'selected' : ''; ?>><?php echo $type_2[$session->language . '_name']; ?></option>
                    <?php } ?>     
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
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('solution_course'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $solutioncourse->{$key .'_name'}; ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('price'); ?><span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="price"  class="form-control required" placeholder="<?php echo $this->lang->line('price'); ?>" value="<?php echo $solutioncourse->price; ?>"/>
            </div>
        </div>

        <?php if (!is_null($solutioncourse->image)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-8">
                    <img src="<?php echo IMG_URL . 'solution_courses/' . $solutioncourse->image; ?>">
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('image'); ?>&nbsp;<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="image" />
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_error_image') . '</label>';
                }
                ?>
            </div>
        </div>

        <?php if (!is_null($solutioncourse->form)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('course_form'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-8">
                    <a href="<?php echo base_url() .'moduli/'. $solutioncourse->type_1 .'/'. $solutioncourse->type_2 .'/'. $solutioncourse->form; ?>"><?php echo $this->lang->line('download'); ?></a>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('course_form'); ?>&nbsp;<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="form" />
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_error_form') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <textarea  class="form-control bold-border" rows="5" name="description"><?php echo $solutioncourse->description; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'solutioncourse' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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