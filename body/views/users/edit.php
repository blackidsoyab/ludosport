<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {
        <?php if (in_array('6', explode(',', $user->role_id))) { ?>
                    $('#academy_list').show();
                    $('#school_list').show();
                    $('#class_list').show();
        <?php } else { ?>
                    $('#academy_list').hide();
                    $('#school_list').hide();
                    $('#class_list').hide();
        <?php } ?>

        $("#add").validate({
            rules: {
                new_cpassword: {equalTo: '#new_password'},
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
                <?php echo $this->lang->line('city_of_residence'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="city_of_residence"  class="form-control required" placeholder="<?php echo $this->lang->line('city_of_residence'); ?>"  value="<?php echo  $user->city_of_residence; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
            <?php if(in_array(6, explode(',',$user->role_id))){ ?>
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('city'); ?>
            <?php } else { ?>
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?>
            <?php } ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <select id="city_id" name="city_id" class="form-control required">
                    <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('city'); ?></option>
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?php echo $city->id; ?>" <?php echo ($city->id == $user->city_id) ? 'selected' : ''; ?>><?php echo $city->{$session->language . '_name'} ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <h4 class="small-title"><?php echo $this->lang->line('extra'), ' ', $this->lang->line('information'); ?></h4>
        
        <div class="form-group" id="academy_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="academy_id" id="academy_id">
                    <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option> 
                    <?php
                    $academy_name = $session->language . '_academy_name';
                    foreach ($academies as $academy) {
                        ?>
                        <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == @$academy_id) ? 'selected' : ''; ?>><?php echo $academy->$academy_name; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group" id="school_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="school_id" id="school_id">
                    <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?></option> 
                    <?php
                    foreach ($schools as $school) {
                        ?>
                        <option value="<?php echo $school->id; ?>" <?php echo (@$school_id == $school->id) ? 'selected' : ''; ?>><?php echo $school->{$session->language . '_school_name'}; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group" id="class_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="class_id" id="class_id">
                    <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'); ?></option> 
                    <?php
                    foreach ($classes as $c) {
                        ?>
                        <option value="<?php echo $c->id; ?>" <?php echo ($c->id == $userdetail->clan_id) ? 'selected' : ''; ?>><?php echo $c->{$session->language . '_class_name'}; ?></option>
                    <?php } ?>  
                </select>
            </div>
        </div>

        <?php if(in_array(6, explode(',',$user->role_id))){ ?>
            <?php if(isset($degree_batches) && !is_null($degree_batches)) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('degree'); ?></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="degree_id">
                            <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('degree'); ?></option> 
                            <?php
                            foreach ($degree_batches as $degree) {
                                ?>
                                <option value="<?php echo $degree->id; ?>" <?php echo ($degree->id == $userdetail->degree_id) ? 'selected' : ''; ?>><?php echo $degree->{$session->language . '_name'}; ?></option>
                            <?php } ?>  
                        </select>
                    </div>
                </div>
            <?php } ?>

            <?php if(isset($honour_batches) && !is_null($honour_batches)) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('honour'); ?></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="honour_id">
                            <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('honour'); ?></option> 
                            <?php
                            foreach ($honour_batches as $honour) {
                                ?>
                                <option value="<?php echo $honour->id; ?>" <?php echo ($honour->id == $userdetail->honour_id) ? 'selected' : ''; ?>><?php echo $honour->{$session->language . '_name'}; ?></option>
                            <?php } ?>  
                        </select>
                    </div>
                </div>
            <?php } ?>

            <?php if(isset($master_batches) && !is_null($master_batches)) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('master'); ?></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="master_id">
                            <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('master'); ?></option> 
                            <?php
                            foreach ($master_batches as $master) {
                                ?>
                                <option value="<?php echo $master->id; ?>" <?php echo ($master->id == $userdetail->master_id) ? 'selected' : ''; ?>><?php echo $master->{$session->language . '_name'}; ?></option>
                            <?php } ?>  
                        </select>
                    </div>
                </div>
            <?php } ?>
            
            <?php if(isset($qualification_batches) && !is_null($qualification_batches)) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('qualification'); ?></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="qualification_id">
                            <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('qualification'); ?></option> 
                            <?php
                            foreach ($qualification_batches as $qualification) {
                                ?>
                                <option value="<?php echo $qualification->id; ?>" <?php echo ($qualification->id == $userdetail->qualification_id) ? 'selected' : ''; ?>><?php echo $qualification->{$session->language . '_name'}; ?></option>
                            <?php } ?>  
                        </select>
                    </div>
                </div>
            <?php } ?>

            <?php if(isset($security_batches) && !is_null($security_batches)) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('security'); ?></label>
                    <div class="col-lg-5">
                        <select class="form-control" name="security_id">
                            <option value="0"><?php echo $this->lang->line('select'), ' ', $this->lang->line('security'); ?></option> 
                            <?php foreach ($security_batches as $security) { ?>
                                <option value="<?php echo $security->id; ?>" <?php echo ($security->id == $userdetail->security_id) ? 'selected' : ''; ?>><?php echo $security->{$session->language . '_name'}; ?></option>
                            <?php } ?>  
                        </select>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('change_status'); ?></label>
            <div class="col-lg-5"> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="status" id="radios-0" value="A" <?php echo ($user->status == 'A') ? 'checked' : ''; ?>>
                    <?php echo $this->lang->line('active'); ?>
                </label> 
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="status" id="radios-1" value="D" <?php echo ($user->status == 'D') ? 'checked' : ''; ?>>
                    <?php echo $this->lang->line('deactive'); ?>
                </label> 
                <label class="radio-inline" for="radios-2">
                    <input type="radio" name="status" id="radios-2" value="P" <?php echo ($user->status == 'P') ? 'checked' : ''; ?>>
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
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_password" id="new_password"  class=" form-control" placeholder="<?php echo $this->lang->line('password'); ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('re_enter_password'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-5">
                <input type="password" name="new_cpassword"  class=" form-control" placeholder="<?php echo $this->lang->line('re_enter_password'); ?>"/>
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