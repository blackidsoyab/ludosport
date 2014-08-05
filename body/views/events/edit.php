<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
<?php if ($event->event_for == 'ALL') { ?>
            $('#academies_list').hide();
            $('#schools_list').hide();
<?php } else if ($event->event_for == 'AC') { ?>
            $('#schools_list').hide();
<?php } else if ($event->event_for == 'SC') { ?>
            $('#academies_list').hide();
<?php } ?>
        $("#add").validate({
            rules: {
                date_to: { greaterThan: "#date_from" }
            },
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
        
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) > new Date($(params).val());
            }
            return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
        },'Must be greater than {0}');
        
        $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startDate: "<?php echo date('d-m-Y', strtotime(get_current_date_time()->get_date_for_db())) ?>",
            startView: 2,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        
        $("#event_for input[name='event_for']").click(function(){
            if($('input:radio[name=event_for]:checked').val() == "A"){
                $('#schools_list').hide();
                $('#academies_list').show();
            }
            
            if($('input:radio[name=event_for]:checked').val() == "S"){
                $('#schools_list').show();
                $('#academies_list').hide();
            }
            
            if($('input:radio[name=event_for]:checked').val() == "All"){
                $('#schools_list').hide();
                $('#academies_list').hide();
            }
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'event/edit/' . $event->id; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('event'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $event->{$key . '_name'} ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('event'), ' for '; ?></label>
            <div class="col-lg-5" id="event_for"> 
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="event_for" id="radios-1" value="All" <?php echo ($event->event_for == 'ALL') ? 'checked="checked"' : ''; ?>>
                    <?php echo $this->lang->line('all'); ?>
                </label>
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="event_for" id="radios-0" value="A" <?php echo ($event->event_for == 'AC') ? 'checked="checked"' : ''; ?>>
                    <?php echo $this->lang->line('academy'); ?>
                </label> 
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="event_for" id="radios-1" value="S" <?php echo ($event->event_for == 'SC') ? 'checked="checked"' : ''; ?>>
                    <?php echo $this->lang->line('school'); ?>
                </label>
            </div>
        </div>

        <div class="form-group" id="academies_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="academy_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?></option>
                    <?php
                    foreach ($academies as $academy) {
                        ?>
                        <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == @$academy_id) ? 'selected' : ''; ?>><?php echo ucwords($academy->{$session->language . '_academy_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group" id="schools_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="school_id[]" multiple="multiple">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?></option>
                    <?php
                    foreach ($schools as $school) {
                        ?>
                        <option value="<?php echo $school->id; ?>" <?php echo (in_array($school->id, explode(',', $event->school_id))) ? 'selected' : ''; ?>><?php echo ucwords($school->{$session->language . '_school_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('eventcategory'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="eventcategory_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('eventcategory'); ?></option>
                    <?php
                    foreach ($event_categories as $event_category) {
                        ?>
                        <option value="<?php echo $event_category->id; ?>" <?php echo ($event->eventcategory_id == $event_category->id) ? 'selected' : ''; ?>><?php echo ucwords($event_category->{$session->language . '_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="city_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                    <?php
                    foreach ($cities as $city) {
                        ?>
                        <option value="<?php echo $city->id; ?>" <?php echo ($event->city_id == $city->id) ? 'selected' : ''; ?>><?php echo ucwords($city->{$session->language . '_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('manager'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="manager[]" multiple="multiple">
                    <?php
                    foreach ($users as $user) {
                        ?>
                        <option value="<?php echo $user->id; ?>" <?php echo (in_array($user->id, explode(',', $event->manager))) ? 'selected' : ''; ?>><?php echo $user->name . ' [' . ucwords($user->{$session->language . '_role_name'}) . ']'; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('date_from'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date_from" id="date_from"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('date_from'); ?>" value="<?php echo date('d-m-Y', strtotime($event->date_from)) ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('date_to'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date_to" id="date_to"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('date_to'); ?>" value="<?php echo date('d-m-Y', strtotime($event->date_to)) ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control summernote-sm" name="description"><?php echo $event->description; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'event' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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