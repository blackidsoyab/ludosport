<?php $session = $this->session->userdata('user_session'); ?>
<script>

    //<![CDATA[
    $(document).ready(function() {
        $("#register-form").validate({
            ignore: "",
            errorPlacement: function(error, element){
                if(element.attr("type") == "radio"){
                    console.log(element);
                    $(element).closest('#school-lists').prepend(error);
                    $(element).closest('#clans-lists').find('h4').after(error);
                }else{
                    error.insertAfter(element);
                }
            }
        });
        
        $.validator.addMethod("nowhitespace", function(value, element) {
            return this.optional(element) || /^\S+$/i.test(value);
        }, "* Space is not allowed");

        $('input[name="school_id"]').on('ifChecked', function(event){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>register/step_2/clan_ajax/'+this.value,
                success: function(data){
                    $('#clans-lists').empty();
                    $('#clans-lists').show();
                    $('#clans-lists').append(data);
                    $('#clans-lists').find('input').iCheck({radioClass: 'iradio_flat-grey'});
                    $('#register-form input[name="clan_id"]').rules('add', {
                        required:true,
                        messages: {
                            required: "* This filed is required"
                        }
                    });
                }
            });
        });

        <?php if($user_details != false) { ?>
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>register/step_2/clan_ajax/'+<?php echo $clan_details->school_id; ?>,
                success: function(data){
                    $('#clans-lists').empty();
                    $('#clans-lists').show();
                    $('#clans-lists').append(data);
                    $('#clans-lists').find('input').iCheck({radioClass: 'iradio_flat-grey'});
                    $('input[name="clan_id"]').rules('add', {
                        required:true,
                        messages: {
                            required: "* This filed is required"
                        }
                    });
                }
            });
        <?php } ?>
    });
    //]]>
</script>
<div class="row">
    <div class="col-lg-6">
        <h1 class="page-heading"><?php echo $this->lang->line('register'), ' ', $this->lang->line('step'), ' 2'; ?></h1>
    </div>
</div>
<div class="the-box">
    <p><?php echo $this->lang->line('text_second_step_registration'); ?></p>
</div>
<div class="row">
    <div class="col-lg-6">
        <form id="register-form" method="post" action="<?php echo base_url() . 'register/step_2'; ?>">
            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="palce_of_birth" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('palce_of_birth'); ?>" value="<?php echo @$user_details->palce_of_birth; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="number" name="zip_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('zip_code'); ?>" value="<?php echo @$user_details->zip_code; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="number" name="tax_code" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('tax_code'); ?>" value="<?php echo @$user_details->tax_code; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback lg left-feedback no-label">
                <input type="text" name="blood_group" class="form-control no-border input-lg rounded required" placeholder="<?php echo $this->lang->line('blood_group'); ?>" value="<?php echo @$user_details->blood_group; ?>">
                <span class="fa fa-male form-control-feedback"></span>
            </div>

            <div class="the-box">
                <h4 class="margin-killer">School Selection</h4>
                <hr class="mar-10 margin-left-killer margin-right-killer" />
                <div id="school-lists" class="inline-popups">
                    <?php foreach ($schools as $school) { ?>
                        <div class="radio padding-left-killer">
                            <label>
                                <input type="radio" class="i-grey-flat required" value="<?php echo $school->id; ?>" name="school_id" <?php echo (@$clan_details->school_id == $school->id) ? 'checked' : ''; ?>>&nbsp;<?php echo $school->{$session->language.'_school_name'}; ?>
                                </label>
                                <a href="#<?php echo 'school_detail_'.$school->id; ?>" data-effect="mfp-zoom-in" class="pull-right">Check Details</a>
                        </div>
                        <hr class="margin-killer" />
                        <div id="<?php echo 'school_detail_'.$school->id; ?>" class="white-popup mfp-with-anim mfp-hide">
                            <div class="table-responsive">
                                <h3>Detail of <?php echo $school->{$session->language.'_school_name'}; ?></h3>
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td><?php echo $this->lang->line('address'); ?> :</td>
                                            <td><?php echo $school->address; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('postal_code'); ?> :</td>
                                            <td><?php echo $school->postal_code; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('location'); ?> :</td>
                                            <td><?php echo getLocationName($school->city_id, 'City'),', ', getLocationName($school->state_id, 'State'),', ',getLocationName($school->country_id, 'Country'); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('phone_number'); ?>#1 :</td>
                                            <td><?php echo $school->phone_1; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('phone_number'); ?>#2 :</td>
                                            <td><?php echo $school->phone_2; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo $this->lang->line('email'); ?> :</td>
                                            <td><?php echo $school->email; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php } ?>     
                </div>
            </div>
            
            <div id="clans-lists" class="the-box inline-popups" style="display:none">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-warning btn-lg btn-perspective btn-block" title="<?php echo $this->lang->line('subscribe'); ?>"><?php echo $this->lang->line('subscribe'); ?></button>
            </div>
        </form>
    </div>

    <?php if($download_pdfs) { ?>
        <div class="col-lg-6">
        <h1 class="page-heading padding-killer margin-top-killer"><?php echo $this->lang->line('download_pdf'); ?></h1>
            <ul class="list-group">
                <?php foreach ($download_pdfs as $pdf_value) {
                            echo '<li class="list-group-item">' . $pdf_value[$session->language] .'<a href="'.base_url() .'register_step_2/download/'. $pdf_value['file'] .'" class="pull-right">'.$this->lang->line('download').'</a></li>';
                        }
                    ?>
            </ul>
        </div>
    <?php } ?>
</div>