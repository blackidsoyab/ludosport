<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        function validateEditor() {
            $('#compose_message').bootstrapValidator('revalidateField', 'message');
        };
        
        $('#compose_message').bootstrapValidator({
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'fa fa-times',
                validating: 'glyphicon glyphicon-refresh'
            },

            fields: {
                'to_id[]': {
                    validators: {
                        notEmpty: {
                            message: 'The to  is required'
                        }
                    }
                },
                'subject': {
                    validators: {
                        notEmpty: {
                            message: 'The subject is required'
                        }
                    }
                },
                'message': {
                    validators: {
                        callback: {
                            message: 'The message is required and cannot be empty',
                            callback: function(value, validator) {
                                var code = $('[name="message"]').code();
                                // <p><br></p> is code generated by Summernote for empty content
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
                    }
                },
                'attachments[]': {
                validators: {
                    file: {
                        extension: 'jpg,png,jpeg',
                        message: 'The selected file is not valid'
                    }
                }
            }
            }
        }).on('click', '.addButton', function() {
            $(this).parent().find('.removeButton').show();
            $(this).parent().find('.addButton').hide();
            var $template = $('#optiontemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $option   = $clone.find('[name="attachments[]"]');
            $('#compose_message').bootstrapValidator('addField', $option);
        }).on('click', '.removeButton', function() {
            $(this).parent().parent().prev().find('.removeButton').hide();
            $(this).parent().parent().prev().find('.addButton').show();
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="attachments[]"]');
            $row.remove();
            $('#compose_message').bootstrapValidator('removeField', $option);
        }) .on('success.validator.bv', function(e, data) {
            $(data.element[0]).parent().parent().find('.addButton').show();
            $(data.element[0]).parent().parent().find('.removeButton').hide();   
        }).on('error.validator.bv', function(e, data) {
            $(data.element[0]).parent().parent().find('.removeButton').show(); 
            $(data.element[0]).parent().parent().find('.addButton').hide();   
        }).find('[name="message"]').summernote({
            height: 200,
            onkeyup: function() {
                validateEditor();
            },
            onpaste: function() {
                validateEditor();
            }
        });
     });
    //]]>
</script>
<form role="form" action="<?php echo base_url() . 'message/compose/' . $type; ?>" method="post" enctype="multipart/form-data" id="compose_message" class="form-horizontal">
    <input type="hidden" value="<?php echo $type; ?>" name="message_type"/>
    <input type="hidden" value="0" name="reply_of"/>
    <div class="col-sm-12">

        <?php if (count($message_all_types) > 1) { ?>
            <div class="form-group">
                <?php foreach ($message_all_types as $all_type) { ?>
                    <a href="<?php echo base_url() . 'message/compose/' . $all_type; ?>" class="btn <?php echo ($type == $all_type ? 'btn-primary active' : 'btn-default'); ?>"><?php echo ucwords($all_type); ?></a>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <select data-placeholder="<?php echo $this->lang->line('to'); ?> ..." class="form-control chosen-select required" multiple id="to_message_list" name="to_id[]" data-bv-excluded="false">

                <?php if ($type == 'single') { ?>
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <option value="<?php echo $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></option>
                    <?php } ?>  
                <?php } ?>

                <?php if ($type == 'group') { ?>
                    <?php foreach ($groups as $group) { ?>
                        <option value=<?php echo $group->id; ?>><?php echo $group->name; ?></option>
                    <?php } ?>
                <?php } ?>
            </select>
            <?php if (form_error('to_id') != '') { ?>
                <label class="error"><?php echo form_error('to_id'); ?></label>
            <?php } ?>
        </div>

        <div class="form-group">
            <input type="text" class="form-control input-lg required" placeholder="<?php echo $this->lang->line('subject'); ?> ..." name="subject" <?php echo set_value('subject'); ?>>
            <?php if (form_error('subject') != '') { ?>
                <label class="error"><?php echo form_error('subject'); ?></label>
            <?php } ?>
        </div>

        <div class="form-group">
            <textarea class="summernote-sm" name="message" data-bv-excluded="false"><?php echo set_value('message'); ?></textarea>
            <?php if (form_error('message') != '') { ?>
                <label class="error"><?php echo form_error('message'); ?></label>
            <?php } ?>
        </div>

        <div class="form-group">
            <div class="col-lg-10 padding-killer">
                <input type="file" name="attachments[]" class="form-control">
            </div>
            <div class="col-lg-2 pull-right">
                <button type="button" class="btn btn-primary addButton" style="display:none">
                    <i class="fa fa-plus"></i>
                </button>

                <button type="button" class="btn btn-primary removeButton" style="display:none">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="form-group hide" id="optiontemplate">
            <div class="col-lg-10 padding-killer">
                <input type="file" name="attachments[]" class="form-control">
            </div>
            <div class="col-lg-2 pull-right">
                <button type="button" class="btn btn-primary addButton" style="display:none">
                    <i class="fa fa-plus"></i>
                </button>

                <button type="button" class="btn btn-primary removeButton" style="display:none">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" name="action" value="send" class="btn btn-success" data-toggle="tooltip" title="<?php echo $this->lang->line('send'), ' ', $this->lang->line('message'); ?>"><i class="fa fa-rocket"></i> <?php echo $this->lang->line('send'), ' ', $this->lang->line('message'); ?></button>
            <a href="<?php echo base_url() . 'message'; ?>" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $this->lang->line('discard'); ?>"><?php echo $this->lang->line('discard'); ?></a>
        </div>
    </div>
</form>