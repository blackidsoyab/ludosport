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
                success: function(data) {
                    $('#school_id').empty();
                    $('#school_id').append(data);
                }
            });
        });
        
        $('#evolutioncategory_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>evolutioncategory/level/' + $('#evolutioncategory_id').val(),
                success: function(data) {
                    $('#evolutionlevel_id').empty();
                    $('#evolutionlevel_id').append(data);
                }
            });
        });

        $('#country_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getstate/' + $('#country_id').val(),
                success: function(data) {
                    $('#state_id').empty();
                    $('#state_id').append(data);
                }
            });
        });
        
        $('#state_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getcity/' + $('#state_id').val(),
                success: function(data) {
                    $('#city_id').empty();
                    $('#city_id').append(data);
                }
            });
        });
        
        $('#same-as-school').click(function(){
            if($( '#same-as-school' ).prop( "checked" )){
                $('#same_address').hide();
                $("#same_address :input").attr("disabled", true);
            }else{
                $('#same_address').show();
                $("#same_address :input").attr("disabled", false);
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

        $('#manage').on("focus",".datepicker", function(e){
            $(this).datepicker({
                format: "dd-mm-yyyy",
                todayHighlight: true
            }).on('changeDate', function (ev) {
                $(this).datepicker('hide');
            });
        });

        $('#manage').on("click",".addButton", function(e){
            $('#optiontemplate').clone().removeClass('hide').removeAttr('id').insertBefore($('#optiontemplate'));
        });

        $('#manage').on("click",".removeButton", function(e){
            if($(this).parents('.form-group').find('input[name="clan_date[]"]').val() != ''){
                UpdateRow($(this).parents('.form-group').find('input[name="clan_date[]"]'));                
            } else{
                $(this).parents('.form-group').remove();
            }
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');

        $.confirm({
            'title': 'Manage Evolution Clan Date',
            'message': 'Do you Want to Delete the Evolution Clan date ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {
                    'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'evolutionclandate/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                $(ele).parents('.form-group').remove();
                            }
                        });
                    }
                },
                '<?php echo $this->lang->line("no"); ?>': {
                    'class': 'btn btn-default',
                    'action': function() {
                    }   // Nothing to do in this case. You can as well omit the action property.
                }
            }
        });
        return false;
    }
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('evolutionclan'); ?></h1>
<div class="the-box">
    <form id="manage" method="post" class="form-horizontal" action="<?php echo base_url() . 'evolutionclan/edit/' . $evolutionclan->id; ?>">

        <fieldset>
            <legend><?php echo $this->lang->line('main'); ?></legend>

            <?php foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_class_name';
                ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                        <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                    </label>
                    <div class="col-lg-5">
                        <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $evolutionclan->$temp; ?>"/>
                    </div>
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('evolutioncategory'); ?><span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="evolutioncategory_id" id="evolutioncategory_id">
                    
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('evolutioncategory'); ?></option>
                        <?php foreach ($evolution_categories as $category) { ?>
                            <option value="<?php echo $category->id; ?>" <?php echo ($category->id == $evolutionclan->evolutioncategory_id) ? 'selected' : ''; ?>><?php echo ucwords($category->{$session->language . '_name'}); ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('level'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="evolutionlevel_id" id="evolutionlevel_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('level'); ?></option>
                        <?php foreach ($evolution_levels as $level) { ?>
                            <option value="<?php echo $level->id; ?>" <?php echo ($level->id == $evolutionclan->evolutionlevel_id) ? 'selected' : ''; ?>><?php echo ucwords($level->{$session->language . '_name'}); ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="academy_id" id="academy_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option> 
                        <?php
                        $academy_name = $session->language . '_academy_name';
                        foreach ($academies as $academy) {
                            ?>
                            <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == $academy_id) ? 'selected' : ''; ?>><?php echo $academy->$academy_name; ?></option>
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
                            <option value="<?php echo $school->id; ?>" <?php echo ($evolutionclan->school_id == $school->id) ? 'selected' : ''; ?>><?php echo $school->$school_name; ?></option>
                        <?php } ?>  
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('teacher'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="teacher_id[]">
                        <?php foreach ($users as $user) { ?>
                            <option value="<?php echo $user->id; ?>" <?php echo (in_array($user->id, explode(',', $evolutionclan->teacher_id))) ? 'selected' : ''; ?>><?php echo $user->firstname, ' ', $user->lastname; ?></option>
                        <?php } ?> 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('no_of_studnet'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="max_student" value="<?php echo $evolutionclan->max_student;?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('lesson'), ' ', $this->lang->line('time_from'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group input-append bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" name="lesson_from" value="<?php echo date('H:i', $evolutionclan->lesson_from);?>"> <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('lesson'), ' ', $this->lang->line('time_to'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <div class="input-group input-append bootstrap-timepicker">
                        <input type="text" class="form-control timepicker" name="lesson_to" value="<?php echo date('H:i', $evolutionclan->lesson_to);?>"> <span class="input-group-addon add-on"><i class="fa fa-clock-o"></i></span>
                    </div>
                </div>
            </div>

            <?php
                foreach ($clan_dates as $date) {
                    $disable = false;
                    if(strtotime($date->clan_date) <= strtotime($current_date)){
                        $disable = true;
                    }
            ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('date'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" id="<?php echo $date->id; ?>" class="form-control datepicker required" name="clan_date[]" value="<?php echo date('d-m-Y', strtotime($date->clan_date)); ?>" <?php echo ($disable) ? 'disabled="disabled"' : ''; ?>>
                    </div>
                    <?php if(!$disable) { ?>
                        <div class="col-lg-2">
                            <button type="button" class="btn btn-primary addButton">
                                <i class="fa fa-plus"></i>
                            </button>

                            <button type="button" class="btn btn-primary removeButton">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control datepicker" name="clan_date[]">
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-primary addButton">
                        <i class="fa fa-plus"></i>
                    </button>

                    <button type="button" class="btn btn-primary removeButton">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>

            <div class="form-group hide" id="optiontemplate">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('date'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control datepicker required" name="clan_date[]">
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-primary addButton">
                        <i class="fa fa-plus"></i>
                    </button>

                    <button type="button" class="btn btn-primary removeButton">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend><?php echo $this->lang->line('contact'); ?></legend>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('same_as_school'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <label class="inline-popups">
                        <input type="checkbox" class="" name="same_addresss" id="same-as-school" value="1" <?php echo $evolutionclan->same_address == '1' ? 'checked' : '' ?> />
                    </label>
                </div>
            </div>
            <div id="same_address" style="display:<?php echo $evolutionclan->same_address == '1' ? 'none' : 'block' ?>">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <textarea class="form-control required" name="address"><?php echo $evolutionclan->address; ?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('postal_code'); ?>  <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="postal_code" value="<?php echo $evolutionclan->postal_code; ?>"> 
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
                                <option value="<?php echo $country->id; ?>" <?php echo ($evolutionclan->country_id == $country->id) ? 'selected' : ''; ?>><?php echo $country->$country_name; ?></option>
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
                                <option value="<?php echo $state->id; ?>" <?php echo ($evolutionclan->state_id == $state->id) ? 'selected' : ''; ?>><?php echo $state->$state_name; ?></option>
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
                                <option value="<?php echo $city->id; ?>" <?php echo ($evolutionclan->city_id == $city->id) ? 'selected' : ''; ?>><?php echo $city->$city_name; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #1 <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="phone_1" value="<?php echo $evolutionclan->phone_1; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #2 <span class="text-danger">&nbsp;</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="phone_2" value="<?php echo $evolutionclan->phone_2; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="email" class="form-control required" name="email" value="<?php echo $evolutionclan->email; ?>">
                    </div>
                </div>
            </div>
        </fieldset>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'evolutionclan' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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