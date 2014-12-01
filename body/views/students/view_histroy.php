<?php $session = $this->session->userdata('user_session'); ?>

<script type="text/javascript">
 $(document).ready(function(){
    $('a[data-toggle~="modal"]').on('click', function(e) {
        var target_modal = $(e.currentTarget).data('target');
        var remote_content = e.currentTarget.href;
        var modal = $(target_modal);
        var modalBody = $(target_modal + ' .modal-body');
        modal.on('show.bs.modal', function () {
            modalBody.load(remote_content);
        }).modal();
        return false;
    });

    $('#tournament_batch_history').on('hidden.bs.modal', function(){
        $('.modal-body').html('');
    });
});
</script>


<h1 class="page-heading h1"><?php echo $this->lang->line('history'); ?></h1>

<div class="row" id="history">
    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
        <div class="panel panel-success panel-square panel-no-border">
            <div class="panel-heading lg">
                <h3 class="panel-title"><strong><?php echo $this->lang->line('my_personal_data'); ?></strong></h3>
                <div class="right-content">
                    <button class="btn btn-success to-collapse collapsed" data-toggle="collapse" data-target="#panel-chart-widget-1"><i class="fa fa-chevron-down"></i></button>
                </div>
            </div>
            <div class="blog-detail-image">
                <img src="assets/img/Z1.png" class="img-blog" alt="Blog image">
            </div>
            <div id="panel-chart-widget-1" class="collapse in">
                <div class="the-box no-border">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-xs-6 text-center">
                                    <h4 class="small-heading"><?php echo $this->lang->line('wins'), ' / ', $this->lang->line('defeat'); ?></h4></h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="<?php echo @$victories_percentage; ?>">
                                        <span class="percent"><?php echo @$victories_percentage; ?></span>
                                        <canvas height="110" width="110"></canvas></span>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <h4 class="small-heading"><?php echo $this->lang->line('attendance'), ' / ', $this->lang->line('absence'); ?></h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="<?php echo @$attendance_percentage; ?>">
                                        <span class="percent"><?php echo @$attendance_percentage; ?></span>
                                        <canvas height="110" width="110"></canvas></span>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-block btn-danger"><i class="fa fa-cogs"></i><?php echo $this->lang->line('score'); ?>: <?php echo $user_detail->total_score; ?></button>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="small-heading"><?php echo $this->lang->line('my_duels'); ?></h4>
                            <p class="small"><?php echo $this->lang->line('victories'); ?> - <?php echo @$total_victories; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$victories_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('defeats'); ?> - <?php echo @$total_defeats; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$defeats_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('challenges_made'); ?> - <?php echo @$total_made; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$made_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('challenges_recevied'); ?> - <?php echo @$total_received; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$received_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('challenges_rejected'); ?> - <?php echo @$total_rejected; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$rejected_percentage, '%'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="small-heading"><?php echo $this->lang->line('clan_logs'); ?></h4>
                            <p class="small"><?php echo $this->lang->line('attended'); ?> - <span class="text-success"><?php echo @$attendance_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo @$attendance_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$attendance_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('missed'); ?> - <span class="text-danger"><?php echo @$missed_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo @$missed_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$missed_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('catch_up'); ?> - <span class="text-warning"><?php echo @$recover_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo @$recover_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$recover_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('year_of_practice'); ?> - <span class="text-info">0%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="small-heading"><?php echo strtoupper($this->lang->line('tournaments')); ?> </h4>
                            <p class="small"><?php echo $this->lang->line('attended'); ?> - <span class="text-success"><?php echo @$tournament_present_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$tournament_present_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('missed'); ?>- <span class="text-danger"><?php echo @$tournament_absent_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$tournament_absent_percentage; ?>%">
                                </div>
                            </div>
                            <div class="row">
                                <?php if(isset($assigned_tournament_batches)) {
                                    $sequence = array_map(function($element){return $element['sequence']; }, $assigned_tournament_batches);
                                    array_multisort($sequence, SORT_ASC, $assigned_tournament_batches);
                                    foreach ($assigned_tournament_batches as $tournament_batch) {
                                ?>
                                    <div class="col-xs-3">
                                        <a href="<?php echo base_url(). 'event/batch_details/'. $tournament_batch['id']; ?>" data-toggle="modal" data-target="#tournament_batch_history">
                                            <img src="<?php echo IMG_URL . 'batches/' . $tournament_batch['image']; ?>" class="img-responsive img-circle"  data-toggle="tooltip" data-original-title="<?php echo $tournament_batch[$session->language . '_name']; ?>" >
                                        </a>
                                    </div>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <h3 class="panel-title text-white padding-top-killer padding-left-killer"><strong><?php echo $this->lang->line('my_combat_style'); ?></strong></h3>
                <div class="the-box">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php foreach ($evolution_batch_master as $master) { ?>
                                <img src="<?php echo $master['image']; ?>" alt="Avatar" class="seven-style-icon img-responsive img-circle" data-toggle="tooltip" title="" data-original-title="<?php echo $master[$session->language]; ?>">    
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <h3 class="panel-title text-white padding-top-killer padding-left-killer pull-left"><strong><?php echo $this->lang->line('timeline'); ?></strong></h3>
                        <a href="<?php echo base_url() . 'timeline' ; ?>" class="pull-right"><?php echo $this->lang->line('view_all'), ' ', strtolower($this->lang->line('timeline')); ?></a>
                    </div>
                </div>
                <ul class="timeline">
                    <li class="centering-line"></li>
                    <div id="timeline-data">
                    </div>
                </ul>

                <div align="center">
                    <button class="btn btn-warning btn-perspective text-center load_more" >Click here / Scroll down to load more <i class="padding-killer fa fa-long-arrow-down text-white"></i></button>
                </div>
                <div class="animation_image" style="display:none" align="center">
                    <i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <?php if ($student_degrees != false) { ?>
            <div class="panel panel-degree panel-square panel-no-border">
                <div class="panel-heading">
                    <div class="right-content">
                        <button class="btn btn-degree to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-degree"><i class="fa fa-chevron-up"></i></button>
                    </div>
                    <h3 class="panel-title"><strong><?php echo $this->lang->line('degree'); ?></strong></h3>
                </div>

                <div id="panel-student-degree" class="collapse in">
                    <div class="the-box no-border">
                        <?php foreach ($student_degrees as $degree) { ?>
                            <div class="media user-card-sm">
                                    <img class="pull-left media-object img-circle <?php echo ($user_detail->degree_id != $degree->id) ? (!is_null($degree->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $degree->image; ?>" alt="<?php echo $degree->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $degree->{$session->language . '_name'}; ?>">
                                <div class="media-body">
                                    <h4 class="<?php echo ($user_detail->degree_id != $degree->id) ? (!is_null($degree->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $degree->{$session->language . '_name'}; ?></h4>
                                    <p class="text-danger"><?php echo (!is_null($degree->assign_date)) ? date('d/m/Y', strtotime($degree->assign_date)) : ''; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                 </div>
            </div>
        <?php } ?>

        <?php if ($student_securities != false) { ?>
            <div class="panel panel-security panel-square panel-no-border">
                    <div class="panel-heading">
                        <div class="right-content">
                            <button class="btn btn-security to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-security"><i class="fa fa-chevron-up"></i></button>
                        </div>
                        <h3 class="panel-title"><strong><?php echo $this->lang->line('security'); ?></strong></h3>
                    </div>

                    <div id="panel-student-security" class="collapse in">
                        <div class="the-box no-border">
                            <?php foreach ($student_securities as $security) { ?>
                                <div class="media user-card-sm">
                                    <img class="pull-left media-object img-circle <?php echo ($user_detail->security_id != $security->id) ? (!is_null($security->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $security->image; ?>" alt="<?php echo $security->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $security->{$session->language . '_name'}; ?>">
                                    <div class="media-body">
                                        <h4 class="<?php echo ($user_detail->security_id != $security->id) ? (!is_null($security->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $security->{$session->language . '_name'}; ?></h4>
                                        <p class="text-danger"><?php echo (!is_null($security->assign_date)) ? date('d/m/Y', strtotime($security->assign_date)) : ''; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                     </div>
            </div>
        <?php } ?>

        <?php if ($student_qualifications != false) { ?>
            <div class="panel panel-qualification panel-square panel-no-border">
                <div class="panel-heading">
                    <div class="right-content">
                        <button class="btn btn-qualification to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-qualification"><i class="fa fa-chevron-up"></i></button>
                    </div>
                    <h3 class="panel-title"><strong><?php echo $this->lang->line('qualification'); ?></strong></h3>
                </div>

                <div id="panel-student-qualification" class="collapse in">
                    <div class="the-box no-border">
                        <?php foreach ($student_qualifications as $qualification) { ?>
                            <div class="media user-card-sm">
                               <img class="pull-left media-object img-circle <?php echo ($user_detail->qualification_id != $qualification->id) ? (!is_null($qualification->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $qualification->image; ?>" alt="<?php echo $qualification->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $qualification->{$session->language . '_name'}; ?>">
                                <div class="media-body">
                                    <h4 class="<?php echo ($user_detail->qualification_id != $qualification->id) ? (!is_null($qualification->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $qualification->{$session->language . '_name'}; ?></h4>
                                    <p class="text-danger"><?php echo (!is_null($qualification->assign_date)) ? date('d/m/Y', strtotime($qualification->assign_date)) : ''; ?></p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                 </div>
            </div>
        <?php } ?>

        <?php if ($student_honours != false) { ?>
            <div class="panel panel-honour panel-square panel-no-border">
                    <div class="panel-heading">
                        <div class="right-content">
                            <button class="btn btn-honour to-collapse collapsed" data-toggle="collapse" data-target="#panel-student-honour"><i class="fa fa-chevron-up"></i></button>
                        </div>
                        <h3 class="panel-title"><strong><?php echo $this->lang->line('honour'); ?></strong></h3>
                    </div>

                    <div id="panel-student-honour" class="collapse in">
                        <div class="the-box no-border">
                            <?php foreach ($student_honours as $honour) { ?>
                                <div class="media user-card-sm">
                                    <img class="pull-left media-object img-circle <?php echo ($user_detail->honour_id != $honour->id) ? (!is_null($honour->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $honour->image; ?>" alt="<?php echo $honour->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $honour->{$session->language . '_name'}; ?>">
                                    <div class="media-body">
                                        <h4 class="<?php echo ($user_detail->honour_id != $honour->id) ? (!is_null($honour->assign_date)) ? 'opacity-7' : 'opacity-3' : ''; ?>"><?php echo $honour->{$session->language . '_name'}; ?></h4>
                                        <p class="text-danger"><?php echo (!is_null($honour->assign_date)) ? date('d/m/Y', strtotime($honour->assign_date)) : ''; ?></p>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
            </div>
        <?php } ?>     
    </div>
</div>

<div class="modal fade" id="tournament_batch_history" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-no-shadow modal-no-border">
            <div class="modal-header bg-success no-border">
                <h4 class="modal-title text-white padding-killer"><?php echo $this->lang->line('tournament_batch_history'); ?></h4>
            </div>
            <div class="modal-body padding-top-killer">
            </div>
            <div class="modal-footer pad-10">
                <button type="button" class="btn btn-success" data-dismiss="modal"><?php echo $this->lang->line('ok'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var track_load = 0;
        var loading  = false;
        var total_groups = <?php echo $per_page; ?>;

        $('#timeline-data').load('<?php echo base_url() . "history/load_more_timeline/$session->id/0/"; ?>' + track_load , function() {track_load++;});

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()){
                if(track_load <= total_groups && loading==false)
                {
                    loading = true;
                    $('.animation_image').show();
                    $.post('<?php echo base_url() . "history/load_more_timeline/$session->id/0/"; ?>' + track_load , function(data){
                        $("#timeline-data").append(data);
                        $('.animation_image').hide();
                        track_load++;
                        loading = false; 
                    }).fail(function(xhr, ajaxOptions, thrownError) {
                        $('.animation_image').hide();
                        loading = false;
                    });
                }
            }
        });

         $('.load_more').click(function(){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo base_url() . "history/load_more_timeline/$session->id/0/"; ?>' + track_load , function(data){
                    $("#timeline-data").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false; 
                }).fail(function(xhr, ajaxOptions, thrownError) {
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        });
    });
</script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>