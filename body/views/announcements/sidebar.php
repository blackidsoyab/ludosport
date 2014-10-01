<?php $session = $this->session->userdata('user_session'); ?>
<div class="mail-apps-wrap margin-killer">
    <div class="the-box toolbar no-border no-margin heading padding-killer">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="margin-killer <?php echo ($session->role < 6) ? 'text-black' : 'text-white padding-killer';?>"><i class="fa fa-bullhorn icon-lg icon-circle icon-bordered"></i> <?php echo @$view_title; ?></h3>
            </div>
        </div>
    </div>
    <?php if($session->role < 6) { ?>
        <?php $page = ($this->uri->segment(2) ? $this->uri->segment(2) : 'inbox'); ?>
        <div class="the-box toolbar no-border no-margin">
            <div class="btn-toolbar" role="toolbar">
                <div class="btn-group">
                    <a href="<?php echo base_url() . 'announcement/compose'; ?>" class="list-group-item <?php echo ($page == 'compose') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('new'), ' ', $this->lang->line('announcement'); ?>"><?php echo $this->lang->line('new'), ' ', $this->lang->line('announcement'); ?></a>
                </div>

                <div class="btn-group">
                     <a href="<?php echo base_url() . 'announcement'; ?>" class="list-group-item <?php echo ($page == 'inbox') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('inbox'); ?>"><?php echo $this->lang->line('inbox'); ?></a>
                </div>

                <div class="btn-group">
                    <a href="<?php echo base_url() . 'announcement/sent'; ?>" class="list-group-item <?php echo ($page == 'sent') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('sent'); ?>"><?php echo $this->lang->line('sent'); ?></a>
                </div>

                <div class="btn-group">
                    <a data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" class="list-group-item" id="delete_announcements_button"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="the-box margin-killer no-border">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <?php echo $announcement_page_layout; ?>
            </div>
        </div>
    </div>
</div>