<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo @$page_title . ' | MyLudosport'; ?></title>

        <link href="<?php echo CSS_URL; ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style.css" rel="stylesheet">
        <link href="<?php echo CSS_URL; ?>style-responsive.css" rel="stylesheet">
        <link href="<?php echo PLUGIN_URL; ?>datepicker/datepicker.min.css" rel="stylesheet">

        <script src="<?php echo JS_URL; ?>jquery.min.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js"></script>
        <script src="<?php echo PLUGIN_URL; ?>datepicker/bootstrap-datepicker.js"></script>
        <script src="<?php echo JS_URL; ?>bootstrap.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login tooltips">
        <div class="login-header text-center">
            <img src="<?php echo IMG_URL; ?>logo-login.png" class="logo" alt="Logo">
        </div>
        <div class="login-wrapper">
            <?php if ($this->session->flashdata('success') != '') { ?>
                <div>&nbsp;</div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-success fade in alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
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
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <p class="text-center">
                            <?php echo parse_smileys($this->session->flashdata('error'), IMG_URL . "smileys/"); ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
            <?php echo @$content_for_layout; ?>
        </div>
    </body>
</html>