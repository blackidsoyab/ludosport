<?php
$session = $this->session->userdata('user_session'); 
?>
<h1 class="page-heading">
    <?php
    if ($user->id != $session->id) {
        echo $user->firstname, ' ', $user->lastname, ' ', $this->lang->line('user');
    } else {
        echo $this->lang->line('my_profile');
    }
    ?>

</h1>

<div class="row">
    <div class="col-md-8">
        <div class="the-box transparent full margin-killer profile-heading">
        <?php if ($user->id == $session->id) { ?>
        <div class="right-action">
            <button class="btn btn-primary btn-square btn-xs"><?php echo $this->lang->line('change_cover'); ?></button>
        </div><!-- /.right-action -->
        <?php } ?>

        <img src="<?php echo IMG_URL; ?>user_cover/no-cover.jpg" class="bg-cover" alt="Image">
        <img src="<?php echo IMG_URL . 'user_avtar/100X100/' . $user->avtar; ?>" class="avatar" alt="Avatar">
        <div class="profile-info">
            <p class="user-name"><?php echo $user->firstname . ' ' . $user->lastname; ?></p>
            <p class="text-muted"><?php echo $this->lang->line('hometown'); ?>  : <a href="#fakelink"><?php echo getLocationName($user->city_id, 'City') . ', ' . getLocationName($user->state_id, 'State'); ?></a></p>
            <p class="right-button">
                <?php if ($user->id == $session->id) { ?>
                <?php if (hasPermission('profiles', 'editProfile')) { ?>
                <a href="<?php echo base_url() . 'profile/edit/' . $session->id; ?>" class="btn btn-primary btn-sm"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('profile'); ?></a>
                <?php } ?>
                <?php } ?>
            </p>
        </div><!-- /.profile-info -->
        </div>

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
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('full_name'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $user->firstname, ' ', $user->lastname ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('email'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo $user->email ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('role'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static">
                                        <?php
                                        $role_name = NULL;
                                        foreach (explode(',', $user->role_id) as $role) {
                                            $role_name .= ', ' . getRoleName($role);
                                        }

                                        echo substr($role_name, 2);
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('dob'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo date('d-m-Y', $user->date_of_birth); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('city'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo getLocationName($user->city_id, 'City'); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('state'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo getLocationName($user->state_id, 'State'); ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-3 control-label"><?php echo $this->lang->line('country'), ' : '; ?></label>
                                <div class="col-lg-8">
                                    <p class="form-control-static"><?php echo getLocationName($user->country_id, 'Country'); ?></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="the-box">
            <div class="row">
                <div class="col-xs-6 text-center">
                    <h4 class="small-heading" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('wins'), '/', $this->lang->line('defeat'); ?>"><?php echo $this->lang->line('wins'), '/', $this->lang->line('defeat'); ?></h4>
                    <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="80">
                        <span class="percent"></span>
                    </span>
                </div><!-- /.col-xs-6 -->
                <div class="col-xs-6 text-center">
                    <h4 class="small-heading overflow-hidden overflow-text-dot" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('attendance'), '/', $this->lang->line('absence'); ?>"><?php echo $this->lang->line('attendance'), '/', $this->lang->line('absence'); ?></h4>
                    <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="96">
                        <span class="percent"></span>
                    </span>
                </div><!-- /.col-xs-6 -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('wins'); ?></a></h4>
                </div><!-- /.tiles .dribbble-tile -->
            </div>
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('defeat'); ?></a></h4>
                </div>
            </div>
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('challenges_of'); ?></a></h4>
                </div><!-- /.tiles .facebook-tile -->
            </div>
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('challenges_recevied'); ?></a></h4>
                </div><!-- /.tiles .twitter-tile -->
            </div>
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('tournaments'); ?></a></h4>
                </div><!-- /.tiles .dribbble-tile -->
            </div>
            <div class="col-sm-3 col-xs-6 col-md-6">
                <div class="tiles dribbble-tile text-center">
                    <i class="fa fa-dribbble icon-lg-size"></i>
                    <h4><a href="#fakelink"><?php echo $this->lang->line('year_course'); ?></a></h4>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>