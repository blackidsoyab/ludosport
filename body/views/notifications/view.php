<div class="row">
    <div class="col-lg-12">
        <h1 class="page-heading h1"><?php echo $this->lang->line('view_all'), ' ', $this->lang->line('notifications'); ?></h1>  
    </div>
</div>

<div class="row">

    <?php
    foreach ($notifications as $notify) {
        if ($notify->type == 'N') {
            $user_info = userNameAvtar($notify->from_id);
            $message = getMessageTemplate($notify->notify_type, $user_info['name']);
            $img = '<img src="' . $user_info['avtar'] . '" class="media-object img-circle" alt="Avatar">';
        } else {
            $message = getMessageTemplate($notify->notify_type);
            $img = '<i class="fa fa-3x fa-info-circle"></i>';
        }
        ?>
        <div class="col-sm-6">
            <!-- BEGIN USER CARD LONG -->
            <div class="the-box no-border">
                <div class="media user-card-sm">
                    <a class="pull-left">
                        <?php echo $img; ?>
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $message; ?></h4>
                        <p class="text-primary"><?php echo time_elapsed_string($notify->timestamp); ?></p>
                    </div>

                    <div class="right-button">
                        <a href="<?php echo makeURL($notify->notify_type, $notify->object_id); ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="<?php echo $message; ?>" class="btn btn-primary"><i class="fa fa-share"></i></a>
                    </div>
                </div>
            </div><!-- /.the-box .no-border -->
            <!-- BEGIN USER CARD LONG -->
        </div>
    <?php } ?>
</ul>
</div>