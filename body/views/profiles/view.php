<?php $session = $this->session->userdata('user_session'); ?>
<!-- Begin page heading -->
<h1 class="page-heading">
    <?php
    if ($profile->id != $session->id) {
        echo $profile->firstname, ' ', $profile->lastname, ' ', $this->lang->line('profile');
    } else {
        echo $this->lang->line('my_profile');
    }
    ?>

</h1>
<!-- End page heading -->
<div class="row">
    <div class="col-md-8">
        <!-- BEGIN PROFILE HEADING -->
        <div class="the-box transparent full no-margin profile-heading">
            <?php if ($profile->id == $session->id) { ?>
                <div class="right-action">
                    <button class="btn btn-primary btn-square btn-xs">Change cover</button>
                </div><!-- /.right-action -->
            <?php } ?>

            <img src="<?php echo IMG_URL; ?>user_cover/no-cover.jpg" class="bg-cover" alt="Image">
            <img src="<?php echo IMG_URL . 'user_avtar/100X100/' . $profile->avtar; ?>" class="avatar" alt="Avatar">
            <div class="profile-info">
                <p class="user-name"><?php echo $profile->firstname . ' ' . $profile->lastname; ?></p>
                <p class="text-muted">Hometown : <a href="#fakelink"><?php echo getLocationName($profile->city_id, 'City') . ', ' . getLocationName($profile->state_id, 'State'); ?></a></p>
                <p class="right-button">
                    <?php if ($profile->id == $session->id) { ?>
                        <?php if (hasPermission('profiles', 'editProfile')) { ?>
                            <a href="<?php echo base_url() . 'profile/edit/' . $session->id; ?>" class="btn btn-primary btn-sm"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('profile'); ?></a>
                        <?php } ?>
                    <?php } ?>
                </p>
            </div><!-- /.profile-info -->
        </div><!-- /.the-box .transparent .profile-heading -->
        <!-- END PROFILE HEADING -->

        <div class="panel with-nav-tabs panel-primary panel-square panel-no-border">
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
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('full_name'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo $profile->firstname, ' ', $profile->lastname ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('email'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo $profile->email ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('role'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static">
                                            <?php
                                            $role_name = NULL;
                                            foreach (explode(',', $profile->role_id) as $role) {
                                                $role_name .= ', ' . getRoleName($role);
                                            }

                                            echo substr($role_name, 2);
                                            ?>
                                        </p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('dob'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo $profile->date_of_birth ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('city'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo getLocationName($profile->city_id, 'City'); ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('state'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo getLocationName($profile->state_id, 'State'); ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label"><?php echo $this->lang->line('country'); ?></label>
                                    <div class="col-sm-10">
                                        <p class="form-control-static"><?php echo getLocationName($profile->country_id, 'Country'); ?></p>
                                    </div>
                                </div><!-- /.form-group -->
                            </form>
                        </div><!-- /#panel-about -->
                    </div><!-- /.tab-content -->
                </div><!-- /.panel-body -->
            </div><!-- /.collapse in -->
        </div><!-- /.panel .panel-success -->

    </div><!-- /.col-md-8 -->

    <div class="col-md-4">

        <div class="the-box">
            <div class="row">
                <div class="col-xs-6 text-center">
                    <h4 class="small-heading"><?php echo $this->lang->line('wins'), '/', $this->lang->line('defeat'); ?></h4>
                    <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="80">
                        <span class="percent"></span>
                    </span>
                </div><!-- /.col-xs-6 -->
                <div class="col-xs-6 text-center">
                    <h4 class="small-heading"><?php echo $this->lang->line('attendance'), '/', $this->lang->line('absence'); ?></h4>
                    <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="96">
                        <span class="percent"></span>
                    </span>
                </div><!-- /.col-xs-6 -->
            </div><!-- /.row --></div><!-- /.row -->
        <div class="row">
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('wins'); ?></a></h4>
                </div><!-- /.tiles .dribbble-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('defeat'); ?></a></h4>
                </div><!-- /.tiles .linkedin-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('challenges_of'); ?></a></h4>
                </div><!-- /.tiles .facebook-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('challenges_recevied'); ?></a></h4>
                </div><!-- /.tiles .twitter-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('tournaments'); ?></a></h4>
                </div><!-- /.tiles .dribbble-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('year_course'); ?></a></h4>
                </div><!-- /.tiles .linkedin-tile -->
            </div><!-- /.col-sm-3 col-xs-6 col-md-6-->

        </div><!-- /.row -->
    </div><!-- /.col-md-4 -->
</div><!-- /.row -->

<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>