<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#login").validate();
    });
    //]]>
</script>
<div class="alert alert-warning alert-bold-border fade in alert-dismissable" >
    <?php echo $this->lang->line('welcome_to_login'); ?>
</div>
<form role="form" action="<?php echo base_url() . 'validate'; ?>" id="login" method="post">
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('username'); ?>" autofocus name="username">
        <span class="fa fa-user form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('password'); ?>" name="password">
        <span class="fa fa-unlock-alt form-control-feedback"></span>
    </div>
    <div class="form-group">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="i-yellow-flat" title="<?php echo $this->lang->line('remember_me'); ?>"><?php echo $this->lang->line('remember_me'); ?>
            </label>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('login'); ?>"><?php echo $this->lang->line('login'); ?></button>
    </div>
</form>
<p class="text-center"><strong><a href="<?php echo base_url() . 'forgot_password'; ?>" title="<?php echo $this->lang->line('forgot_password'); ?>"><?php echo $this->lang->line('forgot_password'); ?></a></strong></p>
<p class="text-center"><?php echo $this->lang->line('or'); ?></p>
<p class="text-center"><strong><a href="<?php echo base_url() . 'register/step_1'; ?>" title="<?php echo $this->lang->line('create_new_account'); ?>"><?php echo $this->lang->line('create_new_account'); ?></a></strong></p>