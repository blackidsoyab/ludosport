<script>
    //<![CDATA[
    $(document).ready(function() {
        
        $('#academy_list').hide();
        $('#school_list').hide();
        $('#class_list').hide();
                
        $("#add").validate({
            rules: {
                new_cpassword: {equalTo: '#new_password'},
                username: {remote: '<?php echo base_url() . 'checkusername/0'; ?>'},
                email: {remote: '<?php echo base_url() . 'checkemail/0'; ?>'}
            },
            messages: {
                new_cpassword: {equalTo: '* Password does Not Match'},
                username: {remote: '* Username already exit'},
                email: {remote: '* Email already exit'}
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
        
        $('.datepicker').datepicker().on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        
        $('#role_id').change(function(){
            var check = false;
            $("#role_id option:selected").each(function() {
                if($(this).val() == '6'){
                    check = true;
                }
            });
            if(check == true){
                $('#academy_list').show();
                $('#school_list').show();
                $('#class_list').show();
            }else{
                $('#school_list').empty();
                $('#class_list').empty();
                $('#academy_list').hide()
                $('#school_list').hide();
                $('#class_list').hide();
            }
        });
        
        $('#academy_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>clan/getschools/' + $('#academy_id').val(),
                success: function(data)
                {
                    $('#school_id').empty();
                    $('#school_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
        
        $('#school_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>clan/getclasses/' + $('#school_id').val(),
                success: function(data)
                {
                    $('#class_id').empty();
                    $('#class_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></h1>
<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'user/add'; ?>">
        <h4 class="small-title"><?php echo $this->lang->line('basic'), ' ', $this->lang->line('information'); ?></h4>
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('role'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <?php
                $session = $this->session->userdata('user_session');
                $field = $session->language . '_role_name';
                ?>
                <select id="role_id" name="role_id[]" class="form-control required" multiple="multiple">
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?php echo $role->id; ?>"><?php echo $role->$field ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('firstname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="firstname"  class=" form-control required" placeholder="<?php echo $this->lang->line('firstname'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('lastname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="lastname"  class=" form-control required" placeholder="<?php echo $this->lang->line('lastname'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('email'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="email" name="email"  class=" form-control required" placeholder="<?php echo $this->lang->line('email'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('dob'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="date_of_birth"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('dob'); ?>" style="border-radius: 0px;" data-date-format="dd-mm-yyyy" />
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <?php
                $field = $session->language . '_name';
                ?>
                <select id="city_id" name="city_id" class="form-control required">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?php echo $city->id; ?>"><?php echo $city->$field ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group" id="academy_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="academy_id" id="academy_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option> 
                    <?php
                    $academy_name = $session->language . '_academy_name';
                    foreach ($academies as $academy) {
                        ?>
                        <option value="<?php echo $academy->id; ?>"><?php echo $academy->$academy_name; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group" id="school_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="school_id" id="school_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?></option> 
                </select>
            </div>
        </div>
        
        <div class="form-group" id="class_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="class_id" id="class_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'); ?></option> 
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('change_status'); ?></label>
            <div class="col-lg-5"> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="status" id="radios-0" value="A">
                    <?php echo $this->lang->line('active'); ?>
                </label> 
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="status" id="radios-1" value="D">
                    <?php echo $this->lang->line('deactive'); ?>
                </label> 
                <label class="radio-inline" for="radios-2">
                    <input type="radio" name="status" id="radios-2" value="P" checked>
                    <?php echo $this->lang->line('pending'); ?>
                </label> 
            </div>
        </div>

        <h4 class="small-title"><?php echo $this->lang->line('access_control'); ?></h4>
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('nickname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="username" class=" form-control required" placeholder="<?php echo $this->lang->line('nickname'); ?>" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_password" id="new_password"  class=" form-control required" placeholder="<?php echo $this->lang->line('password'); ?>" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('re_enter_password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_cpassword"  class=" form-control required" placeholder="<?php echo $this->lang->line('re_enter_password'); ?>" autocomplete="off"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'user' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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