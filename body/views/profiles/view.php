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
                <p class="text-custom-primary"><?php echo @$ac_sc_clan_name; ?></a></p>
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
                    <?php if($profile->role_id == 6 && isset($userdetail) && !empty($userdetail)) { ?>  
                        <li><a href="#panel-extra-details" data-toggle="tab"><i class="fa fa-bell"></i></a></li>
                    <?php } ?>
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
                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'), ' : '; ?></label>
                                    <div class="col-lg-8">
                                        <p class="form-control-static"><?php echo $profile->email ?></p>
                                    </div>
                                </div>
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

                                <div class="form-group">
                                    <label class="col-lg-3 control-label"><?php echo $this->lang->line('about_me'), ' : '; ?></label>
                                    <div class="col-lg-8 text-justify">
                                        <p class="form-control-static"><?php echo $profile->about_me; ?></p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane fade" id="panel-extra-details">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label"><?php echo $this->lang->line('palce_of_birth'), ' : '; ?></label>
                                    <div class="col-lg-7">
                                        <p class="form-control-static"><?php echo $userdetail->palce_of_birth; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-5 control-label"><?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('zip_code'), ' : '; ?></label>
                                    <div class="col-lg-7">
                                        <p class="form-control-static"><?php echo $userdetail->zip_code; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-5 control-label"><?php echo $this->lang->line('city_of_residence'), ' ', $this->lang->line('by'), ' ',$this->lang->line('tax_code'), ' : '; ?></label>
                                    <div class="col-lg-7">
                                        <p class="form-control-static"><?php echo $userdetail->tax_code; ?></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-5 control-label"><?php echo $this->lang->line('blood_group'), ' : '; ?></label>
                                    <div class="col-lg-7">
                                        <p class="form-control-static"><?php echo $userdetail->blood_group; ?></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
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

            <div class="the-box">
                <div class="row">
                    <div class="col-xs-6 text-center">
                        <h4 class="small-heading" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'), '/', $this->lang->line('defeat'); ?>"><?php echo $this->lang->line('wins'), '/', $this->lang->line('defeat'); ?></h4>
                        <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="<?php echo @$victories_percentage; ?>">
                            <span class="percent"><?php echo @$victories_percentage; ?></span>
                        </span>
                    </div>
                    <div class="col-xs-6 text-center">
                        <h4 class="small-heading overflow-hidden overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('attendance'), '/', $this->lang->line('absence'); ?>"><?php echo $this->lang->line('attendance'), '/', $this->lang->line('absence'); ?></h4>
                        <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="<?php echo @$attendance_percentage; ?>">
                            <span class="percent"><?php echo @$attendance_percentage; ?></span>
                        </span>
                    </div>
                </div>
            </div>
        
            <div class="row">
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'); ?>"><?php echo $total_victories; ?></h1>
                        <h4 class="overflow-hidden nowrap overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'); ?>"><?php echo $this->lang->line('wins'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('defeat'); ?>"><?php echo $total_defeats; ?></h1>
                        <h4 class="overflow-hidden nowrap overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('defeat'); ?>"><?php echo $this->lang->line('defeat'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_made'); ?>"><?php echo $total_made; ?></h1>
                        <h4 class="overflow-hidden nowrap overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_made'); ?>"><?php echo $this->lang->line('challenges_made'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <h1 class="bolded less-distance" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_recevied'); ?>"><?php echo $total_received; ?></h1>
                        <h4 class="overflow-hidden nowrap overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('challenges_recevied'); ?>"><?php echo $this->lang->line('challenges_recevied'); ?></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <i class="fa fa-dribbble icon-lg-size"></i>
                        <h4 class="overflow-hidden nowrap overflow-text-dot"><a href="#fakelink" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('tournaments'); ?>"><?php echo $this->lang->line('tournaments'); ?></a></h4>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6 col-md-6">
                    <div class="tiles dribbble-tile text-center">
                        <i class="fa fa-dribbble icon-lg-size"></i>
                        <h4 class="overflow-hidden nowrap overflow-text-dot"><a href="#fakelink" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('year_course'); ?>"><?php echo $this->lang->line('year_course'); ?></a></h4>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>