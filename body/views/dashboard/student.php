<?php $session = $this->session->userdata('user_session'); ?>
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

        $('.scroll-chat-widget').slimScroll({
            height: 'auto',
            position: 'right',
            size: '4px',
            railOpacity: 0.3,
            railVisible: true,
            alwaysVisible: true,
            start : 'bottom'
        });

        if($('.scroll-chat-widget').find('li').length == 0){
            $('#personal-communication .chat-wrap').css('height', 'auto');
            $('#personal-communication .scroll-chat-widget').css('height', 'auto');
            $('#personal-communication .slimScrollDiv').css('height', 'auto');
        }
    });
</script>

<h1 class="page-heading"><?php echo $this->lang->line('dashboard'); ?></h1>
 
<div class="row">
    <div class="col-lg-8">
        <div class="the-box">
            <div class="blog-detail-image">
            <img src="<?php echo $cover_image; ?>" class="img-blog" alt="Banner">
            </div>
        </div>

        <div class="the-box no-border">
            <?php  if($challenge_received != false) { ?>
                <div class="the-box no-border bg-info full">
                    <div id="tiles-slide-3" class="owl-carousel tiles-carousel-color">
                        <?php  foreach ($challenge_received as $received) { ?>
                            <div class="item full">
                                <div class="avatar-wrap">
                                    <div class="media">
                                        <a class="pull-left" href="#fakelink">
                                        <img src="<?php echo IMG_URL . 'user_avtar/100X100/' . $received->from_avtar; ?>" class="avatar img-circle has-white-shadow media-object" alt="avatar">
                                        </a>
                                        <div class="media-body">
                                            <h4 class="media-heading"><?php echo $received->from_name; ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="des">
                                    <h4 class="bolded"><a href="#fakelink"><?php echo $this->lang->line('challenged_you'); ?></a></h4>
                                    <p class="small"><?php echo $this->lang->line('challenge_encourage_message'); ?></p>
                                    <a href="<?php echo base_url() .'duels/single/' . $received->id; ?>" class="btn btn-warning btn-sm"><?php echo $this->lang->line('view'), ' ', $this->lang->line('duel'); ?></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

            <div class="row">
                <div class="col-sm-6">
                    <a href="<?php echo base_url() .'duels'; ?>" class="btn btn-block btn-danger"><?php echo $this->lang->line('challenge_to_duel'); ?></a>
                </div>
                <div class="col-sm-6">
                    <a href="<?php echo base_url() .'message/compose'; ?>" class="btn btn-block btn-info"><?php echo $this->lang->line('write_message'); ?></a>
                </div>
            </div>
        </div>

        <div class="alert alert-danger alert-block square text-center">
            <a href="<?php echo base_url() .'student_mark_absence'; ?>" class="text-white">
                <?php echo $this->lang->line('communicate_absence'); ?>
            </a>
        </div>

        <?php if($top_ten_users != false){ ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="the-box no-border">
                        <h4 class="small-heading more-margin-bottom text-black text-center"><?php echo $this->lang->line('the_best'),' ',count($top_ten_users)?></h4>
                        <div id="store-item-carousel-1" class="owl-carousel shop-carousel owl-theme">
                        <?php 
                            $count = 0;
                            foreach ($top_ten_users as $ten_users) { 
                        ?>
                            <div class="item">
                                <div class="media">
                                    <a class="pull-left" href="#fakelink">
                                        <img class="lazyOwl media-object sm img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . $ten_users->avtar; ?>" alt="Image">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading nowrap overflow-hidden overflow-text-dot">
                                            <a href="<?php echo base_url() .'profile/view/' . $ten_users->id; ?>" data-toggle="tooltip" data-original-title="<?php echo $ten_users->name; ?>"><?php echo $ten_users->name; ?></a>
                                        </h4>
                                        <p class="price text-danger"><strong><?php echo ++$count; ?></strong></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-warning panel-square panel-no-border">
            <div class="panel-heading">
                <span class="bolded"><a class="text-white padding-killer" href="<?php echo base_url() . 'profile/view/' . $user->id; ?>"><?php echo $user->name; ?></a></span>
            </div>

            <div class="the-box no-border full card-info">
                <div class="the-box no-border text-center no-margin padding-top-killer padding-bottom-killer">
                    <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $session->avtar; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
                    <p class="text-info"><?php echo @$batch_detail->{$session->language.'_name'}; ?></p>
                    <p class="text-muted"><?php echo @$ac_sc_clan_name; ?></p>
                    <p class="text-muted bordered">
                    <?php
                        $role_name = NULL;
                        foreach (explode(',', $user->role_id) as $role) {
                            $role_name .= ', ' . getRoleName($role);
                        }
                        echo substr($role_name, 2);
                    ?>
                    </p>
                    <?php if(!is_null($user->quote) && !empty($user->quote)) { ?>
                        <p class="text-muted">
                            "<?php echo $user->quote; ?>"
                        </p>
                    <?php } ?>

                    <?php if(!is_null(@$batch_image)) { ?>
                        <p class="social-icon">
                            <?php foreach ($batch_image as $image) { ?>
                                <img src="<?php echo $image['image']; ?>" width="40" height="40" alt="<?php echo $image['name']; ?>" data-toggle="tooltip" data-original-title="<?php echo $image['name']; ?>">
                            <?php } ?>
                        </p>
                    <?php } ?>
                </div>
                <button class="btn btn-warning btn-block btn-lg btn-square"><?php echo $this->lang->line('score'); ?>: <?php echo $userdetail->total_score; ?></button>
            </div>
        </div>

        
        <div class="the-box no-border" id="personal-communication">
            <h4 class="small-heading more-margin-bottom"><?php echo $this->lang->line('student_dashboard_announcement_title'); ?></h4>
            <div class="chat-wrap scroll-chat-widget">
                <?php if($last_five_announcements != false) { ?>
                    <ul class="media-list media-xs media-dotted media-chat">
                        <?php foreach ($last_five_announcements as $announcement) { ?>
                            <li class="media">
                                <a class="pull-left" href="<?php echo base_url().'profile/view/' . $announcement->from_id; ?>"><img class="media-object img-circle" src="<?php echo IMG_URL .'user_avtar/40X40/' . $announcement->from_avtar; ?>" alt="<?php echo $announcement->from_person; ?>"></a>
                                <div class="media-body">
                                    <p class="name"><small><?php echo $announcement->from_person; ?></small></p>
                                    <?php
                                        if(strlen($announcement->announcement) > 50){
                                            echo character_limiter(strip_tags($announcement->announcement), 50);
                                            echo '<br /><a href="'. base_url() .'announcement/read/' .  $announcement->id .'">Read more</a>';
                                        }else{
                                            echo $announcement->announcement;
                                        }
                                    ?>
                                    <p class="text-danger"><small><?php echo time_elapsed_string($announcement->timestamp); ?></small></p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { echo  '<a href="'.base_url() .'announcement">'. $this->lang->line('no_personal_communication') .'</a>'; }?>
            </div>
        </div>
        
</div>