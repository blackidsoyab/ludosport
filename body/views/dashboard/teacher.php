<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
    $(document).ready(function() {
        loadCalander($('#calendar-year').val(),$('#calendar-month').val());      
    });

    function loadCalander(year, month){
        $('#calendar').fullCalendar({
            aspectRatio: 3,
            header: {
                left: '',
                center: 'title',
                right: 'today prev,next'
            },
            editable: false,
            droppable: false,
            events: function(start, end, timezone, callback) {
                console.log(start);
                console.log(end);
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

<div class="row">
    <div class="col-sm-12">
        <div class="the-box">
        <input type="hidden" value="<?php echo get_current_date_time()->year; ?>" id="calendar-year">
        <input type="hidden" value="<?php echo get_current_date_time()->month; ?>" id="calendar-month">
            <div id="calendar"></div>
            <div style="clear:both"></div>
        </div>
    </div>
</div>