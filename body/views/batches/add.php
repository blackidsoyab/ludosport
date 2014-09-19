<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#batch_cover_image").change(function (e) {
            if(this.disabled) return alert('File upload not supported!');
            var F = this.files;
            if(F && F[0]) {
                for(var i=0; i<F.length; i++){
                  readImage(F[0]);  
                }
            }
        });

        $("#add").validate({
            rules: {
                batch_cover_image : {
                    ImageDimension: ['width','750']
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr('type') == 'radio' || element.attr('type') == 'checkbox') {
                    error.appendTo(element.parent().parent().parent().parent());
                    $(error).css('width', '100%');
                } else if(element.attr('type') == 'file'){
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        jQuery.validator.addMethod("ImageDimension", function(value, element, params) {
                if(params[0] == 'width'){
                    if($('#cover-img-width').val() == 0 ){
                        return true;
                    } else {
                        return (Number($('#cover-img-width').val()) > Number(params[1]));
                    }
                } else {
                    if($('#cover-img-height').val() == 0 ){
                        return true;
                    } else {
                        return (Number($('#cover-img-height').val()) > Number(params[1]));
                    }
                }    
        },'Image {0} must greater than {1}px');
    });

    function readImage(file) {
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
            image.src    = _file.target.result;
            image.onload = function() {
                //$('#temp-img').attr('src', image.src);
                $('#cover-img-height').val(this.height);
                $('#cover-img-width').val(this.width);
            };     
        };
    }
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'batch/add'; ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="type">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?></option> 
                    <option value="D"><?php echo $this->lang->line('degrees'); ?></option>
                    <option value="H"><?php echo $this->lang->line('honors'); ?></option>
                    <option value="Q"><?php echo $this->lang->line('qualifications'); ?></option>
                    <option value="S"><?php echo $this->lang->line('securities'); ?></option> 
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
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('cover_image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" id="batch_cover_image" name="batch_cover_image">
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors_cover')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors_cover') . '</label>';
                }
                ?>
            </div>
            <input type="hidden" value="0" id="cover-img-height">
            <input type="hidden" value="0" id="cover-img-width">
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