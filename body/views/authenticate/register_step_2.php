<script>
    $('#chkerror').hide();
    //<![CDATA[
    $(document).ready(function() {
        $("#register-form").validate({
            errorPlacement: function(error, element){
                if(element.attr("type") == "checkbox"){
                    $('#chkerror').show();
                    $('#chkerror').html(error);
                }else{
                    error.insertAfter(element);
                }
            }
        });
        
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "* Space is not allowed");

    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('register'), ' ', $this->lang->line('step'), ' 2'; ?></h1>

<div class="row">
    <div class="col-lg-6">
        <form id="register-form" method="post" action="<?php echo base_url() . 'register/step_2'; ?>">
            <div class="form-group has-feedback lg left-feedback no-label">
                <select class="form-control no-border input-lg rounded required" name="palce_of_birth">
                    <option value=""><?php echo $this->lang->line('palce_of_birth'); ?></option>
                    <?php foreach ($cities as $city) { ?>
                        <option value="<?php echo $city->id; ?>"><?php echo $city->en_name; ?></option>
                    <?php } ?>
                </select>
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="zip_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('zip_code'); ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="tax_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('tax_code'); ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="blood_group" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('blood_group'); ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('enter'); ?>"><?php echo $this->lang->line('enter'); ?></button>
            </div>
        </form>
    </div>
</div>