<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('#tiles-slide-2').length > 0){
            $("#tiles-slide-2").owlCarousel({
                navigation : false,
                pagination: false,
                slideSpeed : 1000,
                paginationSpeed : 400,
                singleItem:true,
                autoPlay: 3000,
                transitionStyle : 'backSlide',
                stopOnHover: true
            });
        }
    });
</script>
<h1 class="page-heading">
    <?php
        if ($profile->id != $session->id) {
            echo $profile->firstname, ' ', $profile->lastname, ' ', $this->lang->line('profile');
        } else {
            echo $this->lang->line('my_profile');
        }
    ?>
</h1>

<div class="row">
    <div class="custom-profile-view <?php echo(in_array(6, explode(',',$profile->role_id)))? 'col-md-8' : 'col-md-12'; ?>">
        <div class="the-box transparent full margin-killer profile-heading">
            <img src="<?php echo $cover_image; ?>" class="bg-cover" alt="Image">
            <img src="<?php echo IMG_URL . 'user_avtar/100X100/' . $profile->avtar; ?>" class="avatar" alt="Avatar">
            <div class="profile-info">
                <p class="user-name"><?php echo $profile->firstname . ' ' . $profile->lastname; ?></p>
                <p class="text-custom-primary overflow-hidden"><?php echo @$ac_sc_clan_name; ?></a></p>
                <p class="text-custom-primary"><?php echo @$batch_detail->{$session->language.'_name'}; ?></p>
                <p class="right-button">
                    <?php if ($profile->id == $session->id) { ?>
                    <?php if (hasPermission('profiles', 'editProfile')) { ?>
                    <a href="<?php echo base_url() . 'profile/edit/' . $session->id; ?>" class="btn btn-warning btn-sm"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('profile'); ?></a>
                    <?php } ?>
                    <?php } ?>
                </p>
            </div><!-- /.profile-info -->
        </div>

        <div class="panel with-nav-tabs panel-custom panel-square panel-no-border">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#panel-about" data-toggle="tab"><i class="fa fa-user"></i></a></li>
                </ul>
            </div>
            <div id="panel-collapse-1" class="collapse in">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="panel-about">
                            <h4 class="small-heading more-margin-bottom"><?php echo $this->lang->line('my_profile'); ?></h4>
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('full_name'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static"><?php echo $profile->firstname, ' ', $profile->lastname ?></p>
                                    </div>
                                </div>

                                <?php if($session->role < 6 || $profile->id == $session->id){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo $profile->email ?></p>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('nickname'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static"><?php echo $profile->username ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('clan'), ' ', $this->lang->line('city'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static"><?php echo getLocationName($profile->city_id, 'City'),', ', getLocationName($profile->state_id, 'State'), ', ', getLocationName($profile->country_id, 'Country'); ?></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('city_of_residence'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static"><?php echo $profile->city_of_residence; ?></p>
                                    </div>
                                </div>
                                

                                <?php if($session->role < 6 || $profile->id == $session->id){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('address'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo $profile->address; ?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('dob'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo date('d-m-Y', $profile->date_of_birth); ?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_no_1'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo $profile->phone_no_1; ?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('phone_no_2'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo $profile->phone_no_2; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>

                                <?php if(in_array(6, explode(',',$profile->role_id))){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('color_of_blade'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo colorOfBlades($userdetail->color_of_blade, $session->language); ?></p>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('pupil_since'), ' : '; ?></label>
                                        <div class="col-lg-8">
                                            <p class="form-control-static"><?php echo date('Y', strtotime($userdetail->timestamp)); ?></p>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('quote'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <?php if(!is_null($profile->quote) && !empty($profile->quote)) { ?>
                                            <p class="form-control-static">"<?php echo $profile->quote; ?>"</p>
                                        <?php } ?>
                                    </div>
                                </div>

                                <?php if($session->role < 6 || $profile->id == $session->id){ ?>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label"><?php echo $this->lang->line('about_me'), ' : '; ?></label>
                                        <div class="col-lg-8 text-justify">
                                            <p class="form-control-static"><?php echo $profile->about_me; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php if(in_array(6, explode(',',$profile->role_id))){ ?>
            <div class="the-box">
                <h3 class="panel-title"><strong><?php echo $this->lang->line('my_combat_style'); ?></strong></h3>
                <div class="">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php foreach ($evolution_batch_master as $master) { ?>
                                <img src="<?php echo $master['image']; ?>" alt="Avatar" class="seven-style-icon img-responsive img-circle" data-toggle="tooltip" title="" data-original-title="<?php echo $master[$session->language]; ?>">    
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="panel-title pull-left"><strong><?php echo $this->lang->line('timeline'); ?></strong></h3>
                    </div>
                </div>
                <ul class="timeline">
                    <li class="centering-line"></li>
                    <div id="timeline-data">
                    </div>
                </ul>

                <div align="center">
                    <button class="btn btn-warning btn-perspective text-center load_more" >Click here / Scroll down to load more <i class="padding-killer fa fa-long-arrow-down text-white"></i></button>
                </div>
                <div class="animation_image" style="display:none" align="center">
                    <i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
                </div>
            </div>
        </div>
    </div>

    <?php if(in_array(6, explode(',',$profile->role_id))){ ?>
        <div class="col-md-4">
            <div class="the-box no-border full transparent">
                <div id="tiles-slide-2" class="owl-carousel tiles-carousel">
                    <div class="item full">
                        <img src="<?php echo IMG_URL . 'color_of_blades/' .  colorOfBlades($userdetail->color_of_blade, 'image'); ?>" />
                    </div>
                </div>
            </div>

            <?php if ($student_degrees != false) { ?>
                <div class="panel panel-degree panel-square panel-no-border">
                    <div class="panel-heading">
                        <div class="right-content">
                            <button class="btn btn-degree to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-degree"><i class="fa fa-chevron-up"></i></button>
                        </div>
                        <h3 class="panel-title"><strong><?php echo $this->lang->line('degree'); ?></strong></h3>
                    </div>

                    <div id="panel-student-degree" class="collapse">
                        <div class="the-box no-border">
                            <?php foreach ($student_degrees as $degree) { ?>
                                <div class="media user-card-sm">
                                        <img class="pull-left media-object img-circle <?php echo ($userdetail->degree_id != $degree->id) ? (!is_null($degree->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $degree->image; ?>" alt="<?php echo $degree->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $degree->{$session->language . '_name'}; ?>">
                                    <div class="media-body">
                                        <h4 class="<?php echo ($userdetail->degree_id != $degree->id) ? (!is_null($degree->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $degree->{$session->language . '_name'}; ?></h4>
                                        <p class="text-danger"><?php echo (!is_null($degree->assign_date)) ? date('d/m/Y', strtotime($degree->assign_date)) : ''; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                     </div>
                </div>
            <?php } ?>

            <?php if ($student_securities != false) { ?>
                <div class="panel panel-security panel-square panel-no-border">
                        <div class="panel-heading">
                            <div class="right-content">
                                <button class="btn btn-security to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-security"><i class="fa fa-chevron-up"></i></button>
                            </div>
                            <h3 class="panel-title"><strong><?php echo $this->lang->line('security'); ?></strong></h3>
                        </div>

                        <div id="panel-student-security" class="collapse">
                            <div class="the-box no-border">
                                <?php foreach ($student_securities as $security) { ?>
                                    <div class="media user-card-sm">
                                        <img class="pull-left media-object img-circle <?php echo ($userdetail->security_id != $security->id) ? (!is_null($security->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $security->image; ?>" alt="<?php echo $security->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $security->{$session->language . '_name'}; ?>">
                                        <div class="media-body">
                                            <h4 class="<?php echo ($userdetail->security_id != $security->id) ? (!is_null($security->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $security->{$session->language . '_name'}; ?></h4>
                                            <p class="text-danger"><?php echo (!is_null($security->assign_date)) ? date('d/m/Y', strtotime($security->assign_date)) : ''; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                         </div>
                </div>
            <?php } ?>

            <?php if ($student_qualifications != false) { ?>
                <div class="panel panel-qualification panel-square panel-no-border">
                    <div class="panel-heading">
                        <div class="right-content">
                            <button class="btn btn-qualification to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-qualification"><i class="fa fa-chevron-up"></i></button>
                        </div>
                        <h3 class="panel-title"><strong><?php echo $this->lang->line('qualification'); ?></strong></h3>
                    </div>

                    <div id="panel-student-qualification" class="collapse">
                        <div class="the-box no-border">
                            <?php foreach ($student_qualifications as $qualification) { ?>
                                <div class="media user-card-sm">
                                   <img class="pull-left media-object img-circle <?php echo ($userdetail->qualification_id != $qualification->id) ? (!is_null($qualification->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $qualification->image; ?>" alt="<?php echo $qualification->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $qualification->{$session->language . '_name'}; ?>">
                                    <div class="media-body">
                                        <h4 class="<?php echo ($userdetail->qualification_id != $qualification->id) ? (!is_null($qualification->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $qualification->{$session->language . '_name'}; ?></h4>
                                        <p class="text-danger"><?php echo (!is_null($qualification->assign_date)) ? date('d/m/Y', strtotime($qualification->assign_date)) : ''; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                     </div>
                </div>
            <?php } ?>

            <?php if ($student_honours != false) { ?>
                <div class="panel panel-honour panel-square panel-no-border">
                        <div class="panel-heading">
                            <div class="right-content">
                                <button class="btn btn-honour to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-honour"><i class="fa fa-chevron-up"></i></button>
                            </div>
                            <h3 class="panel-title"><strong><?php echo $this->lang->line('honour'); ?></strong></h3>
                        </div>

                        <div id="panel-student-honour" class="collapse">
                            <div class="the-box no-border">
                                <?php foreach ($student_honours as $honour) { ?>
                                    <div class="media user-card-sm">
                                        <img class="pull-left media-object img-circle <?php echo ($userdetail->honour_id != $honour->id) ? (!is_null($honour->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $honour->image; ?>" alt="<?php echo $honour->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $honour->{$session->language . '_name'}; ?>">
                                        <div class="media-body">
                                            <h4 class="<?php echo ($userdetail->honour_id != $honour->id) ? (!is_null($honour->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $honour->{$session->language . '_name'}; ?></h4>
                                            <p class="text-danger"><?php echo (!is_null($honour->assign_date)) ? date('d/m/Y', strtotime($honour->assign_date)) : ''; ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                </div>
            <?php } ?> 
        
            <div class="row">
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'); ?>"><?php echo $total_victories; ?></h1>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'); ?>"><?php echo $this->lang->line('wins'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('defeat'); ?>"><?php echo $total_defeats; ?></h1>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('defeat'); ?>"><?php echo $this->lang->line('defeat'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_made'); ?>"><?php echo $total_made; ?></h1>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_made'); ?>"><?php echo $this->lang->line('challenges_made'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_recevied'); ?>"><?php echo $total_received; ?></h1>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_recevied'); ?>"><?php echo $this->lang->line('challenges_recevied'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <i class="fa fa-dribbble icon-lg-size"></i>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('tournaments'); ?>"><?php echo $this->lang->line('tournaments'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <i class="fa fa-dribbble icon-lg-size"></i>
                        <h4 class="" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('year_course'); ?>"><?php echo $this->lang->line('year_course'); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var track_load = 0;
        var loading  = false;
        var total_groups = <?php echo $per_page; ?>;

        $('#timeline-data').load('<?php echo base_url() . "history/load_more_timeline/$profile->id/0/"; ?>' + track_load , function() {track_load++;});

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()){
                if(track_load <= total_groups && loading==false)
                {
                    loading = true;
                    $('.animation_image').show();
                    $.post('<?php echo base_url() . "history/load_more_timeline/$profile->id/0/"; ?>' + track_load , function(data){
                        $("#timeline-data").append(data);
                        $('.animation_image').hide();
                        track_load++;
                        loading = false; 
                    }).fail(function(xhr, ajaxOptions, thrownError) {
                        $('.animation_image').hide();
                        loading = false;
                    });
                }
            }
        });

         $('.load_more').click(function(){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo base_url() . "history/load_more_timeline/$profile->id/0/"; ?>' + track_load , function(data){
                    $("#timeline-data").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false; 
                }).fail(function(xhr, ajaxOptions, thrownError) {
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        });
    });
</script>

<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>