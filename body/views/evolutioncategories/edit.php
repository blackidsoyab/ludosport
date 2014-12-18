<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[

    function readImage(file) {
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
            image.src    = _file.target.result;
            image.onload = function() {
                //$('#temp-img').attr('src', image.src);
                $('#evolution-img-height').val(this.height);
                $('#evolution-img-width').val(this.width);
            };     
        };
    }

    $(document).ready(function() {

        $("#evolution_image").change(function (e) {
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
                evolution_image : {
                    ImageDimension: ['width','1000']
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                } else if(element.attr('type') == 'file'){
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        jQuery.validator.addMethod("ImageDimension", function(value, element, params) {
                if(value == '') return true;
                if(params[0] == 'width'){
                    return (Number($('#evolution-img-width').val()) > Number(params[1]));
                 } else {
                    return (Number($('#evolution-img-height').val()) > Number(params[1]));
                 }    
        },'Image {0} must greater than {1}px');
        
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
        },'Must be greater than {0}');

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
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('evolutioncategory'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'evolutioncategory/edit/' . $evolutioncategory->id; ?>" enctype="multipart/form-data">
       <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('evolutioncategory'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $evolutioncategory->{$key . '_name'} ?>"/>
                </div>
            </div>
        <?php } ?>

        <?php if (!is_null($evolutioncategory->image)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-8">
                    <img src="<?php echo IMG_URL . 'evolution_images/' . $evolutioncategory->image; ?>" class="img-batch" alt="Batch">
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="evolution_image" id="evolution_image">
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
            <input type="hidden" value="0" id="evolution-img-height">
            <input type="hidden" value="0" id="evolution-img-width">
        </div>

        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('description'); ?>
                    <span class="text-danger">&nbsp;</span>
                </label>
                <div class="col-lg-8">
                    <textarea  class="form-control summernote-sm" name="<?php echo $key . '_description'; ?>"><?php echo $evolutioncategory->{$key . '_description'} ?></textarea>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'evolutioncategory' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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