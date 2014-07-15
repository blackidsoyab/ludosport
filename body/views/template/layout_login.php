<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap -->
        <link href="<?php echo CSS_URL; ?>bootstrap.css" rel="stylesheet" media="screen">
        <!-- custom -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet" media="screen">
        <link href="<?php echo CSS_URL; ?>signin.css" rel="stylesheet" media="screen">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo JS_URL; ?>jq.js"></script>
        <script src="<?php echo JS_URL; ?>jquery.validate.js" type="text/javascript"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
          <script src="js/respond.js"></script>
        <![endif]-->
    </head>
    <body style="background: url('http://www.wallscorner.com/walls/galaxy-iv-wallpaper-wide.jpg')">
        <div class="container">
            <!--Header-->
            <div class="row padding-killer margin-killer"">
                <div class="container padding-killer">
                    <div class="project-logo-area">
                        <h1 class="text-center">ACL Interface Demo</h1>
                    </div>
                </div>   	
            </div>
            <!--/Header-->

            <!--Main Container-->
            <div class="">
                <?php echo @$content_for_layout; ?>
            </div>
            <!--Main Container-->

            <div class="text-center footer-style">
                <hr />
                <!--/Navigation Bar-->
                Copyrights &copy; <?php echo date('Y'); ?> | Powered By <a href="#">BlackIDSolutions</a>
            </div>
        </div>
    </body>
</html>
