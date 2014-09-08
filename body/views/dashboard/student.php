<?php
$session = $this->session->userdata('user_session');
?>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('#store-item-carousel-1').length > 0){
            $("#store-item-carousel-1").owlCarousel({
                autoPlay: 2000,
                items : 3,
                lazyLoad : true,
                autoHeight : true,
                stopOnHover : true
            });
        }

        if ($('#tiles-slide-3').length > 0){
            $("#tiles-slide-3").owlCarousel({
                navigation : false,
                pagination: false,
                slideSpeed : 1000,
                paginationSpeed : 400,
                singleItem:true,
                autoPlay: 3235,
                stopOnHover: true
            });
        }
    });
</script>

<h1 class="page-heading"><?php echo $this->lang->line('dashboard'); ?></h1>
 

<div class="col-lg-8">
    <div class="the-box">
        <div class="blog-detail-image">
        <img src="<?php echo IMG_URL .'banner.png'; ?>" class="img-blog" alt="Banner">
        </div>
    </div>

    <div class="the-box no-border">
        <div class="the-box no-border bg-info full">
            <div id="tiles-slide-3" class="owl-carousel tiles-carousel-color">
                <?php  foreach ($users as $user) { ?>
                    <div class="item full">
                        <div class="avatar-wrap">
                            <div class="media">
                                <a class="pull-left" href="#fakelink">
                                <img src="<?php echo IMG_URL . 'user_avtar/100X100/' . $user->avtar; ?>" class="avatar img-circle has-white-shadow media-object" alt="avatar">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading"><?php echo $user->firstname,' ',$user->lastname; ?></h4>
                                </div>
                            </div>
                        </div>
                        <div class="des">
                            <h4 class="bolded"><a href="#fakelink">Challenged you!</a></h4>
                            <p class="small"><?php echo date('d-m-Y', $user->date_of_birth); ?></p>
                            <p class="small">Pick the gauntlet up and prepare to fight.</p>
                            <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>" class="btn btn-warning btn-sm">Accept the duel</a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <button class="btn btn-block btn-danger"><i class="fa fa-cogs"></i> -CHALLENGE TO A DUEL!- </button>
            </div>
            <div class="col-sm-6">
                <a href="<?php base_url() .'message/compose'; ?>" class="btn btn-block btn-info"><i class="fa fa-cogs"></i> -WRITE MESSAGE- </a>
            </div>
        </div>
    </div>

    <div class="alert alert-danger alert-block square text-center">
        <a href="<?php echo base_url() .'student_mark_absence'; ?>" class="text-white">
            <?php echo $this->lang->line('communicate_absence'); ?>
        </a>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="the-box no-border">
                <h4 class="small-heading more-margin-bottom text-center">The best <?php echo count($users->all)?></h4>
                <div id="store-item-carousel-1" class="owl-carousel shop-carousel owl-theme">
                <?php  foreach ($users as $user) { ?>
                    <div class="item">
                        <div class="media">
                            <a class="pull-left" href="#fakelink">
                                <img class="lazyOwl media-object sm img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . $user->avtar; ?>" alt="Image">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading nowrap overflow-hidden overflow-text-dot">
                                    <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>" data-toggle="tooltip" data-original-title="<?php echo $user->firstname,' ',$user->lastname; ?>"><?php echo $user->firstname,' ',$user->lastname; ?></a>
                                </h4>
                                <p class="price text-danger"><strong>1</strong></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div class="panel panel-warning panel-square panel-no-border">
        <div class="panel-heading">
            <span class="bolded">Number Rating: 5</span>
        </div>

        <div class="the-box no-border full card-info">
            <div class="the-box no-border text-center no-margin">
                <h4 class="bolded"><a href="my-profile.html"><?php echo $session->name; ?></a></h4>
                <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $session->avtar; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
                <p class="text-info">JEDI</p>
                <p class="text-muted">Gegio: LudoSport, Milano, Clan della Luce</p>
                <p class="bordered">
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                <i class="fa fa-star text-warning"></i>
                </p>
                <p class="text-muted">
                " La gloria di colui che tutto move per l'universo penetra e risplende in una parte più e meno altrove."</p>
                <p class="social-icon">
                    <img src="<?php echo IMG_URL . 'batches/03c0e2e2b6050bdeac592090aa063e8f.png'; ?>" width="40" height="40" alt="">
                    <img src="<?php echo IMG_URL . 'batches/3b69f92034caa56c01b0dc557cfa18b0.png'; ?>" width="40" height="40" alt="">
                </p>
            </div>
            <button class="btn btn-warning btn-block btn-lg btn-square">Pts. 1843</button>
        </div>
    </div>
</div>