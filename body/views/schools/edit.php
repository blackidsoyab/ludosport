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
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('role_assign_association'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="dean_id[]" multiple="multiple">
                        <?php foreach ($users as $user) { ?>
                            <option value="<?php echo $user->id; ?>" <?php echo (in_array($user->id, explode(',', $school->dean_id))) ? 'selected' : ''; ?>><?php echo $user->firstname, ' ', $user->lastname; ?></option>
<?php } ?> 
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('range'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" name="range" value="<?php echo $school->range; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="address" value="<?php echo $school->address; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('postal_code'); ?>  <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="postal_code" value="<?php echo $school->postal_code; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <select class="form-control required" name="city_id" id="city_id">
                        <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
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
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('mobile_number'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control required" name="mobile" value="<?php echo $school->mobile; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_number'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" name="phone" value="<?php echo $school->phone; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-5">
                    <input type="email" class="form-control required" name="email" value="<?php echo $school->email; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('information'); ?> <span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <textarea class="summernote-sm" name="information"><?php echo $school->information; ?></textarea>
                </div>
            </div>

        </fieldset>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'school' ?>" class="btn btn-default" title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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