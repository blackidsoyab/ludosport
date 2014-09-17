<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate({
            rules: {
                username: {remote: '<?php echo base_url() . 'checkusername/' . $profile->id; ?>'},
                email: {remote: '<?php echo base_url() . 'checkemail/' . $profile->id; ?>'}
            },
            messages: {
                username: {remote: '* Username already exit'},
                email: {remote: '* Email already exit'}
            },
            errorPlacement: function(error, element){
                if(element.attr("type") == "checkbox"){
                    $('#chkerror').show();
                    $('#chkerror').html(error);
                }else{
                    error.insertAfter(element);
                }
            }
        });        
        
        $('.datepicker').datepicker().on('changeDate', function (ev) {
            $(this).datepicker('hide');
        });
        
        $('.summernote-sm').summernote({
            height: 200
        });
    });
    //]]>
</script>
<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('profile'); ?></h1>
<div class="the-box">
    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'profile/edit/' . $profile->id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('avtar'); ?></label>
            <div class="col-lg-8">
                <div class=" input-group">
                    <input type="text" class="form-control" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?>  <input type="file" name="avtar">
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('firstname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="firstname"  class=" form-control required" placeholder="<?php echo $this->lang->line('firstname'); ?>"  value="<?php echo $profile->firstname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('lastname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="lastname"  class=" form-control required" placeholder="<?php echo $this->lang->line('lastname'); ?>" value="<?php echo $profile->lastname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('email'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="email" name="email"  class=" form-control required" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php echo $profile->email; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('dob'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="date_of_birth"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('dob'); ?>" style="border-radius: 0px;"  data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', $profile->date_of_birth); ?>" />
            </div>
        </div>
        
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('city_of_residence'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="city_of_residence"  class="form-control required" placeholder="<?php echo $this->lang->line('city_of_residence'); ?>"  value="<?php echo $profile->city_of_residence; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('city'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-8">
                <select class="form-control required" name="city_id" id="city_id">
                    <option value="" disabled><?php echo $this->lang->line('select'), ' ', $this->lang->line('city'); ?></option>
                    <?php
                    $city_name = $session->language . '_name';
                    foreach ($cities as $city) {
                        ?>
                        <option value="<?php echo $city->id; ?>" <?php echo ($profile->city_id == $city->id) ? 'selected' : ''; ?>><?php echo $city->$city_name; ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('nickname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="username"  class=" form-control required" placeholder="<?php echo $this->lang->line('nickname'); ?>" value="<?php echo $profile->username; ?>"/>
            </div>
        </div>

        <?php if(in_array(6, explode(',',$profile->role_id))){ ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('color_of_blade'); ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select class="form-control required" name="color_of_blade" id="color_of_blade">
                        <?php
                        foreach (colorOfBlades() as $blade_key => $blade_value) {
                            ?>
                            <option value="<?php echo $blade_key; ?>" <?php echo ($userdetail->color_of_blade == $blade_key) ? 'selected' : ''; ?>><?php echo $blade_value[$session->language]; ?></option>
                        <?php } ?>     
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo $this->lang->line('palce_of_birth'); ?>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                    <input type="text" name="palce_of_birth"  class=" form-control" placeholder="<?php echo $this->lang->line('palce_of_birth'); ?>" value="<?php echo $userdetail->palce_of_birth; ?>"/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('zip_code'); ?>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                    <input type="text" name="zip_code"  class=" form-control" placeholder="<?php echo $this->lang->line('zip_code'); ?>" value="<?php echo $userdetail->zip_code; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('tax_code'); ?>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                    <input type="text" name="tax_code"  class=" form-control" placeholder="<?php echo $this->lang->line('tax_code'); ?>" value="<?php echo $userdetail->tax_code; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo $this->lang->line('blood_group'); ?>
                    <span class="text-danger">*</span>
                </label>
                <div class="col-lg-8">
                    <input type="text" name="blood_group"  class=" form-control" placeholder="<?php echo $this->lang->line('blood_group'); ?>" value="<?php echo $userdetail->blood_group; ?>"/>
                </div>
            </div>

        <?php } ?>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('address'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-8">
                <textarea name="address" class=" form-control"><?php echo $profile->address; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('phone_no_1'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-8">
                <input type="text" name="phone_no_1"  class=" form-control" placeholder="<?php echo $this->lang->line('phone_no_1'); ?>" value="<?php echo $profile->phone_no_1; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('phone_no_2'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-8">
               <input type="text" name="phone_no_2"  class=" form-control" placeholder="<?php echo $this->lang->line('phone_no_2'); ?>" value="<?php echo $profile->phone_no_2; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('quote'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-8">
                <textarea name="quote" class=" form-control"><?php echo $profile->quote; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('about_me'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-8">
                <textarea name="about_me" class=" form-control summernote-sm"><?php echo $profile->about_me; ?></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-8">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'profile' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-8">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>