<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#step_1").hide();
        $("#step_2").hide();
        $("#step_3").hide();

        $('#request-trail-lesson').click(function(e) {
            e.preventDefault(); 
            $('#step_1').show();

            <?php if($change_only_date) { ?>
                loadTrailClan();
                $('.ludosport-class div.clan').trigger('click');
            <?php } else { ?>
                ChangeLocation(<?php echo $user_details->city_id; ?>);
            <?php } ?>
        });

        $('#reload-captcha').click(function(event) {
            event.preventDefault();
            $.ajax({
                url: http_host_js + 'reload_captcha',
                success: function(data) {
                    $('#captcha-image').html(data);
                }
            });
        });

        $("#trial_clan_selection").validate({
            rules: {
                captcha: {
                    remote: '<?php echo base_url() . "check_captcha?"; ?>' + $('input[name="captcha"]').val()
                },
            },
            messages: {
                captcha: {remote: '* <?php echo $this->lang->line("captcha_code_error"); ?>'}
            }
        });
    });

    function ChangeLocation(cityid) {
        $.ajax({
            type: 'POST',
            url: http_host_js + 'getclanonlocation/' + cityid,
            success: function(data) {
                $('#step_1 ul.dropdown-menu li.active').removeClass('active');
                $('.loc-'+cityid).addClass('active');

                $('.current-location-selected').empty();
                $('.current-location-selected').html($('#step_1 ul.dropdown-menu li.active').text());

                $('#step_1 .panel-body').empty();
                $('#step_1 .panel-body').html(data);
                loadTrailClan();

                $("#step_2").hide();
                $("#step_3").hide();
            }
        });
        PositionFooter();
    }

    function loadTrailClan(){
        $(".ludosport-class :radio").hide().click(function(e){
            e.stopPropagation();
        });

        $(".ludosport-class div.clan").click(function(e){
            PositionFooter();
            $(this).closest(".ludosport-class").find("div.the-box").removeClass("bg-primary");
            $(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
            
            val = $(".ludosport-class div.clan").find("div.bg-primary").attr("data-clan");
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getclandates/' + val,
                success: function(data)
                {
                    $("#step_2").show();
                    PositionFooter();
                    $('#clan_dates').empty();
                    $('#clan_dates').html(data);
                    PositionFooter();

                    $(".ludosport-class-date :radio").hide().click(function(e){
                        e.stopPropagation();
                    });
        
                    $(".ludosport-class-date div.clan-date").click(function(e){
                        $(this).closest(".ludosport-class-date").find("div.the-box").removeClass("bg-primary");
                        $(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
                        $("#step_3").show();
                        PositionFooter();
                    });
                }
            });
        });

        $('#step_3').click(function(e) {
            e.preventDefault(); 
            $('#trial_clan_selection').submit(); 
        });
    }
//]]>
</script>
<br />
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="the-box">
            <div class="blog-detail-image">
            <img src="<?php echo IMG_URL .'banner.png'; ?>" class="img-blog" alt="Banner">
            </div>
        </div>
    </div>
</div>

<?php if(isset($already_applied)) { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-<?php echo $type;?> fade in alert-dismissable">
                    <p class="text-center">
                        <?php echo $already_applied; ?>
                    </p>
            </div>
        </div>
    </div>   
<?php } ?>

<div class="row">
    <div class="col-lg-12 text-center">
        <a href="" class="btn btn-primary btn-perspective btn-lg" id="request-trail-lesson"><?php echo $this->lang->line('request_for_trail_lesson'); ?></a>
        <a href="<?php echo base_url() .'register/step_2'; ?>" class="btn btn-success btn-perspective btn-lg"><?php echo $this->lang->line('continue_registration_process'); ?></a>
    </div>
</div>

<form id="trial_clan_selection" action="<?php echo base_url() . 'pending_student/save_trial_lesson'; ?>" method="post">
    <input type="hidden" value="<?php echo $session->id ?>" name="student_id" />
    <div class="panel panel-primary" id="step_1">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-university"></i> <?php echo $this->lang->line('select_clan'); ?></h3>
            <?php if(!$change_only_date) { ?>
                <div class="right-content">
                    <div class="btn-group">
                        <div class="inline">
                            Current Location : <span class="text-black current-location-selected"></span>
                        </div>
                        <a href="#" class="dropdown-toggle mar-lt-10" data-toggle="dropdown"><?php echo $this->lang->line('change_location'); ?><b class="caret"></b></a>

                        <ul class="dropdown-menu pull-right margin-list" role="menu">
                            <?php foreach ($cities as $city) { ?>
                                <li class="<?php echo ($user_details->city_id == $city['id']) ? 'active loc-'.$city['id'] : 'loc-'.$city['id']; ?>"><a href="javascript:;" onclick="ChangeLocation(<?php echo $city['id']; ?>)" ><?php echo $city['city_name']; ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="panel-body ludosport-class">
            <div class="col-lg-4 col-xs-4 clan">
                <div class="the-box rounded text-center padding-killer margin-bottom-killer" data-clan="<?php echo @$clans->id; ?>">
                    <input type="radio" value="<?php echo @$clans->id; ?>" name="clan_id" />
                    <h4 class="light"><?php echo @$clans->{$session->language . '_class_name'}; ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-primary" id="step_2">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('select_date'); ?></h3>
        </div>

        <div class="panel-body ludosport-class-date" id="clan_dates">
        </div>
    </div>

    <div id="step_3">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                <span id="captcha-image"><?php echo $captcha_details['image']; ?></span>
                <br />
                <a id="reload-captcha" style="vertical-align: bottom">Reload Code</a>
                
            </div>
            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 form-horizontal">
                <input type="text" name="captcha" placeholder="<?php echo $this->lang->line('captcha_code_info'); ?>" class="form-control required">
            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <a class="btn btn-primary NextStep" id="btn-setp-2"><?php echo $this->lang->line('confirm'); ?><i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </div>
</form>