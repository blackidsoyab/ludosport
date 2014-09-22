<?php $session = $this->session->userdata('user_session'); ?>
<script src="<?php echo JS_URL; ?>full-calendar.js"></script>
<script type="text/javascript">
    var monthNames = <?php echo json_encode($monthNames);?>;
    $(document).ready(function() {
        initCalender();
    });
</script>
<h1 class="page-heading"><?php echo $session->role_name; ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
<div class="alert alert-primary alert-block square"><?php echo $this->lang->line('numbers'); ?></div>

<div class="row">
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('schools'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('schools', 'viewSchool')) { ?>
                        <a href="<?php echo base_url() . 'school' ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('school'); ?>"><?php echo @$total_schools; ?></a>
                        <?php
                    } else {
                        echo @$total_schools;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('schools', 'addSchool')) { ?>
                    <a href="<?php echo base_url() . 'school/add' ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?></a>
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
                <p><?php echo $this->lang->line('teachers'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('clans', 'clanTeacherList')) { ?>
                        <a href="<?php echo base_url() . 'clan/teacherlist' ?>"  data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('teachers'); ?>"><?php echo @$total_instructors; ?></a>
                        <?php
                    } else {
                        echo @$total_instructors;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
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
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
<?php
} else {
    echo '&nbsp;';
}
?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="the-box no-margin no-border padding-bottom-killer">
            <div class="row">
                <div class="col-sm-4">
                    <span id="current-month-year" class="btn btn-primary"></span>
                </div>

                <div class="col-sm-4">
                     <div class="progress-icon" style="display:none" align="center">
                        <i class="fa fa-cog fa-spin fa-2x text-primary"></i>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="btn-group pull-right">
                        <a href="javascript:;" class="btn btn-primary" id="prev-button"><i class="fa fa-chevron-left"></i></a>
                        <a href="javascript:;" class="btn btn-primary" id="today-button"><?php echo $this->lang->line('today'); ?></a>
                        <a href="javascript:;" class="btn btn-primary" id="next-button"><i class="fa fa-chevron-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="the-box no-margin no-border padding-bottom-killer">
            <span class="label badge-info"><?php echo $this->lang->line('clan_past'); ?></span>
            <span class="label badge-info-danger"><?php echo $this->lang->line('clan_past_shif_on'); ?></span>
            <span class="label badge-warning-info"><?php echo $this->lang->line('clan_past_shif_of'); ?></span>
            <span class="label badge-success"><?php echo $this->lang->line('clan_present'); ?></span>
            <span class="label badge-success-danger"><?php echo $this->lang->line('clan_present_shif_on'); ?></span>
            <span class="label badge-warning-success"><?php echo $this->lang->line('clan_present_shif_of'); ?></span>
            <span class="label badge-inverse"><?php echo $this->lang->line('clan_future'); ?></span>
            <span class="label badge-inverse-danger"><?php echo $this->lang->line('clan_future_shif_on'); ?></span>
            <span class="label badge-warning-inverse"><?php echo $this->lang->line('clan_future_shif_of'); ?></span>
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