<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading h1"><?php echo $this->lang->line('history'); ?></h1>

<div class="row" id="history">
    <div class="col-lg-8">
        <div class="panel panel-success panel-square panel-no-border">
            <div class="panel-heading lg">
                <div class="right-content">
                    <button class="btn btn-success to-collapse collapsed" data-toggle="collapse" data-target="#panel-chart-widget-1"><i class="fa fa-chevron-down"></i></button>
                </div>
                <h3 class="panel-title"><strong><?php echo $this->lang->line('my_personal_data'); ?></strong></h3>
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
                            <p class="small"><?php echo $this->lang->line('challenge_made'); ?> - <?php echo @$total_made; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$made_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('challenge_received'); ?> - <?php echo @$total_received; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$received_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('challenge_rejected'); ?> - <?php echo @$total_rejected; ?></p>
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
                            <h4 class="small-heading"><?php echo $this->lang->line('tournaments'); ?> </h4>
                            <p class="small"><?php echo $this->lang->line('attended'); ?> - <span class="text-success">0%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div>
                            <p class="small"><?php echo $this->lang->line('missed'); ?>- <span class="text-danger">0%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <p><a href="#" data-toggle="tooltip" title="Paris Hawker"> <img src="<?php echo IMG_URL . 'history_tournament/torneo_1classificato.png'; ?>" alt="Avatar" width="80" class="img-responsive img-circle"> </a></p>
                                </div>
                                
                                <div class="col-xs-3">
                                    <p><a href="#" data-toggle="tooltip" title="" data-original-title="Thomas White"> <img src="<?php echo IMG_URL . 'history_tournament/torneo_2classificato.png'; ?>" alt="Avatar" width="80" class="img-responsive img-circle"> </a></p>
                                </div>
                                
                                <div class="col-xs-3">
                                    <p><a href="#" data-toggle="tooltip" title="Doina Slaivici"> <img src="<?php echo IMG_URL . 'history_tournament/torneo_3classificato.png'; ?>" alt="Avatar" width="80" class="img-responsive img-circle"> </a></p>
                                </div>
                                <div class="col-xs-3">
                                    <p><a href="#" data-toggle="tooltip" title="Doina Slaivici"> <img src="<?php echo IMG_URL . 'history_tournament/torneo_premiostile.png'; ?>" alt="Avatar" width="80" class="img-responsive img-circle"></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3 class="panel-title text-white padding-top-killer padding-left-killer"><strong><?php echo $this->lang->line('my_combat_style'); ?></strong></h3>
                <div class="the-box">
                    <div class="row">
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="" data-original-title="Shiicho"> <img src="<?php echo IMG_URL . 'seven_styles/01_shiicho_esamestile.png'; ?>" alt="Avatar" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="" data-original-title="Makashi"> <img src="<?php echo IMG_URL . 'seven_styles/02_makashi_esamestile.png'; ?>" alt="Avatar" width="400" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="" data-original-title="Soresu"> <img src="<?php echo IMG_URL . 'seven_styles/03_soresu_esamestile.png'; ?>" alt="Avatar" width="400" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="" data-original-title="Ataru"> <img src="<?php echo IMG_URL . 'seven_styles/04_ataru_esamestile.png'; ?>" alt="Avatar" width="400" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="Djemso"> <img src="<?php echo IMG_URL . 'seven_styles/05_djemso_base.png'; ?>" alt="Avatar" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="" data-original-title="Niman"> <img src="<?php echo IMG_URL . 'seven_styles/'; ?>06_niman_base.png" alt="Avatar" class="img-responsive img-circle"> </a></p>
                        </div>
                        
                        <div class="col-xs-2">
                            <p><a href="#" data-toggle="tooltip" title="Vaapad"> <img src="<?php echo IMG_URL . 'seven_styles/07_vaapad_base.png'; ?>" alt="Avatar" class="img-responsive img-circle"> </a></p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <h3 class="panel-title text-white padding-top-killer padding-left-killer"><strong><?php echo $this->lang->line('timeline'); ?></strong></h3>
                <ul class="timeline">
                    <li class="centering-line"></li>
                    <div id="timeline-data">
                    </div>
                </ul>
                <div class="animation_image" style="display:none" align="center">
                    <i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <?php if ($student_degrees != false) { ?>
            <div class="the-box no-border">
                <?php foreach ($student_degrees as $degree) { ?>
                    <div class="media user-card-sm">
                            <img class="pull-left media-object img-circle <?php echo ($user_detail->degree_id != $degree->id) ? 'opacity-5' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $degree->image; ?>" alt="<?php echo $degree->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $degree->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4 class="<?php echo ($user_detail->degree_id != $degree->id) ? 'text-muted' : ''; ?>"><?php echo $degree->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo (!is_null($degree->assign_date)) ? date('d/m/Y', strtotime($degree->assign_date)) : ''; ?></p>
                        </div>
                        <div class="right-button">
                            <button class="btn btn-danger"><i class="fa fa-info"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($student_securities != false) { ?>
            <div class="the-box no-border">
                <?php foreach ($student_securities as $security) { ?>
                    <div class="media user-card-sm">
                        <img class="pull-left media-object img-circle <?php echo ($user_detail->security_id != $security->id) ? 'opacity-5' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $security->image; ?>" alt="<?php echo $security->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $security->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4 class="<?php echo ($user_detail->security_id != $security->id) ? 'text-muted' : ''; ?>"><?php echo $security->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo (!is_null($security->assign_date)) ? date('d/m/Y', strtotime($security->assign_date)) : ''; ?></p>
                        </div>
                        <div class="right-button">
                            <button class="btn btn-danger"><i class="fa fa-info"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($student_qualifications != false) { ?>
            <div class="the-box no-border">
                <?php foreach ($student_qualifications as $qualification) { ?>
                    <div class="media user-card-sm">
                       <img class="pull-left media-object img-circle <?php echo ($user_detail->qualification_id != $qualification->id) ? 'opacity-5' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $qualification->image; ?>" alt="<?php echo $qualification->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $qualification->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4 class="<?php echo ($user_detail->qualification_id != $qualification->id) ? 'text-muted' : ''; ?>"><?php echo $qualification->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo (!is_null($qualification->assign_date)) ? date('d/m/Y', strtotime($qualification->assign_date)) : ''; ?></p>
                        </div>
                        <div class="right-button">
                            <button class="btn btn-danger"><i class="fa fa-info"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($student_honours != false) { ?>
            <div class="the-box no-border">
                <?php foreach ($student_honours as $honour) { ?>
                    <div class="media user-card-sm">
                        <img class="pull-left media-object img-circle <?php echo ($user_detail->honor_id != $honour->id) ? 'opacity-5' : ''; ?>" src="<?php echo IMG_URL . 'batches/' . $honour->image; ?>" alt="<?php echo $honour->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $honour->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4 class="<?php echo ($user_detail->honor_id != $honour->id) ? 'text-muted' : ''; ?>"><?php echo $honour->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo (!is_null($honour->assign_date)) ? date('d/m/Y', strtotime($honour->assign_date)) : ''; ?></p>
                        </div>
                        <div class="right-button">
                            <button class="btn btn-danger"><i class="fa fa-info"></i></button>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>     
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var track_load = 0;
        var loading  = false;
        var total_groups = <?php echo $per_page; ?>;

        $('#timeline-data').load("<?php echo base_url() . 'history/load_more_timeline/'; ?>" + track_load , function() {track_load++;});

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()){
                if(track_load <= total_groups && loading==false)
                {
                    loading = true;
                    $('.animation_image').show();
                    $.post('<?php echo base_url() . "history/load_more_timeline/"; ?>' + track_load , function(data){
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
    });
</script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/easypiechart.min.js"></script>
<script src="<?php echo PLUGIN_URL; ?>easypie-chart/jquery.easypiechart.min.js"></script>