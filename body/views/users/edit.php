<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate({
            rules: {
                new_cpassword: {equalTo: '#password'},
                username: {remote: '<?php echo base_url() . 'checkusername/' . $user->id; ?>'},
                email: {remote: '<?php echo base_url() . 'checkemail/' . $user->id; ?>'}
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
        
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('user'); ?></h1>
<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'user/edit/' . $user->id; ?>">
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
                        <option value="<?php echo $role->id; ?>" <?php echo (in_array($role->id, explode(',', $user->role_id))) ? 'selected' : ''; ?>><?php echo $role->$field ?></option>
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
                <input type="text" name="firstname"  class=" form-control required" placeholder="<?php echo $this->lang->line('firstname'); ?>"  value="<?php echo $user->firstname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('lastname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="lastname"  class=" form-control required" placeholder="<?php echo $this->lang->line('lastname'); ?>" value="<?php echo $user->lastname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('email'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="email" name="email"  class=" form-control required" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php echo $user->email; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('dob'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="date_of_birth"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('dob'); ?>" style="border-radius: 0px;"  data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', $user->date_of_birth); ?>" />
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
                        <option value="<?php echo $city->id; ?>" <?php echo ($city->id == $user->city_id) ? 'selected' : ''; ?>><?php echo $city->$field ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('change_status'); ?></label>
            <div class="col-lg-5"> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="status" id="radios-0" value="A" <?php echo ($user->status == 'A') ? 'checked' : ''; ?>>
                    <?php echo $this->lang->line('active'); ?>
                </label> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="status" id="radios-0" value="D" <?php echo ($user->status == 'D') ? 'checked' : ''; ?>>
                    <?php echo $this->lang->line('deactive'); ?>
                </label> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="status" id="radios-0" value="P" <?php echo ($user->status == 'P') ? 'checked' : ''; ?>>
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
                <input type="text" name="username"  class=" form-control required" placeholder="<?php echo $this->lang->line('nickname'); ?>" value="<?php echo $user->username; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_password" id="new_password"  class=" form-control required" placeholder="<?php echo $this->lang->line('password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('re_enter_password'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_cpassword"  class=" form-control required" placeholder="<?php echo $this->lang->line('re_enter_password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
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