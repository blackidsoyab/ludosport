<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#form").validate({
            rules: {
                re_enter_pwd: {equalTo: '#new_pwd'},
                current_pwd: {remote: '<?php echo base_url() . 'check_current_password'; ?>'}
            },
            messages: {
                re_enter_pwd: {equalTo: '* New Password does Not Match'},
                current_pwd: {remote: '* Current Password does Not Match'}
            },
            errorPlacement: function(error, element){
                if(element.attr("type") == "checkbox"){
                    $('#chkerror').show();
                    $('#chkerror').html(error);
                }else{
                    error.insertAfter(element);
                }
            }
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('change_password'); ?></h1>
<div class="the-box">

    <form id="form" method="post" class="form-horizontal" action="<?php echo base_url() . 'change_password'; ?>">
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('current'), ' ', $this->lang->line('password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="current_pwd" id="current_pwd"  class="form-control required" placeholder="<?php echo $this->lang->line('current'), ' ', $this->lang->line('password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('new'), ' ', $this->lang->line('password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_pwd" id="new_pwd"  class="form-control required" placeholder="<?php echo $this->lang->line('new'), ' ', $this->lang->line('password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('re_enter'), ' ', $this->lang->line('password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="re_enter_pwd" id="re_enter_pwd"  class="form-control required" placeholder="<?php echo $this->lang->line('re_enter'), ' ', $this->lang->line('password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('update'); ?></button>
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