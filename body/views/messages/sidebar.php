<?php $session = $this->session->userdata('user_session'); ?>
<div class="mail-apps-wrap margin-killer">
    <div class="the-box toolbar no-border margin-killer">
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group">
                <p class="h1 margin-killer <?php echo ($session->role < 6) ? 'text-black' : 'text-white padding-killer';?>"><i class="fa fa-envelope icon-lg icon-circle icon-bordered"></i> <?php echo @$view_title; ?></p>
            </div>
            <div class="btn-group pull-right">
                <button data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" type="button" class="btn btn-primary" id="delete_messages_button"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>
    </div>
    <?php $page = ($this->uri->segment(2) ? $this->uri->segment(2) : 'inbox'); ?>
    <div class="the-box margin-killer no-border">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="list-group primary square no-border">

                    <a href="<?php echo base_url() . 'message/compose'; ?>" class="list-group-item btn btn-primary <?php echo ($page == 'compose') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('compose'), ' ', $this->lang->line('message'); ?>"><?php echo $this->lang->line('compose'), ' ', $this->lang->line('message'); ?></a>

                    <hr class="mail-tab-hr"/>

                    <a href="<?php echo base_url() . 'message'; ?>" class="list-group-item <?php echo ($page == 'inbox') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('inbox'); ?>"><?php echo $this->lang->line('inbox'); ?> <?php echo ($count_inbox != 0) ? '<span class="badge badge-primary">' . $count_inbox .'</span>' : '&nbsp;'; ?></a>

                    <a href="<?php echo base_url() . 'message/sent'; ?>" class="list-group-item <?php echo ($page == 'sent') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('sent'); ?>"><?php echo $this->lang->line('sent'); ?> <?php echo ($count_sent != 0) ? '<span class="badge badge-success">' . $count_sent .'</span>' : '&nbsp;'; ?></a>

                    <a href="<?php echo base_url() . 'message/trash'; ?>" class="list-group-item <?php echo ($page == 'trash') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('trash'); ?>"><?php echo $this->lang->line('trash'); ?> <?php echo ($count_trash != 0) ? '<span class="badge badge-danger">' . $count_trash .'</span>' : '&nbsp;'; ?></a>

                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <?php echo $message_page_layout; ?>
            </div>
        </div>
    </div>
</div>