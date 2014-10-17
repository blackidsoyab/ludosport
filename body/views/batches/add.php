<?php $session = $this->session->userdata('user_session'); ?>
<script>
//<![CDATA[
$(document).ready(function() {
    $("#add").validate({
        errorPlacement: function(error, element) {
            if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                error.appendTo(element.parent().parent().parent().parent());
                $(error).css('width', '100%');
            } else if(element.attr('type') == 'file'){
                error.appendTo(element.closest('.col-lg-5'));
            } else {
                error.insertAfter(element);
            }
        }
    });

    $('input[name="has_point"]').on('ifChecked', function(event){
        $('#ratting_points').show();
    });

    $('input[name="has_point"]').on('ifUnchecked', function(event){
        $('#ratting_points').hide();
    });

    $('.summernote-sm').summernote({
        height: 200,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
});
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'batch/add'; ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="type">
                    <option value="all"><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?></option> 
                    <option value="D"><?php echo $this->lang->line('degree'); ?></option>
                    <option value="H"><?php echo $this->lang->line('honour'); ?></option>
                    <option value="Q"><?php echo $this->lang->line('qualification'); ?></option>
                    <option value="S"><?php echo $this->lang->line('security'); ?></option> 
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
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('batch'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('who_can_assign'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <?php foreach ($roles as $role) { ?>
                    <span class="checkbox pull-left padding-left-killer pad-rt-10">
                        <label>
                            <input type="checkbox" value="<?php echo $role->id; ?>" class="required i-grey-flat" name="assign_role[]">
                            <?php echo $role->{$session->language.'_role_name'}; ?>
                        </label>
                    </span>
                <?php } ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('has_rating'); ?></label>
            <div class="col-lg-8">
                <div class="checkbox padding-left-killer">
                    <label>
                        <input type="checkbox" value="1" class="i-grey-flat" name="has_point">
                    </label>
                </div>
            </div>
        </div>

        <div id="ratting_points" style="display:none">
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('xpr'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="xpr" class="form-control" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('war'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="war" class="form-control" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('sty'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="sty" class="form-control" value="0"/>
                </div>
            </div>
        </div>

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
                <p class="help-block"><?php echo $this->lang->line('badge_120_width_image'); ?></p>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('dashboard_cover'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" id="batch_dashboard_cover" name="batch_dashboard_cover" data-img-width="0" data-img-height="0">
                        </span>
                    </span>
                </div>
                <p class="help-block"><?php echo $this->lang->line('badge_750_width_image'); ?></p>
                <?php
                if ($this->session->flashdata('file_errors_dashboard')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors_dashboard') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('profile_cover'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" id="batch_profile_cover" name="batch_profile_cover" data-img-width="0" data-img-height="0">
                        </span>
                    </span>
                </div>
                <p class="help-block"><?php echo $this->lang->line('badge_750_width_image'); ?></p>
                <?php
                if ($this->session->flashdata('file_errors_profile')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors_profile') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control summernote-sm" name="description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
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