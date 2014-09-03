<?php $session = $this->session->userdata('user_session'); ?>
<script src="<?php echo JS_URL; ?>full-calendar.js"></script>
<script type="text/javascript">
    var monthNames = <?php echo json_encode($monthNames);?>;
    $(document).ready(function() {
        initCalender();
    });
</script>
<h1 class="page-heading"><?php echo $session->role_name; ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>

<div class="alert alert-primary alert-block square"><?php echo $this->lang->line('numbers'); ?></div>

<div class="row">
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('clan'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('clans', 'viewClan')) { ?>
                        <a href="<?php echo base_url() . 'clan' ?>"  data-toggle="tooltip" data-original-data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('clan'); ?>"><?php echo @$total_classes; ?></a>
                        <?php
                    } else {
                        echo @$total_classes;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('clans', 'addClan')) { ?>
                    <a href="<?php echo base_url() . 'clan/add' ?>" class="link" data-toggle="tooltip" data-original-data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?></a>
                    <?php
                } else {
                    echo '&nbsp;';
                }
                ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('students'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('clans', 'clanStudentList')) { ?>
                        <a href="<?php echo base_url() . 'clan/studentlist' ?>"  data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('students'); ?>"><?php echo @$total_students; ?></a>
                        <?php
                    } else {
                        echo @$total_students;
                    }
                    ?>
                </h1>
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" data-toggle="tooltip" data-original-data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
                    <?php
                } else {
                    echo '&nbsp;';
                }
                ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
</div>

<div class="alert alert-primary alert-block square">
        <span id="current-month-year"></span>
        <div class="btn-group pull-right">
            <a href="javascript:;" class="btn btn-primary" id="prev-button"><i class="fa fa-chevron-left"></i></a>
            <a href="javascript:;" class="btn btn-primary" id="today-button"><?php echo $this->lang->line('today'); ?></a>
            <a href="javascript:;" class="btn btn-primary" id="next-button"><i class="fa fa-chevron-right"></i></a>
        </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="the-box">
            <div class="progress-icon" style="display:none" align="center">
                <i class="fa fa-cog fa-spin fa-2x text-primary"></i>
            </div>
            <input type="hidden" value="<?php echo get_current_date_time()->year; ?>" id="calendar-year">
            <input type="hidden" value="<?php echo get_current_date_time()->month - 1; ?>" id="calendar-month">
            <input type="hidden" value="<?php echo base_url().'teacher/class_details/'; ?>" id="calendar-event-src">
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>