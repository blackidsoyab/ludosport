<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading">
    <?php echo $this->lang->line('evolution_clan_request'); ?>
</h1>
<div class="row">
    <div class="col-md-12">
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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="col-sm-12 text-center">
                                        <?php
                                        if ($request_detail->status == 'A') {
                                            echo '&nbsp;&nbsp;<label class="label label-success">&nbsp;' . $this->lang->line('accepted_evolution_clan_request') . '&nbsp;</label>&nbsp;&nbsp;';
                                        } if ($request_detail->status == 'U') {
                                            echo '&nbsp;&nbsp;<label class="label label-danger">&nbsp;' . $this->lang->line('rejected_evolution_clan_request') . '&nbsp;</label>&nbsp;&nbsp;';
                                        }

                                        if($request_detail->approved_by != 0){
                                            $username = userNameAvtar($request_detail->approved_by);
                                            echo 'by&nbsp;&nbsp;', $username['name'];
                                        }

                                        if($show_approved_button) {
                                            ?>
                                            <span>&nbsp;&nbsp;</span>
                                            <form action="<?php base_url() . 'evolutionclan/check_request/' . $request_detail->id; ?>" method="post" class="inline form-horizontal">
                                                <input type="hidden" value="A" name="status" />
                                                <button type="submit" class="btn btn-success"><?php echo $this->lang->line('accept_evolution_clan_request'); ?></button>
                                            </form>
                                            <?php
                                        }

                                        if($show_unapproved_button){ 
                                            ?>
                                            <span>&nbsp;&nbsp;</span>
                                            <form action="<?php base_url() . 'evolutionclan/check_request/' . $request_detail->id; ?>" method="post" class="inline form-horizontal">
                                                <input type="hidden" value="U" name="status" />
                                                <button type="submit" class="btn btn-danger"><?php echo $this->lang->line('reject_evolution_clan_request'); ?></button>
                                            </form>
                                            <?php 
                                        } 
                                            ?>
                                        </div>
                                    </div>
                                    <hr class="bg-success"/>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-center text-primary"><?php echo $this->lang->line('profile'); ?></h4>
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('full_name'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo $profile->firstname, ' ', $profile->lastname ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('email'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo $profile->email ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('dob'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo date('d-m-Y', $profile->date_of_birth); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('city'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($profile->city_id, 'City'); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('state'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($profile->state_id, 'State'); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($profile->country_id, 'Country'); ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="text-center text-primary"><?php echo $this->lang->line('clan'); ?></h4>
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('clan'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo $clan->{$session->language . '_class_name'}; ?></p>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('time_from'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo date('H.i a', $clan->lesson_from); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('time_to'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo date('H.i a', $clan->lesson_to); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('city'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($clan->city_id, 'City'); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('state'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($clan->state_id, 'State'); ?></p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo $this->lang->line('country'); ?></label>
                                            <div class="col-sm-9">
                                                <p class="form-control-static"><?php echo getLocationName($clan->country_id, 'Country'); ?></p>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>