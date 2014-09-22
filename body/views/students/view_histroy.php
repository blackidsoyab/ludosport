<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading h1"><?php echo $this->lang->line('histroy'); ?></h1>

<div class="row" id="history">
    <div class="col-lg-8">
        <div class="panel panel-success panel-square panel-no-border">
            <div class="panel-heading lg">
                <div class="right-content">
                    <button class="btn btn-success to-collapse collapsed" data-toggle="collapse" data-target="#panel-chart-widget-1"><i class="fa fa-chevron-down"></i></button>
                </div>
                <h3 class="panel-title"><strong>MY PERSONAL DATA</strong></h3>
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
                                    <h4 class="small-heading">VICTORIES / DEFEATS</h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-1" data-percent="<?php echo @$victories_percentage; ?>">
                                        <span class="percent"><?php echo @$victories_percentage; ?></span>
                                        <canvas height="110" width="110"></canvas></span>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <h4 class="small-heading">ATTENDANCE / ABSENCE</h4>
                                    <span class="chart chart-widget-pie widget-easy-pie-2" data-percent="<?php echo @$attendance_percentage; ?>">
                                        <span class="percent"><?php echo @$attendance_percentage; ?></span>
                                        <canvas height="110" width="110"></canvas></span>
                                </div>
                            </div>
                            <hr>
                            <button class="btn btn-block btn-danger"><i class="fa fa-cogs"></i>Score: <?php echo $user_detail->total_score; ?></button>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="small-heading">MY DUELS </h4>
                            <p class="small">Victories - <?php echo @$total_victories; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$victories_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small">Defeats - <?php echo @$total_defeats; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$defeats_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small">Challenges made - <?php echo @$total_made; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$made_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small">Challenges received - <?php echo @$total_received; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$received_percentage, '%'; ?>">
                                </div>
                            </div>
                            <p class="small">Challenges rejected - <?php echo @$total_rejected; ?></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$rejected_percentage, '%'; ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="small-heading">CLASSES LOG </h4>
                            <p class="small">Attended - <span class="text-success"><?php echo @$attendance_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo @$attendance_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$attendance_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small">Missed - <span class="text-danger"><?php echo @$missed_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo @$missed_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$missed_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small">Catch-ups - <span class="text-warning"><?php echo @$recover_percentage; ?>%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo @$recover_percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo @$recover_percentage; ?>%">
                                </div>
                            </div>
                            <p class="small">Years of practice - <span class="text-info">70%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4 class="small-heading">TOURNAMENTS </h4>
                            <p class="small">  Attended - <span class="text-danger">80%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                </div>
                            </div>
                            <p class="small">Missed- <span class="text-warning">20%</span></p>
                            <div class="progress no-rounded progress-xs">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="width: 65%">
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
                <h3 class="panel-title text-white padding-top-killer padding-left-killer"><strong>MY COMBAT STYLES</strong></h3>
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
                <h3 class="panel-title text-white padding-top-killer padding-left-killer"><strong>TIMELINE</strong></h3>
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
                            <img class="pull-left media-object img-circle" src="<?php echo IMG_URL . 'batches/' . $degree->image; ?>" alt="<?php echo $degree->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $degree->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4><?php echo $degree->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo date('d/m/Y', strtotime($degree->assign_date)); ?></p>
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
                        <img class="pull-left media-object img-circle" src="<?php echo IMG_URL . 'batches/' . $honour->image; ?>" alt="<?php echo $honour->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $honour->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4><?php echo $honour->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo date('d/m/Y', strtotime($honour->assign_date)); ?></p>
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
                       <img class="pull-left media-object img-circle" src="<?php echo IMG_URL . 'batches/' . $qualification->image; ?>" alt="<?php echo $qualification->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $qualification->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4><?php echo $qualification->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo date('d/m/Y', strtotime($qualification->assign_date)); ?></p>
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
                        <img class="pull-left media-object img-circle" src="<?php echo IMG_URL . 'batches/' . $security->image; ?>" alt="<?php echo $security->{$session->language . '_name'}; ?>"  data-toggle="tooltip" data-original-title="<?php echo $security->{$session->language . '_name'}; ?>">
                        <div class="media-body">
                            <h4><?php echo $security->{$session->language . '_name'}; ?></h4>
                            <p class="text-danger"><?php echo date('d/m/Y', strtotime($security->assign_date)); ?></p>
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