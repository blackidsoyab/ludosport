<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#manage").validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                }
                else {
                    error.insertAfter(element);
                }
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
        
        $('#country_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getstate/' + $('#country_id').val(),
                success: function(data)
                {
                    $('#state_id').empty();
                    $('#state_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
        
        $('#state_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getcity/' + $('#state_id').val(),
                success: function(data)
                {
                    $('#city_id').empty();
                    $('#city_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
        
        $('#same-as-school').click(function(){
            if($( '#same-as-school' ).prop( "checked" )){
                $('#same_address').hide();
            }else{
                $('#same_address').show();
            }
        });
        
        if ($('.timepicker').length > 0){
            $('.timepicker').timepicker({
                minuteStep: 5,
                showInputs: false,
                defaultTime :false,
                showMeridian : false
            });
        }

        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startView: 2,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('clan'); ?></h1>
<div class="the-box">
    <form id="manage" method="post" class="form-horizontal" action="<?php echo base_url() . 'clan/edit/' . $clan->id; ?>">

        <fieldset>
            <legend><?php echo $this->lang->line('main'); ?></legend>

            <?php
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                        <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                    </label>
                    <div class="col-lg-5">
                        <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $clan->$temp; ?>"/>
                    </div>
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="academy_id" id="academy_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option> 
                        <?php
                        $academy_name = $session->language . '_academy_name';
                        foreach ($academies as $academy) {
                            ?>
                            <option value="<?php echo $academy->id; ?>" <?php echo ($clan->academy_id == $academy->id) ? 'selected' : ''; ?>><?php echo $academy->$academy_name; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="school_id" id="school_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?></option> 
                        <?php
                        $school_name = $session->language . '_school_name';
                        foreach ($schools as $school) {
                            ?>
                            <option value="<?php echo $school->id; ?>" <?php echo ($clan->school_id == $school->id) ? 'selected' : ''; ?>><?php echo $school->$school_name; ?></option>
                        <?php } ?>  
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('teacher'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="teacher_id[]">
                        <?php foreach ($users as $user) { ?>
                            <option value="<?php echo $user->id; ?>" <?php echo (in_array($user->id, explode(',', $clan->teacher_id))) ? 'selected' : ''; ?>><?php echo $user->firstname, ' ', $user->lastname; ?></option>
                        <?php } ?> 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('level'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="level_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('level'); ?></option>
                        <?php
                        $level_filed = $session->language . '_level_name';
                        foreach ($levels as $level) {
                            ?>
                            <option value="<?php echo $level->id; ?>" <?php echo ($clan->level_id == $level->id) ? 'selected' : ''; ?>><?php echo $level->$level_filed; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('clan'), ' ', $this->lang->line('start_from'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control datepicker required" name="clan_from" value="<?php echo date('d-m-Y', strtotime($clan->clan_from));?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('clan'), ' ', $this->lang->line('end_in'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control datepicker required" name="clan_to" value="<?php echo date('d-m-Y', strtotime($clan->clan_to));?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('day'), ' ', $this->lang->line('lesson'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="lesson_day[]" multiple="multiple">
                        <?php
                        foreach ($this->config->item('custom_days') as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>" <?php echo (in_array($key, explode(',', $clan->lesson_day))) ? 'selected' : ''; ?>><?php echo $value[$session->language]; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('lesson'), ' ', $this->lang->line('time_from'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group input-append bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" name="lesson_from" value="<?php echo date('H:i', $clan->lesson_from);?>"> <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('lesson'), ' ', $this->lang->line('time_to'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group input-append bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" name="lesson_to" value="<?php echo date('H:i', $clan->lesson_to);?>"> <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend><?php echo $this->lang->line('contact'); ?></legend>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('same_as_school'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <label class="inline-popups">
                        <input type="checkbox" class="" name="same_addresss" id="same-as-school" value="1" <?php echo $clan->same_address == '1' ? 'checked' : '' ?> />
                    </label>
                </div>
            </div>
            <div id="same_address" style="display:<?php echo $clan->same_address == '1' ? 'none' : 'block' ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <textarea class="form-control required" name="address"><?php echo $clan->address; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('postal_code'); ?>  <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="postal_code" value="<?php echo $clan->postal_code; ?>"> 
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="country_id" id="country_id">
                            <option value="" disabled><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?></option>
                            <?php
                            $country_name = $session->language . '_name';
                            foreach ($countries as $country) {
                                ?>
                                <option value="<?php echo $country->id; ?>" <?php echo ($clan->country_id == $country->id) ? 'selected' : ''; ?>><?php echo $country->$country_name; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('state'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="state_id" id="state_id">
                            <option value="" disabled=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('state'); ?></option>
                            <?php
                            $state_name = $session->language . '_name';
                            foreach ($states as $state) {
                                ?>
                                <option value="<?php echo $state->id; ?>" <?php echo ($clan->state_id == $state->id) ? 'selected' : ''; ?>><?php echo $state->$state_name; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="city_id" id="city_id">
                            <option value="" disabled><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                            <?php
                            $city_name = $session->language . '_name';
                            foreach ($cities as $city) {
                                ?>
                                <option value="<?php echo $city->id; ?>" <?php echo ($clan->city_id == $city->id) ? 'selected' : ''; ?>><?php echo $city->$city_name; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #1 <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="phone_1" value="<?php echo $clan->phone_1; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #2 <span class="text-danger">&nbsp;</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="phone_2" value="<?php echo $clan->phone_2; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="email" class="form-control required" name="email" value="<?php echo $clan->email; ?>">
                    </div>
                </div>
            </div>
        </fieldset>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'clan' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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