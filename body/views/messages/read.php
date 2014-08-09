<h4><?php echo $messages_data[0]->subject; ?></h4>
<?php foreach ($messages_data as $message) { ?>
    <div class="panel panel-transparent panel-square">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a class="block-collapse" data-toggle="collapse" href="<?php echo '#read-mail-' . $message->id; ?>">
                    <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $message->avtar; ?>" class="avatar img-circle" alt="Avatar"> 
                    <strong><?php echo $message->sender; ?></strong> to me
                    <span class="right-content">
                        <span class="time"><?php echo time_elapsed_string($message->timestamp); ?></span>
                    </span>
                </a>
            </h3>
        </div>
        <div id="<?php echo 'read-mail-' . $message->id; ?>" class="border-bottom collapse <?php echo ($id == $message->id) ? 'in' : ''; ?>">
            <div class="panel-body">
                <?php echo $message->message; ?>
            </div>
        </div>
    </div>
<?php } ?>
<?php if ($messages_data[0]->type == 'single') { ?>
    <div class="box-reply">
        <a href="<?php echo base_url() . 'message/reply/' . $messages_data[0]->id; ?>">Reply</a>
    </div>
<?php } ?>