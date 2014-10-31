$(document).ready(function() {
    //Onclick Prev Month        
    $('#prev-button').click(function(e) {
        $('#calendar').fullCalendar('prev');
        beforeCalenderLoad();
        $("html, body").scrollTop($('#prev-button').offset().top);
    });
    //Onclick Today Month
    $('#today-button').click(function() {
        $('#calendar').fullCalendar('today');
        beforeCalenderLoad();
        $("html, body").scrollTop($('#next-button').offset().top);
    });
    //Onclick Next Month
    $('#next-button').click(function() {
        $('#calendar').fullCalendar('next');
        beforeCalenderLoad();
        $("html, body").scrollTop($('#next-button').offset().top);
    });
});

function initCalender() {
    $('#calendar').fullCalendar('today');
    loadCalander($('#calendar-year').val(), $('#calendar-month').val(), $('#calendar-event-src').val());
    var year = $('#calendar').fullCalendar('getDate').getFullYear();
    $('#calendar-year').val(year);
    var month = $('#calendar').fullCalendar('getDate').getMonth();
    $('#calendar-month').val(month);
    $('#current-month-year').html(monthNames[month] + ' ' + year);
}

function beforeCalenderLoad() {
    var year = $('#calendar').fullCalendar('getDate').getFullYear();
    $('#calendar-year').val(year);
    var month = $('#calendar').fullCalendar('getDate').getMonth();
    $('#calendar-month').val(month);
    $('#calendar').fullCalendar('destroy');
    loadCalander($('#calendar-year').val(), $('#calendar-month').val(), $('#calendar-event-src').val());
    $('#current-month-year').html(monthNames[month] + ' ' + year);
}

function loadCalander(year, month, url) {
    $('#calendar').fullCalendar({
        year: Number(year),
        month: Number(month),
        aspectRatio: 3,
        header: {
            left: '',
            center: '',
            right: ''
        },
        editable: false,
        droppable: false,
        events: url + year + '/' + month,
        eventRender: function(event, element) {
            element.removeClass('fc-event');
            element.removeClass('fc-event-start');
            element.removeClass('fc-event-end');
            if (event.tooltip) {
                element.attr('data-toggle', 'tooltip');
                element.attr('data-original-title', event.tooltip);
                $(element).tooltip({
                    container: "body"
                })
            }
            element.addClass(event.class);
            element.attr('data-cell', event.day_bg_class);

            var MyDate = new Date(event.start);
            //var temp = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDay();
            MyDateString = MyDate.getFullYear()  + '-' + ('0' + (MyDate.getMonth()+1)).slice(-2) + '-' + ('0' + MyDate.getDate()).slice(-2);

            $( ".fc-day" ).each(function( index ) {
                if($(this).attr('data-date') == MyDateString){
                    $(this).addClass($('.fc-cell-' + MyDateString).attr('data-cell'));
                }
            });

            if (event.class_event != '') {
                element.find('.fc-event-inner').addClass(event.class_event);
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