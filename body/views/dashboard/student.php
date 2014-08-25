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
            $("html, body").scrollTop($('#prev-button').offset().top);
        });

        //Onclick Today Month
        $('#today-button').click(function(){
            $('#calendar').fullCalendar('today');
            beforeCalenderLoad();
            $("html, body").scrollTop($('#today-button').offset().top); 
        });

        //Onclick Next Month
        $('#next-button').click(function(){
            $('#calendar').fullCalendar('next');
            beforeCalenderLoad();
            $("html, body").scrollTop($('#next-button').offset().top); 
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
            events: '<?php echo base_url() ."student/class_details/"; ?>' + year +'/'+ month,
            eventRender: function(event, element) {
                element.removeClass('fc-event');
                if(event.type == 'past'){
                    element.addClass('badge badge-info');
                } else if(event.type == 'present'){
                    element.addClass('badge badge-success');
                } else if(event.type == 'future'){
                    element.addClass('badge badge-inverse');
                }
            },
            viewRender: function(event, element) {
                $('.progress-icon').fadeIn();
            },
            eventAfterRender: function(event, element) {
                $('.progress-icon').fadeOut();
            }
        });
    }
</script>

<div class="row">
    <div class="col-lg-6 col-xs-6">
        <h1 class="page-heading h1">&nbsp;</h1>
    </div>

    <div class="col-lg-6 col-xs-6">
        <a href="<?php echo base_url() .'student_mark_absence'; ?>" class="btn btn-primary h1 pull-right">Communicate absence</a>
    </div>
</div>


<div class="alert alert-primary alert-block square">
        <span id="current-month-year" class="text-white"></span>
        <div class="btn-group pull-right">
            <a href="javascript:;" class="btn btn-primary" id="prev-button"><i class="fa fa-chevron-left"></i></a>
            <a href="javascript:;" class="btn btn-primary" id="today-button">Today</a>
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
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>