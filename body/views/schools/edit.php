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
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('school'); ?></h1>
<div class="the-box">
    <form id="manage" method="post" class="form-horizontal" action="<?php echo base_url() . 'school/edit/' . $school->id; ?>">

        <fieldset>
            <legend><?php echo $this->lang->line('main'); ?></legend>

            <?php
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_school_name';
                ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                        <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                    </label>
                    <div class="col-lg-5">
                        <input type="text" name="<?php echo $key . '_school_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('school'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $school->$temp; ?>"/>
                    </div>
                </div>
            <?php } ?>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="academy_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option>
                        <?php
                        $temp = $session->language . '_academy_name';
                        foreach ($academies as $academy) {
                            ?>
                            <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == $school->academy_id) ? 'selected' : ''; ?>><?php echo $academy->$temp; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('dean'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="dean_id[]" multiple="multiple">
                        <?php foreach ($users as $user) { ?>
                            <option value="<?php echo $user->id; ?>" <?php echo (in_array($user->id, explode(',', $school->dean_id))) ? 'selected' : ''; ?>><?php echo $user->firstname, ' ', $user->lastname; ?></option>
                        <?php } ?> 
                    </select>
                </div>
            </div>

        </fieldset>
        <fieldset>
            <legend><?php echo $this->lang->line('contact'); ?></legend>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <textarea class="form-control required" name="address"><?php echo $school->address; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('postal_code'); ?>  <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="postal_code" value="<?php echo $school->postal_code; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'),' ',$this->lang->line('country'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="country_id" id="country_id">
                        <option value="" disabled><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?></option>
                        <?php
                        $country_name = $session->language . '_name';
                        foreach ($countries as $country) {
                            ?>
                            <option value="<?php echo $country->id; ?>" <?php echo ($school->country_id == $country->id) ? 'selected' : ''; ?>><?php echo $country->$country_name; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'),' ',$this->lang->line('state'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="state_id" id="state_id">
                        <option value="" disabled=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('state'); ?></option>
                        <?php
                        $state_name = $session->language . '_name';
                        foreach ($states as $state) {
                            ?>
                            <option value="<?php echo $state->id; ?>" <?php echo ($school->state_id == $state->id) ? 'selected' : ''; ?>><?php echo $state->$state_name; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'),' ',$this->lang->line('city'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="city_id" id="city_id">
                        <option value="" disabled><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                        <?php
                        $city_name = $session->language . '_name';
                        foreach ($cities as $city) {
                            ?>
                            <option value="<?php echo $city->id; ?>" <?php echo ($school->city_id == $city->id) ? 'selected' : ''; ?>><?php echo $city->$city_name; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #1 <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="phone_1" value="<?php echo $school->phone_1; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> #2 <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" name="phone_2" value="<?php echo $school->phone_2; ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="email" class="form-control required" name="email" value="<?php echo $school->email; ?>">
                </div>
            </div>
        </fieldset>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'school' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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