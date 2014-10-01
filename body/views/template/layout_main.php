<!DOCTYPE html>
<html lang="it">
    <head>
        <?php $session = $this->session->userdata('user_session'); ?>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo @$page_title . ' |' . $this->config->item('app_name'); ?></title>

        <!-- Main CSS -->
        <link href="<?php echo CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style-responsive.css" rel="stylesheet">

        <!-- Plugins CSS -->
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
        <link href="<?php echo PLUGIN_URL; ?>datatable/css/bootstrap.datatable.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>morris-chart/morris.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>c3-chart/c3.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>toastr/toastr.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>validator/bootstrapValidator.css" />
        <link href="<?php echo PLUGIN_URL; ?>fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>confirmbox/jquery.confirm.css" rel="stylesheet" />

        <!-- Custom CSS -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">

        <!-- Role CSS -->
        <?php if ($session->role > 0 && $session->role < 7) { ?>
            <link href="<?php echo CSS_URL . $session->role . '.css'; ?>" rel="stylesheet">
        <?php } ?>

        <script src="<?php echo JS_URL; ?>jquery.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>validator//bootstrapValidator.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/bootstrap.datatable.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>confirmbox/jquery.confirm.js"></script>

        <?php echo smiley_js(); ?>
        <script type="text/javascript">
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

            function allMessage() {
                $.ajax({
                    type: 'POST',
                    url: http_host_js + 'mark_all_message_read',
                    success: function() {
                        checkMessage(<?php echo $this->session->userdata('last_message_id'); ?>);
                    }
                });
            }

            $(document).ready(function(){
                checkNotification(<?php echo $this->session->userdata('last_notification_id'); ?>);
                checkMessage(<?php echo $this->session->userdata('last_message_id'); ?>);
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
                        }, <?php echo $this->config->item('notification_timer'); ?>);

                    }
                });
            }

            function checkMessage(last_id){
                $.ajax({
                    type : 'POST',
                    url : http_host_js+'checkMessage/' + last_id,
                    dataType : 'JSON',
                    success: function(data) {
                        $('#message_count').html(data.message_count);

                        if(data.message == 'true'){
                            toastrSetting();
                            $.each(data, function(i, item) {
                                if(item.type == 'success'){
                                    toastr.success(item.message_title);
                                }

                                if(data.message_count >5){
                                    $('ul#messages li:last-child').animate({height: 0}, 1000,"swing",function() {
                                        $(this).remove();
                                    })
                                }

                                $(item.message).hide().prependTo('ul#messages').slideDown("slow");
                            })
                        }

                        setTimeout(function() {
                            checkMessage(data.lastid);
                        }, <?php echo $this->config->item('notification_timer'); ?>);

                    }
                });
            }
        </script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="tooltips popovers">
        <!-- Wrapper -->
        <div class="wrapper">
            <!-- Top Nav -->
            <div class="top-navbar">
                <div class="top-navbar-inner">
                    <div class="logo-brand">
                        <a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="MYLUDOSPORT"><img src="<?php echo IMG_URL . $this->config->item('main_logo'); ?>" alt="<?php echo $this->config->item('app_name'); ?>" class="logo"></a>
                    </div>

                    <div class="top-nav-content">
                        <div class="btn-collapse-sidebar-left">
                            <i class="fa fa-long-arrow-right icon-dinamic"></i>
                        </div>

                        <ul class="nav-user navbar-right">
                            <?php if (count($session->all_roles) > 0) { ?>
                            <li class="dropdown pull-left role-selection">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php echo $this->lang->line('selected'), ' ', $this->lang->line('role'), ' : '; ?>&nbsp;<strong><?php echo $session->role_name; ?>&nbsp;&nbsp;<i class="fa fa-angle-right chevron-icon-sidebar"></i></strong>
                                </a>
                                <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
                                    <?php foreach ($session->all_roles as $role) { 
                                        $role_name = ucwords(getRoleName($role));
                                        ?>
                                        <li><a href="javascript:;" onclick="UpdateRole(this)" class="role" data-role ="<?php echo $role; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $role_name; ?>"><?php echo $role_name; ?></a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li class="dropdown pull-left">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $session->avtar; ?>" class="avatar img-circle" alt="<?php echo $session->logged_in_name; ?>" data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo $session->logged_in_name; ?>">
                                        <?php echo $this->lang->line('hello'); ?>, <strong data-placement="bottom" data-toggle="tooltip" data-original-title="<?php echo $session->logged_in_name; ?>"><?php echo $session->logged_in_name; ?></strong>
                                    </a>
                                    <ul class="dropdown-menu square primary margin-list-rounded with-triangle">
                                        <?php if (hasPermission('profiles', 'viewProfile')) { ?>
                                        <li><a href="<?php echo base_url() . 'profile'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('profile'); ?>"><?php echo $this->lang->line('profile'); ?></a></li>
                                        <?php } ?>

                                        <?php if (hasPermission('profiles', 'changeEmailPrivacy')) { ?>
                                        <li><a href="<?php echo base_url() . 'change_email_privacy'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('change_email_privacy'); ?>"><?php echo $this->lang->line('change_email_privacy'); ?></a></li>
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
                                            <?php $languages = $this->config->item('custom_languages'); ?>
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
                                                        <?php } ?>
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

                                    <li class="dropdown">
                                        <a href="#fakelink" class="dropdown-toggle" data-toggle="dropdown">
                                            <span class="badge badge-primary icon-count" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('messages'); ?>" id="message_count"></span>
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                        <ul class="dropdown-menu square with-triangle">
                                            <li>
                                                <div class="nav-dropdown-heading">
                                                    <?php echo $this->lang->line('messages'); ?>
                                                    <div class="pull-right">
                                                        <a href="javascript:;" onclick="allMessage()" class="pull-right"  data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $this->lang->line('read_all'), ' ', $this->lang->line('messages'); ?>"><?php echo $this->lang->line('read_all'); ?></a>
                                                    </div>

                                                </div>
                                                <div class="nav-dropdown-content scroll-nav-dropdown">
                                                    <ul id="messages">
                                                        <?php echo getMessages($session->id); ?>
                                                    </ul>
                                                </div>
                                                <a href="<?php echo base_url() . 'message' ?>" class="padding-killer"><button class="btn btn-primary btn-square btn-block"><?php echo $this->lang->line('see_all'), ' ', $this->lang->line('messages'); ?></button></a>
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
                <?php $page = ($this->uri->segment(1) ? $this->uri->segment(2) ? $this->uri->segment(2) : $this->uri->segment(1) : 'dashboard');  
                ?>
                <div class="sidebar-left sidebar-nicescroller">
                    <ul class="sidebar-menu">

                        <li class="<?php echo ($page == 'dashboard') ? 'active selected' : ''; ?>">
                            <a href="<?php echo base_url(); ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('dashboard'); ?>"><i class="fa fa-dashboard icon-sidebar"></i><?php echo $this->lang->line('dashboard'); ?></a>
                        </li>

                        <li class="<?php echo ($page == 'message') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'message'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('message'); ?>"><i class="fa fa-envelope icon-sidebar"></i><?php echo $this->lang->line('message'); ?></a></li>

                        <li class="<?php echo ($page == 'announcement') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'announcement'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('announcement'); ?>"><i class="fa fa-bullhorn icon-sidebar"></i><?php echo $this->lang->line('announcement'); ?></a></li>

                        <?php if ($session->status == 'A' && $session->role != 6) { ?>
                            <li class="static"><i class="fa fa-asterisk icon-sidebar"></i>&nbsp;<?php echo $this->lang->line('activity'); ?></li>

                            <?php if (hasPermission('studentratings', 'viewStudentrating')) { ?>
                            <li class="<?php echo ($page == 'ratting') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'studentrating'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('rating'); ?>"><i class="fa fa-star icon-sidebar"></i><?php echo $this->lang->line('rating'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('academies', 'viewAcademy')) { ?>
                            <li class="<?php echo ($page == 'academy') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'academy'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('academy'); ?>"><i class="fa fa-font icon-sidebar"></i><?php echo $this->lang->line('academy'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('schools', 'viewSchool')) { ?>   
                            <li class="<?php echo ($page == 'school') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'school'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('school'); ?>"><i class="fa fa-university icon-sidebar"></i><?php echo $this->lang->line('school'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('clans', 'viewClan')) { ?>
                            <li class="<?php echo ($page == 'clan') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'clan'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('clan'); ?>"><i class="fa fa-users icon-sidebar"></i><?php echo $this->lang->line('clan'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('clans', 'listTrialLessonRequest')) { ?>
                            <li class="<?php echo ($page == 'trial_lesson_request') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'clan/trial_lesson_request'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('trial_lesson'); ?>"><i class="glyphicon glyphicon-registration-mark icon-sidebar"></i><?php echo $this->lang->line('trial_lesson'); ?></a></li>
                            <?php } ?>

                             <?php if (hasPermission('users', 'viewUser')) { ?>
                            <li class="<?php echo ($page == 'user') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'user'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('user'); ?>"><i class="fa fa-user icon-sidebar"></i><?php echo $this->lang->line('user'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('events', 'viewEvent')) { ?>
                            <li class="<?php echo ($page == 'event') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'event'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('event'); ?>"><i class="fa fa-calendar icon-sidebar"></i><?php echo $this->lang->line('event'); ?></a></li>
                            <?php } ?>

                            <li class="<?php echo ($page == 'studentlist') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'clan/studentlist'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('student_list'); ?>"><i class="fa fa-users icon-sidebar"></i><?php echo $this->lang->line('pupil'); ?></a></li>

                            <?php if (hasPermission('clans', 'clanViewAttendance')) { ?>
                            <li class="<?php echo ($page == 'view_attendance') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'clan/view_attendance'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('view_attendance'); ?>"><i class="fa fa-book icon-sidebar"></i><?php echo $this->lang->line('view_attendance'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('batchrequests', 'viewBatchrequest')) { ?>
                            <li class="<?php echo ($page == 'batchrequest') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'batchrequest'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('batch_request'); ?>"><i class="fa fa-graduation-cap icon-sidebar"></i><?php echo $this->lang->line('batch_request'); ?></a></li>
                            <?php } ?>

                            <li class="static"><i class="fa fa-table icon-sidebar"></i>&nbsp;<?php echo $this->lang->line('setting'); ?></li>

                            <?php if (hasPermission('levels', 'viewLevel')) { ?>   
                            <li class="<?php echo ($page == 'level') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'level'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('level'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('level'); ?></a></li>
                            <?php } ?>                     

                            <?php if (hasPermission('eventcategories', 'viewEventcategory')) { ?>
                            <li class="<?php echo ($page == 'eventcategory') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'eventcategory'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('eventcategory'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('eventcategory'); ?></a></li>
                            <?php } ?>

                            <?php if (hasPermission('batches', 'viewBatch')) { ?>   
                            <li class="<?php echo ($page == 'batch') ? 'active selected' : ''; ?>"><a href="<?php echo base_url() . 'batch'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('batch'); ?>"><i class="fa fa-wrench icon-sidebar"></i><?php echo $this->lang->line('batch'); ?></a></li>
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

                            <?php if (hasPermission('systemsettings', 'viewSystemSetting')) { ?>
                                <li class="<?php echo ($page == 'system_setting') ? 'active selected' : ''; ?>">
                                    <a href="javascript:;" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('system_setting'); ?>">
                                        <i class="fa fa-wrench icon-sidebar"></i>
                                        <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                        <?php echo $this->lang->line('system_setting'); ?>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="<?php echo base_url() . 'system_setting/general'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('general'); ?>"><?php echo $this->lang->line('general'), ' ', $this->lang->line('setting'); ?></a></li>
                                        <li><a href="<?php echo base_url() . 'system_setting/mail'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('mail'); ?>"><?php echo $this->lang->line('mail'), ' ', $this->lang->line('setting'); ?></a></li>
                                    </ul>
                                </li>
                            <?php } ?>
                        <?php } else if($session->status == 'A' && $session->role == 6) { ?>
                            <li class="<?php echo ($page == 'history') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'history'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('history'); ?>">
                                    <i class="fa fa-graduation-cap icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('history'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'rating' || $page == 'rating_list') ? 'active selected' : ''; ?>">
                                <a href="javascript:;" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('rating'); ?>">
                                    <i class="fa fa-list icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('rating'); ?>
                                </a>
                                <ul class="submenu">
                                    <li><a href="<?php echo base_url(). 'rating'?>"><?php echo $this->lang->line('top_10'); ?></a></li>
                                    <li><a href="<?php echo base_url(). 'rating_list'?>"><?php echo $this->lang->line('list'); ?></a></li>
                                </ul>
                            </li>

                            <li class="<?php echo ($page == 'journal') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'journal'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('journal'); ?>">
                                    <i class="fa fa-book icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('journal'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'duels') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'duels'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('duels'); ?>">
                                    <i class="icon-sidebar"><img src="<?php echo IMG_URL; ?>icons/duels.png" width="24" height="24" alt=""></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('duels'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'evolution') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'evolution'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('evolution'); ?>">
                                    <i class="fa fa-leaf icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('evolution'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'events') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'event'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('events'); ?>">
                                    <i class="fa fa-calendar icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('events'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'news') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'news'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('news'); ?>">
                                    <i class="fa fa-bullhorn icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('news'); ?>
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'shop') ? 'active selected' : ''; ?>">
                                <a href="<?php echo base_url(). 'shop'?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('shop'); ?>">
                                    <i class="fa fa-shopping-cart icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    (<?php echo $this->lang->line('shop'); ?>)
                                </a>
                            </li>

                            <li class="<?php echo ($page == 'received' || $page == 'renewals' || $page == 'certificates') ? 'active selected' : ''; ?>">
                                <a href="#fakelink" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('administrations'); ?>">
                                    <i class="fa fa-table icon-sidebar"></i>
                                    <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                    <?php echo $this->lang->line('administrations'); ?>
                                </a>
                                <ul class="submenu">
                                    <li><a href="<?php echo base_url(). 'received'?>"><?php echo $this->lang->line('received'); ?></a></li>
                                    <li><a href="<?php echo base_url(). 'renewals'?>"><?php echo $this->lang->line('renewals'); ?></a></li>
                                    <li><a href="<?php echo base_url(). 'certificates'?>"><?php echo $this->lang->line('certificates'); ?></a></li>
                                </ul>
                            </li>
                            
                            <li class="static"><?php echo $this->lang->line('merchandising'); ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <!-- END SIDEBAR LEFT -->

            <!-- BEGIN PAGE CONTENT -->
            <div class="page-content">
                <div class="container-fluid" id="middle-section">
                    <?php if ($this->session->flashdata('success') != '') { ?>
                    <div class="row">
                        <div>&nbsp;</div>
                        <div class="col-lg-12">
                            <div class="auto-close alert alert-success fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <i class="fa fa-thumbs-o-up icon-sm"></i>
                                    <?php echo parse_smileys($this->session->flashdata('success'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('warning') != '') { ?>
                    <div class="row">
                        <div>&nbsp;</div>
                        <div class="col-lg-12">
                            <div class="auto-close alert alert-warning fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <i class="fa fa-warning icon-sm"></i>
                                    <?php echo parse_smileys($this->session->flashdata('warning'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('info') != '') { ?>
                    <div class="row">
                        <div>&nbsp;</div>
                        <div class="col-lg-12">
                            <div class="auto-close alert alert-info fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <i class="fa fa-info icon-sm"></i>
                                    <?php echo parse_smileys($this->session->flashdata('info'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error') != '') { ?>
                    <div class="row">
                        <div>&nbsp;</div>
                        <div class="col-lg-12">
                            <div class="auto-close alert alert-danger fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <i class="fa fa-thumbs-o-down icon-sm"></i>
                                    <?php echo parse_smileys($this->session->flashdata('error'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                    <?php echo @$content_for_layout; ?>
                </div>
                <!-- BEGIN FOOTER -->
                <footer id="footer" style="position:fixed">
                    &copy; <?php echo get_current_date_time()->year, ' ', $this->config->item('app_name'); ?><a href="#fakelink"></a><br />
                    Not associated with disney, lucasfilm ltd. Or any lfl ltd. Film or franchise.
                </footer>
                <!-- END FOOTER -->
            </div>
            <!-- /.page-content -->
        </div>
        <!-- /.wrapper -->

        <div id="back-top" style="display: block;">
            <a href="#top"><i class="fa fa-chevron-up"></i></a>
        </div>

        <script src="<?php echo JS_URL; ?>bootstrap.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>retina/retina.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>nicescroll/jquery.nicescroll.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>prettify/prettify.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>magnific-popup/jquery.magnific-popup.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>owl-carousel/owl.carousel.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>chosen/chosen.jquery.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>icheck/icheck.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>timepicker/bootstrap-timepicker.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>mask/jquery.mask.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>summernote/summernote.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>toastr/toastr.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>fullcalendar/lib/jquery-ui.custom.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>fullcalendar/fullcalendar/fullcalendar.js"></script>
        <script src="<?php echo JS_URL; ?>apps.js"></script>
    </body>
    </html>