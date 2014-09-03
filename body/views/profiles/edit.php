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
<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('profile'); ?></h1>
<div class="the-box">
    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'profile/edit/' . $profile->id; ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('avtar'); ?></label>
            <div class="col-lg-5">
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
            <div class="col-lg-5">
                <input type="text" name="firstname"  class=" form-control required" placeholder="<?php echo $this->lang->line('firstname'); ?>"  value="<?php echo $profile->firstname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('lastname'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="lastname"  class=" form-control required" placeholder="<?php echo $this->lang->line('lastname'); ?>" value="<?php echo $profile->lastname; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('email'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="email" name="email"  class=" form-control required" placeholder="<?php echo $this->lang->line('email'); ?>" value="<?php echo $profile->email; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('dob'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <input type="text" name="date_of_birth"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('dob'); ?>" style="border-radius: 0px;"  data-date-format="dd-mm-yyyy" value="<?php echo date('d-m-Y', $profile->date_of_birth); ?>" />
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
                        <option value="<?php echo $country->id; ?>" <?php echo ($profile->country_id == $country->id) ? 'selected' : ''; ?>><?php echo $country->$country_name; ?></option>
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
                        <option value="<?php echo $state->id; ?>" <?php echo ($profile->state_id == $state->id) ? 'selected' : ''; ?>><?php echo $state->$state_name; ?></option>
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
            <div class="col-lg-5">
                <input type="text" name="username"  class=" form-control required" placeholder="<?php echo $this->lang->line('nickname'); ?>" value="<?php echo $profile->username; ?>"/>
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'profile' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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