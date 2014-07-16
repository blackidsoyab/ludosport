<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="utf-8">
        <title><?php echo @$page_title . ' |  My LudoSport'; ?></title>

        <link href="<?php echo CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">

        <link href="<?php echo CSS_URL; ?>style-responsive.css" rel="stylesheet">

        <script src="<?php echo JS_URL; ?>jquery.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datatable/js/bootstrap.datatable.js"></script>
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
        <link href="<?php echo PLUGIN_URL; ?>slider/slider.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>jquery.confirm.css" rel="stylesheet" />
        <script src="<?php echo JS_URL; ?>jquery.confirm.js" type="text/javascript"></script>
        <?php echo smiley_js(); ?>
        <script>
            var http_host_js = '<?php base_url(); ?>';
        </script>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="tooltips">

        <!-- BEGIN PANEL DEMO -->
        <div class="box-demo"></div>
        <!-- END PANEL DEMO -->

        <div class="wrapper">
            <!-- BEGIN TOP NAV -->
            <div class="top-navbar">
                <div class="top-navbar-inner">

                    <!-- Begin Logo brand -->
                    <div class="logo-brand">
                        <a href="index.html"><img src="<?php echo IMG_URL; ?>sentir-logo-primary.png" alt="Sentir logo"></a>
                    </div><!-- /.logo-brand -->
                    <!-- End Logo brand -->

                    <div class="top-nav-content">

                        <!-- Begin button sidebar left toggle -->
                        <div class="btn-collapse-sidebar-left">
                            <i class="fa fa-long-arrow-right icon-dinamic"></i>
                        </div><!-- /.btn-collapse-sidebar-left -->
                        <!-- End button sidebar left toggle -->

                        <!-- Begin button sidebar right toggle --><!-- /.btn-collapse-sidebar-right -->
                        <!-- End button sidebar right toggle -->

                        <!-- Begin button nav toggle -->
                        <div class="btn-collapse-nav" data-toggle="collapse" data-target="#main-fixed-nav">
                            <i class="fa fa-plus icon-plus"></i>
                        </div><!-- /.btn-collapse-sidebar-right -->
                        <!-- End button nav toggle -->


                        <!-- Begin user session nav -->
                        <ul class="nav-user navbar-right">
                            <li class="dropdown">
                                <a href="my-profile.html" class="dropdown-toggle" >
                                    <img src="<?php echo IMG_URL; ?>avatar/avatar-1.jpg" class="avatar img-circle" alt="Avatar">
                                    Hi, <strong>Paris Hawker</strong>
                                </a>
                            </li>
                        </ul>
                        <!-- End user session nav -->
                    </div><!-- /.top-nav-content -->
                </div><!-- /.top-navbar-inner -->
            </div><!-- /.top-navbar -->
            <!-- END TOP NAV -->



            <!-- BEGIN SIDEBAR LEFT -->
            <?php $page = ($this->uri->segment(1) ? $this->uri->segment(1) : 'dashboard'); ?>
            <div class="sidebar-left sidebar-nicescroller">
                <ul class="sidebar-menu">
                    <li class="<?php echo ($page == 'dashboard') ? 'active selected' : ''; ?>"><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard icon-sidebar"></i>Dashboard</a></li>
                    <li class="<?php echo ($page == 'permission' || $page == 'role') ? 'active selected' : ''; ?>">
                        <a href="javascript:;">
                            <i class="fa fa-table icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                            Access Management
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url() . 'permission'; ?>">Permission</a></li>
                            <li><a href="<?php echo base_url() . 'role'; ?>">Roles</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo ($page == 'country' || $page == 'states' || $page == 'city') ? 'active selected' : ''; ?>">
                        <a href="javascript:;">
                            <i class="fa fa-table icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                            Location Management
                        </a>
                        <ul class="submenu">
                            <li><a href="<?php echo base_url() . 'country'; ?>">Country</a></li>
                            <li><a href="<?php echo base_url() . 'states'; ?>">State</a></li>
                            <li><a href="<?php echo base_url() . 'city'; ?>">City</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END SIDEBAR LEFT -->

            <!-- BEGIN PAGE CONTENT -->
            <div class="page-content">

                <!-- BEGIN container-fluid -->
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

                    <?php if ($this->session->flashdata('danger') != '') { ?>
                        <div>&nbsp;</div>
                        <div class="row">
                            <div class="alert alert-danger fade in alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <p class="text-center">
                                    <?php echo parse_smileys($this->session->flashdata('danger'), IMG_URL . "smileys/"); ?>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                    <?php echo @$content_for_layout; ?>
                </div>
                <!-- END container-fluid -->

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
        <script src="<?php echo JS_URL; ?>apps.js"></script>

    </body>
</html>