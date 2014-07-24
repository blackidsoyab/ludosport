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
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?></h1>
<div class="the-box">
    <form id="manage" method="post" class="form-horizontal" action="<?php echo base_url() . 'clan/add'; ?>">

        <fieldset>
            <legend><?php echo $this->lang->line('main'); ?></legend>

            <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                        <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                    </label>
                    <div class="col-lg-5">
                        <input type="text" name="<?php echo $key . '_class_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>"/>
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
                            <option value="<?php echo $academy->id; ?>"><?php echo $academy->$academy_name; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="school_id" id="school_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?></option> 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('teacher'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="teacher_id[]">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('teacher'); ?></option>
                        <?php foreach ($users as $user) { ?>
                            <option value="<?php echo $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></option>
                        <?php } ?>    
                    </select>
                </div>
            </div>

        </fieldset>

        <fieldset>
            <legend><?php echo $this->lang->line('contact'); ?></legend>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('same_as_school'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <label class="inline-popups">
                        <input type="checkbox" class="" name="same_addresss" id="same-as-school" value="1">
                    </label>
                </div>
            </div>
            <div id="same_address">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <textarea class="form-control required" name="address"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('postal_code'); ?>  <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="postal_code">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="country_id" id="country_id">
                            <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?></option>
                            <?php
                            $country_name = $session->language . '_name';
                            foreach ($countries as $country) {
                                ?>
                                <option value="<?php echo $country->id; ?>"><?php echo $country->$country_name; ?></option>
                            <?php } ?>     
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('state'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="state_id" id="state_id">
                            <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('state'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <select class="form-control required" name="city_id" id="city_id">
                            <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #1 <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control required" name="phone_1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #2 <span class="text-danger">&nbsp;</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control" name="phone_2">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="email" class="form-control required" name="email">
                    </div>
                </div>
            </div>
        </fieldset>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'clan' ?>" class="btn btn-default" title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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