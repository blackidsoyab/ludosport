<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate();

         $('.datepicker').datepicker({
                format: "dd-mm",
                startView: 1,
                autoclose: true,
                todayHighlight: true
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });

            $('textarea[name="terms_conditions"]').summernote({
                height : 200
            });
    });
    //]]>
</script>
<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('general'), ' ', $this->lang->line('system_setting'); ?></h1>
<div class="the-box">
    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'system_setting/update_general'; ?>" enctype="multipart/form-data">
        <?php foreach ($setting as $value) { ?>
            <?php if ($value->sys_key == 'login_logo' || $value->sys_key == 'main_logo') { ?>

                <?php if (!is_null($value->sys_value) && file_exists('assets/img/' . $value->sys_value)) { ?>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo 'Current ', ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">&nbsp;</span></label>
                        <div class="col-lg-8">
                            <img src="<?php echo IMG_URL . $value->sys_value; ?>" />
                        </div>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <div class=" input-group">
                            <input type="text" class="form-control" readonly="">
                            <span class="input-group-btn">
                                <span class="btn btn-default btn-file">
                                    Browse… <input type="file" name="<?php echo $value->sys_key; ?>">
                                </span>
                            </span>
                        </div>
                        <?php
                        if ($this->session->flashdata($value->sys_key)) {
                            echo '<label class="error">' . $this->session->flashdata($value->sys_key) . '</label>';
                        }
                        ?>
                    </div>
                </div>
            <?php } else if ($value->sys_key == 'default_role') { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <select class="form-control required" name="<?php echo $value->sys_key; ?>">
                            <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('role'); ?></option>
                            <?php foreach ($roles as $role) { ?> 
                                <option value="<?php echo $role->id; ?>" <?php echo ($role->id == $value->sys_value) ? 'selected' : ''; ?>><?php echo $role->{$session->language . '_role_name'}; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>
            <?php } else if ($value->sys_key == 'timezone') { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <?php echo timezone_menu($value->sys_value, 'form-control required', $value->sys_key); ?>
                    </div>
                </div>
            <?php } else if ($value->sys_key == 'reset_app_day_month') { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <input type="text" name="<?php echo $value->sys_key; ?>"  class="form-control required datepicker" value="<?php echo $value->sys_value; ?>"/>
                </div>
            </div>
            <?php } else if ($value->sys_key == 'terms_conditions') { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <textarea class="required summernote-sm" name="<?php echo $value->sys_key; ?>"><?php echo $value->sys_value; ?></textarea>
                </div>
            </div>
            <?php } else { ?>
                <div class="form-group">
                    <label for="question" class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" name="<?php echo $value->sys_key; ?>"  class="form-control required" value="<?php echo $value->sys_value; ?>"/>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-8">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url(); ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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