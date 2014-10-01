<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        function validateEditor() {
            $('#announcement').bootstrapValidator('revalidateField', 'announcement');
        };
        
        $('#announcement').bootstrapValidator({
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
                'announcement': {
                    validators: {
                        callback: {
                            message: 'The announcement is required and cannot be empty',
                            callback: function(value, validator) {
                                var code = $('[name="announcement"]').code();
                                // <p><br></p> is code generated by Summernote for empty content
                                return (code !== '' && code !== '<p><br></p>');
                            }
                        }
                    }
                }
            }
        }).find('[name="announcement"]').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strike']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
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
<form role="form" action="<?php echo base_url() . 'announcement/compose/' . $type; ?>" method="post" enctype="multipart/form-data" id="announcement" class="form-horizontal">
    <input type="hidden" value="<?php echo $type; ?>" name="announcement_type"/>
    <div class="col-sm-12">

        <?php if (count($announcement_all_types) > 0) { ?>
            <div class="form-group">
                <?php foreach ($announcement_all_types as $all_type) { ?>
                    <a href="<?php echo base_url() . 'announcement/compose/' . $all_type; ?>" class="btn <?php echo ($type == $all_type ? 'btn-primary active' : 'btn-default'); ?>"><?php echo ucwords($all_type); ?></a>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <select data-placeholder="<?php echo $this->lang->line('to'); ?> ..." class="form-control chosen-select required" multiple id="to_announcement_list" name="to_id[]" data-bv-excluded="false">

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
            <textarea class="summernote-sm" name="announcement" data-bv-excluded="false"><?php echo set_value('announcement'); ?></textarea>
            <?php if (form_error('announcement') != '') { ?>
                <label class="error"><?php echo form_error('announcement'); ?></label>
            <?php } ?>
        </div>
        
        <div class="form-group">
            <button type="submit" name="action" value="send" class="btn btn-success" data-toggle="tooltip" title="<?php echo $this->lang->line('send'), ' ', $this->lang->line('announcement'); ?>"><i class="fa fa-rocket"></i> <?php echo $this->lang->line('send'), ' ', $this->lang->line('announcement'); ?></button>
            <a href="<?php echo base_url() . 'announcement'; ?>" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $this->lang->line('discard'); ?>"><?php echo $this->lang->line('discard'); ?></a>
        </div>
    </div>
</form>