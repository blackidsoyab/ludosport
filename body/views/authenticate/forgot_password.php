<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#form").validate();
    });
    //]]>
</script>
<div class="alert alert-warning alert-bold-border fade in alert-dismissable">
    <?php echo $this->lang->line('forgot_password_message'); ?>
</div>
<form id="form" method="post" action="<?php echo base_url() . 'send_reset_password_link'; ?>">
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="email" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('email'); ?>" autofocus="" name="user_email">
        <span class="fa fa-envelope form-control-feedback"></span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block"><?php echo strtoupper($this->lang->line('send_mail')); ?></button>
    </div>
</form>
<p class="text-center"><strong><a href="<?php echo base_url() . 'login'; ?>"><?php echo $this->lang->line('back_to_login'); ?></a></strong></p>