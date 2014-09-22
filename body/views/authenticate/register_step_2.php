<?php $session = $this->session->userdata('user_session'); ?>
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
<div class="row">
    <div class="col-lg-6">
        <h1 class="page-heading"><?php echo $this->lang->line('register'), ' ', $this->lang->line('step'), ' 2'; ?></h1>
    </div>

    <?php if($download_pdfs) { ?>
        <div class="col-lg-6">
            <h1 class="page-heading"><?php echo $this->lang->line('download_pdf'); ?></h1>
        </div>
    <?php } ?>
</div>

<div class="row">
    <div class="col-lg-6">
        <form id="register-form" method="post" action="<?php echo base_url() . 'register/step_2'; ?>">
            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="palce_of_birth" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('palce_of_birth'); ?>" value="<?php echo $user_details->palce_of_birth; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="zip_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('zip_code'); ?>" value="<?php echo $user_details->zip_code; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="tax_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('tax_code'); ?>" value="<?php echo $user_details->tax_code; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="blood_group" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('blood_group'); ?>" value="<?php echo $user_details->blood_group; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('enter'); ?>"><?php echo $this->lang->line('enter'); ?></button>
            </div>
        </form>
    </div>

    <?php if($download_pdfs) { ?>
        <div class="col-lg-6">
            <ul class="list-group">
                <?php foreach ($download_pdfs as $pdf_value) {
                            echo '<li class="list-group-item">' . $pdf_value[$session->language] .'<a href="'.base_url() .'register_step_2/download/'. $pdf_value['file'] .'" class="pull-right">'.$this->lang->line('download').'</a></li>';
                        }
                    ?>
            </ul>
        </div>
    <?php } ?>
</div>