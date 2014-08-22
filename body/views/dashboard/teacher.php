<?php
$session = $this->session->userdata('user_session');
$monthNames = array_map(function ($ar) {
    $session = get_instance()->session->userdata('user_session');
    return $ar["$session->language"];
}, $this->config->item('custom_months'));
?>
<script type="text/javascript">
    var monthNames = <?php echo json_encode($monthNames);?>;

    $(document).ready(function() {
        //Load current Month Calendar
        $('#calendar').fullCalendar('today');
        loadCalander($('#calendar-year').val(),$('#calendar-month').val());
        var year = $('#calendar').fullCalendar('getDate').getFullYear();
        $('#calendar-year').val(year);
        var month = $('#calendar').fullCalendar('getDate').getMonth();
        $('#calendar-month').val(month);
        $('#current-month-year').html(monthNames[month]+ ' ' + year);

        //Onclick Prev Month        
        $('#prev-button').click(function(e){
            $('#calendar').fullCalendar('prev');
            beforeCalenderLoad();
        });

        //Onclick Today Month
        $('#today-button').click(function(){
            $('#calendar').fullCalendar('today');
            beforeCalenderLoad();
        });

        //Onclick Next Month
        $('#next-button').click(function(){
            $('#calendar').fullCalendar('next');
            beforeCalenderLoad();
        });
    });

    function beforeCalenderLoad(){
        var year = $('#calendar').fullCalendar('getDate').getFullYear();
        $('#calendar-year').val(year);
        var month = $('#calendar').fullCalendar('getDate').getMonth();
        $('#calendar-month').val(month);
        $('#calendar').fullCalendar( 'destroy' );
        loadCalander($('#calendar-year').val(),$('#calendar-month').val());
        $('#current-month-year').html(monthNames[month]+ ' ' + year);
    }

    function loadCalander(year, month){
        $('#calendar').fullCalendar({
            year : Number(year),
            month : Number(month),
            aspectRatio: 3,
            header: {
                left: '',
                center: '',
                right: ''
            },
            editable: false,
            droppable: false,
            events: '<?php echo base_url() ."teacher/class_details/"; ?>' + year +'/'+ month,
            eventRender: function(event, element) {
                element.removeClass('fc-event');
                if(event.type == 'past'){
                    element.addClass('badge badge-inverse');
                } else if(event.type == 'present'){
                    element.addClass('badge badge-success');
                } else if(event.type == 'future'){
                    element.addClass('badge badge-info');
                }
            },
            viewRender: function(event, element) {
                $('.progress-icon').show();
            },
            eventAfterRender: function(event, element) {
                $('.progress-icon').hide();
            }
        });
    }
</script>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
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
            <a href="javascript://" class="btn btn-primary" id="prev-button"><i class="fa fa-chevron-left"></i></a>
            <a href="javascript:;" class="btn btn-primary" id="today-button">Today</a>
            <a href="javascript:;" class="btn btn-primary" id="next-button"><i class="fa fa-chevron-right"></i></a>
        </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="progress-icon" style="display:none" align="center">
            <i class="fa fa-cog fa-spin fa-2x text-primary"></i>
        </div>
        <div class="the-box">
            <input type="hidden" value="<?php echo get_current_date_time()->year; ?>" id="calendar-year">
            <input type="hidden" value="<?php echo get_current_date_time()->month - 1; ?>" id="calendar-month">
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>