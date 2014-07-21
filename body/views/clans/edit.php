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
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?></h1>
<div class="the-box">
    <form id="manage" method="post" class="form-horizontal" action="<?php echo base_url() . 'clan/edit/' . $clan->id; ?>">

        <fieldset>
            <legend><?php echo $this->lang->line('main'); ?></legend>

            <?php foreach ($this->config->item('custom_languages') as $key => $value) { 
                $temp = $key .'_class_name';
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
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
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
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
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
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('instructor'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="instructor_id" id="instructor_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('instructor'); ?></option>
                        <?php
                        foreach ($instructors as $instructor) {
                            ?>
                            <option value="<?php echo $instructor->id; ?>" <?php echo ($clan->instructor_id == $instructor->id) ? 'selected' : ''; ?>><?php echo $instructor->firstname, ' ', $instructor->lastname; ?></option>
                        <?php } ?> 
                    </select>
                </div>
            </div>

        </fieldset>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
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