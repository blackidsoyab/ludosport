<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#login").validate({
            rules: {
                new_cpassword: {equalTo: '#new_password'}
            },
            messages: {
                new_cpassword: {equalTo: '* Password does Not Match'}

            }
        });
    });
    //]]>
</script>
<div class="alert alert-warning alert-bold-border fade in alert-dismissable" >
    <h3><?php echo $this->lang->line('welcome_to_reset_password'); ?></h3>
</div>
<form role="form" action="<?php echo base_url() . 'reset_password/' . $random_string; ?>" id="login" method="post">
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('password'); ?>" autofocus name="new_password" id="new_password">
        <span class="fa fa-unlock-alt form-control-feedback"></span>
    </div>
    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('re_enter_password'); ?>" name="new_cpassword">
        <span class="fa fa-unlock-alt form-control-feedback"></span>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('login'); ?>"><?php echo $this->lang->line('reset_password'); ?></button>
    </div>
</form>