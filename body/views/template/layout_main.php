<!DOCTYPE html>
<html lang="it">
    <head>
        <?php $session = $this->session->userdata('user_session'); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo @$page_title . ' |MYLUDOSPORT'; ?></title>

        <link href="<?php echo CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
        <?php if ($session->role >= 2 && $session->role <= 5) { ?>
            <link href="<?php echo CSS_URL . $session->role . '.css'; ?>" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo CSS_URL; ?>style-responsive.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>weather-icon/css/weather-icons.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>prettify/prettify.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>magnific-popup/magnific-popup.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>owl-carousel/owl.carousel.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>owl-carousel/owl.theme.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>owl-carousel/owl.transitions.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>chosen/chosen.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>icheck/skins/all.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>datepicker/datepicker.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>summernote/summernote.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>markdown/bootstrap-markdown.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>datatable/css/bootstrap.datatable.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>morris-chart/morris.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>c3-chart/c3.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>toastr/toastr.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>slider/slider.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>jquery.confirm.css" rel="stylesheet" />

        <script src="<?php echo JS_URL; ?>jquery.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/bootstrap.datatable.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.confirm.js" type="text/javascript"></script>
        <?php echo smiley_js(); ?>
        <script>
            var http_host_js = '<?php echo base_url(); ?>';
            
            function UpdateLang(ele) {
                $.ajax({
                    type: 'POST',
                    url: http_host_js + 'change_language/' + $(ele).data('lang'),
                    success: function() {
                        window.location.reload();
                    }
                });
            }
            
            function UpdateRole(ele) {
                $.ajax({
                    type: 'POST',
                    url: http_host_js + 'change_role/' + $(ele).data('role'),
                    success: function() {
                        window.location.reload();
                    }
                });
            }
            
            function allNotification() {
                $.ajax({
                    type: 'POST',
                    url: http_host_js + 'mark_all_notification_read',
                    success: function() {
                        checkNotification(<?php echo $this->session->userdata('last_notification_id'); ?>);
                    }
                });
            }
            
            $(document).ready(function(){
                checkNotification(<?php echo $this->session->userdata('last_notification_id'); ?>);
            });
            
            function toastrSetting(){
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
            }
            
            function checkNotification(last_id){
                $.ajax({
                    type : 'POST',
                    url : http_host_js+'checkNotification/' + last_id,
                    dataType : 'JSON',
                    success: function(data) {
                        $('#notification_count').html(data.notification_count);
                         
                        if(data.notification == 'true'){
                            toastrSetting();
                            $.each(data, function(i, item) {
                                if(item.type == 'success'){
                                    toastr.success(item.message);
                                }
                        
                                if(item.type == 'info'){
                                    toastr.info(item.message);
                                }
                                
                                if(data.notification_count >5){
                                    $('ul#notifications li:last-child').animate({height: 0}, 1000,"swing",function() {
                                        $(this).remove();
                                    })
                                }
                        
                                $(item.notification).hide().prependTo('ul#notifications').slideDown("slow");
                            })
                        }

                        setTimeout(function() {
                            checkNotification(data.lastid);
                        }, 10000);
                        
                    }
                });
            }
            
            //window.setInterval(function(){ checkNotification();},5000);
        </script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="tooltips">
        <!-- Wrapper -->
        <div class="wrapper">
            <!-- Top Nav -->
            <div class="top-navbar">
                <div class="top-navbar-inner">
                    <div class="logo-brand">
                        <a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="MYLUDOSPORT"><img src="<?php echo IMG_URL; ?>myludosport_logo.png" alt="My Ludosport logo"></a>
                    </div>

                    <div class="top-nav-content">
                        <div class="btn-collapse-sidebar-left">
                            <i class="fa fa-long-arrow-right icon-dinamic"></i>
                        </div>

                        <ul class="nav-user navbar-right">
                            <?php if (count($session->all_roles) > 1) { ?>
                                <li class="dropdown pull-left">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php echo $this->lang->line('role'); ?>,&nbsp;<strong><?php echo getRoleName($session->role); ?></strong>
                                    </a>
                                    <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
                                        <?php foreach ($session->all_roles as $role) { ?>
                                            <li><a href="javascript:;" onclick="UpdateRole(this)" class="role" data-role ="<?php echo $role; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo ucwords(getRoleName($role)); ?>"><?php echo ucwords(getRoleName($role)); ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            <?php } ?>
                            <li class="dropdown pull-left">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $session->avtar; ?>" class="avatar img-circle" alt="<?php echo $session->name; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo $session->name; ?>">
                                    <?php echo $this->lang->line('hello'); ?>, <strong><?php echo $session->name; ?></strong>
                                </a>
                                <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
                                    <?php if (hasPermission('profiles', 'viewProfile')) { ?>
                                        <li><a href="<?php echo base_url() . 'profile'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('profile'); ?>"><?php echo $this->lang->line('profile'); ?></a></li>
                                    <?php } ?>

                                    <?php if (hasPermission('profiles', 'changePassword')) { ?>
                                        <li><a href="<?php echo base_url() . 'change_password'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('change_password'); ?>"><?php echo $this->lang->line('change_password'); ?></a></li>
                                    <?php } ?> 
                                    <div class="divider"></div>
                                    <li><a href="<?php echo base_url() . 'logout'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('logout'); ?>"><?php echo $this->lang->line('logout'); ?></a></li>
                                </ul>
                            </li>
                        </ul>

                        <div class="collapse navbar-collapse" id="main-fixed-nav">
                            <ul class="nav navbar-nav navbar-left">
                                <li class="dropdown">
                                    <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
                                        <?php
                                        $languages = $this->config->item('custom_languages');
                                        ?>
                                        <span class="badge badge-primary icon-count" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo ucwords($languages[$session->language]); ?>"><?php echo strtoupper($session->language); ?></span>
                                        <i class="fa fa-tasks"></i>
                                    </a>
                                    <ul class="dropdown-menu square with-triangle">
                                        <li>
                                            <div class="nav-dropdown-heading">
                                                <?php echo $this->lang->line('languages'); ?>
                                            </div>
                                            <div class="nav-dropdown-content scroll-nav-dropdown">
                                                <ul>
                                                    <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
                                                        <li class="<?php echo ($session->language == $key) ? 'unread' : ''; ?>"><a href="javascript:;" onclick="UpdateLang(this)" class="language" data-lang ="<?php echo $key; ?>" data-toggle="tooltip" data-original-title="<?php echo ucwords($value); ?>"><?php echo ucwords($value); ?></a></li>
                                                    <? } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="badge badge-primary icon-count" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('notifications'); ?>" id="notification_count"></span>
                                        <i class="fa fa-bell-o"></i>
                                    </a>
                                    <ul class="dropdown-menu square with-triangle">
                                        <li>
                                            <div class="nav-dropdown-heading">
                                                <?php echo $this->lang->line('notifications'); ?>
                                                <div class="pull-right">
                                                    <a href="javascript:;" onclick="allNotification()" class="pull-right"  data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('read_all'), ' ', $this->lang->line('notifications'); ?>"><?php echo $this->lang->line('read_all'); ?></a>
                                                </div>

                                            </div>
                                            <div class="nav-dropdown-content scroll-nav-dropdown">
                                                <ul id="notifications">
                                                    <?php echo getNotifications($session->id); ?>
                                                </ul>
                                            </div>
                                            <a href="<?php echo base_url() . 'notification' ?>" class="padding-killer"><button class="btn btn-primary btn-square btn-block"><?php echo $this->lang->line('see_all'), ' ', $this->lang->line('notifications'); ?></button></a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.Top Nav -->

            <!-- BEGIN SIDEBAR LEFT -->
            <?php $page = ($this->uri->segment(1) ? $this->uri->segment(1) : 'dashboard'); ?>
            <div class="sidebar-left sidebar-nicescroller">
                <ul class="sidebar-menu">
                    <li class="static left-profile-summary">
                        <div class="media">
                            <p class="pull-left">
                                <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $session->avtar; ?>" class="avatar img-circle" alt="<?php echo $session->name; ?>" data-toggle="tooltip" data-original-title="<?php echo $session->name; ?>">

                            </p>
                            <div class="media-body">
                                <h4>
                                    <?php echo $this->lang->line('hello'); ?>
                                    <br />
                                    <strong><?php echo $session->name; ?></strong>
                                </h4>
                                <button class="btn btn-success btn-xs"><i class="fa fa-cog"></i></button><a href="<?php echo base_url() . 'logout'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('logout'); ?>" class="logout-action"> <button class="btn btn-danger btn-xs"><?php echo $this->lang->line('logout'); ?></button></a>
                            </div>
                        </div>
                    </li>

                    <li class="<?php echo ($page == 'dashboard') ? 'active selected' : ''; ?>"><a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('dashboard'); ?>"><i class="fa fa-dashboard icon-sidebar"></i><?php echo $this->lang->line('dashboard'); ?></a></li>

                    <?php if ($session->status == 'A') { ?>
                        <li class="static"><?php echo $this->lang->line('activity'); ?></li>

                        <?php if (hasPermission('academies', 'viewAcademy')) { ?>
                            <li class="<?php echo ($page == 'academy') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'academy'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('academy'); ?>"><i class="fa fa-font icon-sidebar"></i><?php echo $this->lang->line('academy'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('schools', 'viewSchool')) { ?>   
                            <li class="<?php echo ($page == 'school') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'school'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('school'); ?>"><i class="fa fa-university icon-sidebar"></i><?php echo $this->lang->line('school'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('clans', 'viewClan')) { ?>
                            <li class="<?php echo ($page == 'clan') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'clan'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('clan'); ?>"><i class="fa fa-users icon-sidebar"></i><?php echo $this->lang->line('clan'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('users', 'viewUser')) { ?>
                            <li class="<?php echo ($page == 'user') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'user'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('user'); ?>"><i class="fa fa-user icon-sidebar"></i><?php echo $this->lang->line('user'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('events', 'viewEvent')) { ?>
                            <li class="<?php echo ($page == 'event') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'event'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('event'); ?>"><i class="glyphicon glyphicon-star-empty icon-sidebar"></i><?php echo $this->lang->line('event'); ?></a></li>
                        <?php } ?>

                        <li class="static"><i class="fa fa-cogs icon-sidebar"></i>&nbsp;<?php echo $this->lang->line('setting'); ?></li>

                        <?php if (hasPermission('levels', 'viewLevel')) { ?>   
                            <li class="<?php echo ($page == 'level') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'level'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('level'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('level'); ?></a></li>
                        <?php } ?>                     

                        <?php if (hasPermission('eventcategories', 'viewEventcategory')) { ?>
                            <li class="<?php echo ($page == 'eventcategory') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'eventcategory'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('eventcategory'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('eventcategory'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('roles', 'viewRole')) { ?>
                            <li class="<?php echo ($page == 'role') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'role'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('role'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('role'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('emails', 'viewEmail')) { ?>
                            <li class="<?php echo ($page == 'email') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'email'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('email_template'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('email_template'); ?></a></li>
                        <?php } ?>

                        <?php if (hasPermission('countries', 'viewCountry') || hasPermission('states', 'viewStates') || hasPermission('cities', 'viewCity')) { ?>
                            <li class="<?php echo ($page == 'country' || $page == 'state' || $page == 'city') ? 'active selected' : ''; ?>">
                                <a href="javascript:;" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('location'); ?>">
                                    <i class="fa fa-wrench icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('location'); ?>
                                </a>
                                <ul class="submenu">
                                    <?php if (hasPermission('countries', 'viewCountry')) { ?>
                                        <li><a href="<?php echo base_url() . 'country'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('country'); ?>"><?php echo $this->lang->line('country'); ?></a></li>
                                    <?php } ?>

                                    <?php if (hasPermission('states', 'viewState')) { ?>
                                        <li><a href="<?php echo base_url() . 'state'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('state'); ?>"><?php echo $this->lang->line('state'); ?></a></li>
                                    <?php } ?>

                                    <?php if (hasPermission('cities', 'viewCity')) { ?>
                                        <li><a href="<?php echo base_url() . 'city'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('city'); ?>"><?php echo $this->lang->line('city'); ?></a></li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <!-- END SIDEBAR LEFT -->

            <!-- BEGIN PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid">
                    <?php if ($this->session->flashdata('success') != '') { ?>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success fade in alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <p class="text-center">
                                        <?php echo parse_smileys($this->session->flashdata('success'), IMG_URL . "smileys/"); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('warning') != '') { ?>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="alert alert-warning fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <?php echo parse_smileys($this->session->flashdata('warning'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('info') != '') { ?>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="alert alert-info fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <?php echo parse_smileys($this->session->flashdata('info'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error') != '') { ?>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="alert alert-danger fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <?php echo parse_smileys($this->session->flashdata('error'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo @$content_for_layout; ?>
                </div>
                <!-- BEGIN FOOTER -->
                <footer>
                    &copy; 2014Ludosport<a href="#fakelink"></a><br />
                </footer>
                <!-- END FOOTER -->
            </div>
            <!-- /.page-content -->
        </div>
        <!-- /.wrapper -->

        <script src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>retina/retina.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>nicescroll/jquery.nicescroll.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>backstretch/jquery.backstretch.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>skycons/skycons.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>prettify/prettify.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>owl-carousel/owl.carousel.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>chosen/chosen.jquery.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>icheck/icheck.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>timepicker/bootstrap-timepicker.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>mask/jquery.mask.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>summernote/summernote.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>markdown/markdown.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>markdown/to-markdown.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>markdown/bootstrap-markdown.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>slider/bootstrap-slider.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>toastr/toastr.js"></script>
        <script src="<?php echo JS_URL; ?>apps.js"></script>

    </body>
</html>