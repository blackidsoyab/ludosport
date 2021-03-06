<script>
    $('#chkerror').hide();
    //<![CDATA[
    $(document).ready(function() {
        $("#form").validate({
            rules: {
                cpassword: {equalTo: '#password'},
                username: {nowhitespace: true, remote: '<?php echo base_url() . 'checkusername/0'; ?>'},
                email: {remote: '<?php echo base_url() . 'checkemail/0'; ?>'},
                terms_conditions : {required: true},
                captcha: {
                    remote: '<?php echo base_url() . "check_captcha?"; ?>' + $('input[name="captcha"]').val()
                },
            },
            messages: {
                cpassword: {equalTo: '* Password does Not Match'},
                username: {remote: '* Username already exit'},
                email: {remote: '* Email already exit'},
                terms_conditions: {required : '* please accept the terms and conditions'},
                captcha: {remote: '*<?php echo $this->lang->line("captcha_code_error"); ?>'}
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
        
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "* Space is not allowed");
        
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            endDate: "01-08-2014",
            startView: 2,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });

        $('#city_id').change(function(){
            if($(this).val() == ''){
                $(this).addClass('register-select');
            }else{
                $(this).removeClass('register-select');
            }
        });

        $('#reload-captcha').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: http_host_js + 'reload_captcha',
                success: function(data) {
                    $('#captcha-image').html(data);
                }
            });
        });
    });
    //]]>
</script>

<form id="form" method="post" action="<?php echo base_url() . 'add_user'; ?>">

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" name="firstname" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('firstname'); ?>" autofocus value="<?php echo set_value('firstname'); ?>">
        <span class="fa fa-male form-control-feedback"></span>
        <label for="firstname" class="error"><?php echo form_error('firstname'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" name="lastname" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('lastname'); ?>" value="<?php echo set_value('lastname'); ?>">
        <span class="fa fa-male form-control-feedback"></span>
        <label for="lastname" class="error"><?php echo form_error('lastname'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" name="username" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('nickname'); ?>" value="<?php echo set_value('username'); ?>">
        <span class="fa fa-user form-control-feedback"></span>
        <label for="username" class="error"><?php echo form_error('username'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <select class="form-control no-border input-lg rounded required register-select" name="city_id" id="city_id">
            <option value=""><?php echo $this->lang->line('clan'), ' ', $this->lang->line('city'); ?></option>
           <?php foreach ($cities as $city) { ?>
                <option value="<?php echo $city->id; ?>"><?php echo $city->en_name; ?></option>
           <?php } ?>
        </select>
        <span class="fa fa-globe form-control-feedback"></span>
        <label for="city_id" class="error"><?php echo form_error('city_id'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" name="city_of_residence" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'); ?>" value="<?php echo set_value('city_of_residence'); ?>">
        <span class="fa fa-globe form-control-feedback"></span>
        <label for="city_of_residence" class="error"><?php echo form_error('city_of_residence'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="text" name="date_of_birth" class="form-control no-border input-lg rounded required datepicker" placeholder="<?php echo $this->lang->line('dob'); ?>" readonly="readonly" data-date-format="dd-mm-yyyy" value="<?php echo set_value('date_of_birth'); ?>">
        <span class="fa fa-calendar form-control-feedback"></span>
        <label for="date_of_birth" class="error"><?php echo form_error('date_of_birth'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="email" name="email" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('email'); ?>" autocomplete="off" value="<?php echo set_value('email'); ?>">
        <span class="fa fa-envelope form-control-feedback"></span>
        <label for="email" class="error"><?php echo form_error('email'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" name="password" id="password" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('password'); ?>" autocomplete="off">
        <span class="fa fa-lock form-control-feedback"></span>
        <label for="password" class="error"><?php echo form_error('password'); ?></label>
    </div>

    <div class="form-group has-feedback lg left-feedback no-label">
        <input type="password" name="cpassword" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('re_enter_password'); ?>" autocomplete="off">
        <span class="fa fa-unlock form-control-feedback"></span>
        <label for="cpassword" class="error"><?php echo form_error('cpassword'); ?></label>
    </div>

    <div class="form-group text-center">
        <span id="captcha-image"><?php echo $captcha_details['image']; ?></span>
        <br />
        <a id="reload-captcha" style="vertical-align: bottom">Reload Code</a>
    </div>

    <div class="form-group">
        <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha_code_info'); ?>" class="form-control no-border input-lg rounded required">
        <label for="captcha" class="error"><?php echo form_error('captcha'); ?></label>
    </div>

    <div class="form-group">
        <div class="checkbox">
            <label class="inline-popups">
                <input type="checkbox" class="i-yellow-flat" name="terms_conditions" title="<?php echo $this->lang->line('terms_conditions'); ?>"><?php echo $this->lang->line('i_accept'); ?> <a href="#text-popup" data-toggle="modal" data-target="#terms_conditions" title="<?php echo $this->lang->line('terms_conditions'); ?>"><?php echo $this->lang->line('terms_conditions'); ?></a>
            </label>
            <div id="chkerror"></div>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('enter'); ?>"><?php echo $this->lang->line('enter'); ?></button>
    </div>

    <div class="form-group text-center">
        <a href="<?php echo base_url() . 'login'; ?>"><?php echo $this->lang->line('back_to_login'); ?></a>
    </div>
</form>

<div class="modal fade" id="terms_conditions" style="color: #000 !important;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" style="color: #000 !important;"><?php echo $this->lang->line('terms_conditions'); ?></h4>
            </div>
            <div class="modal-body">
               <?php echo $this->lang->line('text_terms_conditions'); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>