<?php $session = $this->session->userdata('user_session'); ?>
<h4><?php echo $messages_data[0]->subject; ?></h4>
<?php foreach ($messages_data as $message) { ?>
    <div class="panel panel-transparent panel-square">
        <div class="panel-heading">
            <h3 class="panel-title">
                <a class="block-collapse" data-toggle="collapse" href="<?php echo '#read-mail-' . $message->id; ?>">
                    <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $message->from_avtar; ?>" class="avatar img-circle" alt="Avatar">
                    <span class="">
                        <?php if ($session->id != $message->from_id) {  echo $message->from_person; } else { echo 'Me'; } ?>
                        &nbsp;to&nbsp; 
                        <?php if ($message->type == 'single' && $session->id != $message->to_id) { ?>
                        <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $message->to_avtar; ?>" class="avatar img-circle" alt="Avatar">
                        <?php echo $message->to_person; } else {
                            if ($message->type == 'single'){
                                echo 'Me';
                            }else if ($message->type == 'group'){
                                $group = explode('_', $message->group_id);
                                echo '<span class="label label-warning">' ,ucwords($group[0]) , ' group</span>';
                            }
                        }
                        ?>
                    </span>
                    <span class="message-right-content">
                        <span class="time"><?php echo time_elapsed_string($message->timestamp); ?></span>
                    </span>
                </a>
            </h3>
        </div>

        <div id="<?php echo 'read-mail-' . $message->id; ?>" class="border-bottom collapse <?php echo ($id == $message->id) ? 'in' : ''; ?>">
            <div class="panel-body">
                <?php echo $message->message; ?>
            </div>

            <?php if(messageHasAttachments($message->id)){ ?>
            <div class="panel-footer">
                <p><strong><?php echo $this->lang->line('attachmments'); ?> :</strong></p>
                <ul class="attachment-list">
                <?php
                    foreach (getMessageAttachments($message->id) as $value) {
                       echo '<li><a href="'.base_url() .'message/attachmment/download/'. $value->id .'">'.$value->original_name.'</a> - <small>'.$value->file_size.' Kb</small></li>';
                    }
                ?>
                </ul>
            </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>
<div class="box-reply">
    <a href="<?php echo base_url() . 'message/reply/' . $messages_data[0]->id; ?>">Reply</a>
</div>