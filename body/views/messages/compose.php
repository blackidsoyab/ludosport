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
                }
            }
        }).find('[name="message"]').summernote({
            height: 200,
            onkeyup: function() {
                validateEditor();
            },
            onpaste: function() {
                validateEditor();
            }
        });;
    });
    //]]>
</script>
<form role="form" action="<?php echo base_url() . 'message/compose/' . $type; ?>" method="post" enctype="multipart/form-data" id="compose_message">
    <input type="hidden" value="<?php echo $type; ?>" name="message_type"/>
    <input type="hidden" value="0" name="reply_of"/>
    <div class="col-sm-12">
        <div class="form-group">
            <?php foreach ($message_all_types as $all_type) { ?>
                <a href="<?php echo base_url() . 'message/compose/' . $all_type; ?>" class="btn <?php echo ($type == $all_type ? 'btn-primary active' : 'btn-default'); ?>"><?php echo ucwords($all_type); ?></a>
            <?php } ?>
        </div>
        <div class="form-group">
            <select data-placeholder="<?php echo $this->lang->line('to'); ?> ..." class="form-control chosen-select required" multiple id="to_message_list" name="to_id[]" data-bv-excluded="false">
                <?php if ($type == 'single') { ?>
                    <?php foreach ($users as $user) { ?>
                        <option value=<?php echo $user->id; ?>><?php echo $user->firstname . ' ' . $user->lastname; ?></option>
                    <?php } ?>
                <?php } ?>
                <?php if ($type == 'group') { ?>
                    <?php foreach ($groups['data'] as $value) { ?>
                        <option value=<?php echo $value->id; ?>><?php echo $value->$groups['filed']; ?></option>
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
            <div class="input-group">
                <input type="text" class="form-control" readonly>
                <span class="input-group-btn">
                    <span class="btn btn-primary btn-file">
                        <?php echo $this->lang->line('browse_file'); ?><input type="file" multiple name="attachments">
                    </span>
                </span>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" name="action" value="send" class="btn btn-success" data-toggle="tooltip" title="<?php echo $this->lang->line('send'), ' ', $this->lang->line('message'); ?>"><i class="fa fa-rocket"></i> <?php echo $this->lang->line('send'), ' ', $this->lang->line('message'); ?></button>
            <button type="submit" name="action" value="draft" class="btn btn-info" data-toggle="tooltip" title="<?php echo $this->lang->line('save'), ' ', $this->lang->line('draft'); ?>"><?php echo $this->lang->line('save'), ' ', $this->lang->line('draft'); ?></button>
            <a href="<?php echo base_url() . 'message'; ?>" class="btn btn-danger" data-toggle="tooltip" title="<?php echo $this->lang->line('discard'); ?>"><?php echo $this->lang->line('discard'); ?></a>
        </div>
    </div>
</form>