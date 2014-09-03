<?php
$session = $this->session->userdata('user_session');
?>
<script src="<?php echo JS_URL; ?>full-calendar.js"></script>
<script type="text/javascript">
    var monthNames = <?php echo json_encode($monthNames);?>;
    $(document).ready(function() {
        initCalender();
    });
</script>

<div class="row">
    <div class="col-lg-6 col-xs-6">
        <h1 class="page-heading h1">&nbsp;</h1>
    </div>

    <div class="col-lg-6 col-xs-6">
        <a href="<?php echo base_url() .'student_mark_absence'; ?>" class="btn btn-primary h1 pull-right"><?php echo $this->lang->line('communicate_absence'); ?></a>
    </div>
</div>


<div class="alert alert-primary alert-block square">
        <span id="current-month-year" class="text-white"></span>
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
            <input type="hidden" value="<?php echo base_url().'student/class_details/'; ?>" id="calendar-event-src">
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>