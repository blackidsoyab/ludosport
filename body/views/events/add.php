<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[

    function readImage(file) {
        var reader = new FileReader();
        var image  = new Image();
        reader.readAsDataURL(file);  
        reader.onload = function(_file) {
            image.src    = _file.target.result;
            image.onload = function() {
                //$('#temp-img').attr('src', image.src);
                $('#event-img-height').val(this.height);
                $('#event-img-width').val(this.width);
            };     
        };
    }

    $(document).ready(function() {
        $('#academies_list').hide();
        $('#schools_list').hide();

        $("#event_image").change(function (e) {
            if(this.disabled) return alert('File upload not supported!');
            var F = this.files;
            if(F && F[0]) {
                for(var i=0; i<F.length; i++){
                  readImage(F[0]);  
                }
            }
        });
        
        $("#add").validate({
            rules: {
                date_to: { greaterThan: "#date_from" },
                event_image : {
                    ImageDimension: ['width','750']
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                } else if(element.attr('type') == 'file'){
                    error.appendTo(element.parent().parent().parent().parent());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        jQuery.validator.addMethod("ImageDimension", function(value, element, params) {
                 if(params[0] == 'width'){
                    return (Number($('#event-img-width').val()) > Number(params[1]));
                 } else {
                    return (Number($('#event-img-height').val()) > Number(params[1]));
                 }    
        },'Image {0} must greater than {1}px');
        
        jQuery.validator.addMethod("greaterThan", function(value, element, params) {

            if (!/Invalid|NaN/.test(new Date(value))) {
                return new Date(value) >= new Date($(params).val());
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
                $(".academies-list").chosen();
            }
            
            if($('input:radio[name=event_for]:checked').val() == "S"){
                $('#schools_list').show();
                $(".school-list").chosen();
                $('#academies_list').hide();
            }
            
            if($('input:radio[name=event_for]:checked').val() == "All"){
                $('#schools_list').hide();
                $('#academies_list').hide();
            }
        });

        $('#manager-selected-list-div').hide();

        $('#getRoleUsers').change(function(){
             $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>ajax/gerUserByRoleID/' + $('#getRoleUsers').val(),
                success: function(data)
                {
                    $('#managers').empty();
                    $('#managers').append(data);
                }
            });
        });

        $( "#managers" ).change(function() {
                $('#manager-selected-list-div').show();
                $( "#selected-manager-list" ).append('<li class="search-choice"><span>'+ $( "#managers :selected" ).text() +'</span><a class="search-choice-close" data-option-array-index="'+ $( "#managers" ).val() +'"></a><input type="hidden" name="manager[]" value="'+ $( "#managers" ).val() +'"></a></li>');
        });

        $('.chosen-choices').on('click', 'a.search-choice-close', function (event) {
            $(this).closest( "li" ).remove();

            if($('.chosen-choices').find('li').length == 0){
                $('#manager-selected-list-div').hide();
            }
        });

        $('.summernote-sm').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'event/add'; ?>" enctype="multipart/form-data">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('event'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('image'); ?>&nbsp;<span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <div class=" input-group">
                    <input type="text" class="form-control required" readonly="">
                    <span class="input-group-btn">
                        <span class="btn btn-default btn-file">
                            <?php echo $this->lang->line('browse_file'); ?> <input type="file" name="event_image" id="event_image">
                        </span>
                    </span>
                </div>
                <?php
                if ($this->session->flashdata('file_errors')) {
                    echo '<label class="error">' . $this->session->flashdata('file_errors') . '</label>';
                }
                ?>
            </div>
            <input type="hidden" value="0" id="event-img-height">
            <input type="hidden" value="0" id="event-img-width">
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('event'), ' for '; ?></label>
            <div class="col-lg-5" id="event_for"> 
                <label class="radio-inline" for="radios-0">
                    <input type="radio" name="event_for" id="radios-0" value="All"  checked="checked">
                    <?php echo $this->lang->line('all'); ?>
                </label>
                <label class="radio-inline" for="radios-1">
                    <input type="radio" name="event_for" id="radios-1" value="A">
                    <?php echo $this->lang->line('academy'); ?>
                </label> 
                <label class="radio-inline" for="radios-2">
                    <input type="radio" name="event_for" id="radios-2" value="S">
                    <?php echo $this->lang->line('school'); ?>
                </label>
            </div>
        </div>

        <div class="form-group" id="academies_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required academies-list" name="academy_id" data-placeholder="<?php echo $this->lang->line('select'), ' ', $this->lang->line('academy'); ?>">
                    <?php
                    foreach ($academies as $academy) {
                        ?>
                        <option value="<?php echo $academy->id; ?>"><?php echo ucwords($academy->{$session->language . '_academy_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group" id="schools_list">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required school-list" name="school_id[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select'), ' ', $this->lang->line('school'); ?>">
                    <?php
                    foreach ($schools as $school) {
                        ?>
                        <option value="<?php echo $school->id; ?>"><?php echo ucwords($school->{$session->language . '_school_name'}); ?></option>
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
                        <option value="<?php echo $event_category->id; ?>"><?php echo ucwords($event_category->{$session->language . '_name'}); ?></option>
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
                        <option value="<?php echo $city->id; ?>"><?php echo ucwords($city->{$session->language . '_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('role'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="role" id="getRoleUsers">
                <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('role'); ?></option>
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?php echo $role->id; ?>"><?php echo  ucwords($role->{$session->language . '_role_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('manager'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" id="managers"></select>
            </div>
        </div>

        <div class="form-group" id="manager-selected-list-div">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5 chosen-container chosen-container-multi" >
                <ul class="chosen-choices" id="selected-manager-list">
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('date_from'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date_from" id="date_from"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('date_from'); ?>" readonly/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('date_to'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date_to" id="date_to"  class="form-control required datepicker" placeholder="<?php echo $this->lang->line('date_to'); ?>" readonly/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control summernote-sm" name="description"></textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
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