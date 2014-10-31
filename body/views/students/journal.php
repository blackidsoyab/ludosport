<?php $session = $this->session->userdata('user_session'); ?>
<script src="<?php echo JS_URL; ?>full-calendar.js"></script>
<script type="text/javascript">
    var monthNames = <?php echo json_encode($monthNames);?>;
    $(document).ready(function() {
        initCalender();
    });
</script>
<h1 class="page-heading h1"><?php echo $this->lang->line('journal'); ?></h1>

<div class="row">
    <div class="col-sm-12">
        <div class="the-box no-margin no-border padding-bottom-killer">
            <div class="row">
                <div class="col-lg-4 col-xs-12">
                    <span id="current-month-year" class="btn btn-primary"></span>
                </div>

                <div class="col-lg-4 col-xs-12">
                     <div class="progress-icon" style="display:none" align="center">
                        <i class="fa fa-cog fa-spin fa-2x text-primary"></i>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12">
                    <div class="btn-group pull-right">
                        <a href="javascript:;" class="btn btn-primary" id="prev-button"><i class="fa fa-chevron-left"></i></a>
                        <a href="javascript:;" class="btn btn-primary" id="today-button"><?php echo $this->lang->line('today'); ?></a>
                        <a href="javascript:;" class="btn btn-primary" id="next-button"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="the-box no-margin no-border padding-bottom-killer">
            <div class="row">
                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_past'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-info-danger" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_past_shif_on'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-warning-info" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_past_shif_of'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-success" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_present'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-success-danger" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_present_shif_on'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-warning-success" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_present_shif_of'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-inverse" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_future'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-inverse-danger" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_future_shif_on'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar badge-warning-inverse" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('clan_future_shif_of'); ?></span>
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress progress-striped">
                        <div class="progress-bar progress-bar-info" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('event_past'); ?></span>
                        </div>    
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress progress-striped">
                        <div class="col-xs-12 progress-bar progress-bar-success" style="width: 100%">
                            <span><?php echo $this->lang->line('event_current'); ?></span>    
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress progress-striped">
                        <div class="col-xs-12 progress-bar progress-bar-inverse" style="width: 100%">
                            <span><?php echo $this->lang->line('event_future'); ?></span>    
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="progress-bar fc-day badge-danger" role="progressbar" style="width: 100%">
                            <span><?php echo $this->lang->line('absence'); ?></span>
                        </div>    
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="col-xs-12 progress-bar fc-day badge-success" style="width: 100%">
                            <span><?php echo $this->lang->line('presence'); ?></span>    
                        </div>
                    </div>
                </div>

                <div class="col-xs-4 col-sm-2 col-md-2 col-lg-2">
                    <div class="progress">
                        <div class="col-xs-12 progress-bar fc-day badge-warning" style="width: 100%">
                            <span><?php echo $this->lang->line('recovery'); ?></span>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="the-box no-margin no-border">
            <input type="hidden" value="<?php echo get_current_date_time()->year; ?>" id="calendar-year">
            <input type="hidden" value="<?php echo get_current_date_time()->month - 1; ?>" id="calendar-month">
            <input type="hidden" value="<?php echo base_url().'class_details/'; ?>" id="calendar-event-src">
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>