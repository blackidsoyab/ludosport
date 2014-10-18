<?php $session = $this->session->userdata('user_session'); ?>
<h3><?php echo $announcement_data->subject; ?></h3>
<div class="panel panel-transparent panel-square">
    <div class="panel-heading padding-left-killer">
        <h3 class="panel-title">
            <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $announcement_data->from_avtar; ?>" class="avatar img-circle margin-left-killer" alt="Avatar">

            <?php if ($session->id != $announcement_data->from_id) { ?>
                <a href="<?php echo base_url() . 'profile/view/' . $announcement_data->from_id; ?>"><?php echo $announcement_data->from_person; ?></a>
            <?php } else { echo 'Me'; } ?>

            <span>&nbsp;to&nbsp;</span> 

            <?php if ($announcement_data->type == 'single' && $session->id != $announcement_data->to_id) { ?>
                <img src="<?php echo IMG_URL . 'user_avtar/40X40/' . $announcement_data->to_avtar; ?>" class="avatar img-circle" alt="Avatar"> 
                <a href="<?php echo base_url() . 'profile/view/' . $announcement_data->to_id; ?>"><?php echo $announcement_data->to_person; ?></a>
            <?php } else {
                if ($announcement_data->type == 'single'){
                    echo '<span>Me</span> ';
                }else if ($announcement_data->type == 'group'){
                    $group = explode('_', $announcement_data->group_id);
                    if($group[0] == 'clans'){
                        echo '<span class="label label-warning">',  $this->lang->line('clan'), ' : '  , getClanName($group[1]) , '</span>';
                    }else {
                        echo '<span class="label label-warning">' ,ucwords($group[0]) , ' group</span>';    
                    }
                }
            } ?>
            <span class="message-right-content">
                <span class="time"><?php echo time_elapsed_string($announcement_data->timestamp); ?></span>
            </span>
        </h3>
    </div>
    <div class="panel-body padding-left-killer">
        <?php echo $announcement_data->announcement; ?>
    </div>
</div>