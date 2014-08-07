<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate();
    });
    //]]>
</script>
<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('mail'), ' ', $this->lang->line('system_setting'); ?></h1>
<div class="the-box">
    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'system_setting/update_mail'; ?>">
        <?php foreach ($setting as $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo ucfirst(str_replace('_', ' ', $value->sys_key)); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $value->sys_key; ?>"  class="form-control required" value="<?php echo $value->sys_value; ?>"/>
                </div>
            </div>

        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url(); ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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