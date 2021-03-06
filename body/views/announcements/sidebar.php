<?php $session = $this->session->userdata('user_session'); ?>
<div class="mail-apps-wrap margin-killer">

    <div class="the-box toolbar no-border margin-killer">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <p class="nowrap overflow-hidden overflow-text-dot h1 margin-killer <?php echo ($session->role < 6) ? 'text-black' : 'text-white padding-killer';?>"><i class="fa fa-bullhorn"></i> <?php echo ($session->role != 6) ? @$view_title : $this->lang->line('student_dashboard_announcement_title'); ?></p>
            </div>
        </div>
    </div>

    <?php if($session->role < 6) { ?>
        <?php $page = ($this->uri->segment(2) ? $this->uri->segment(2) : 'inbox'); ?>
        <div class="the-box toolbar no-border no-margin">
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <a href="<?php echo base_url() . 'announcement/compose'; ?>" class="btn btn-primary btn-block <?php echo ($page == 'compose') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('new'), ' ', $this->lang->line('announcement'); ?>"><?php echo $this->lang->line('new'), ' ', $this->lang->line('announcement'); ?></a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <a href="<?php echo base_url() . 'announcement'; ?>" class="btn btn-primary btn-block <?php echo ($page == 'inbox') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('inbox'); ?>"><?php echo $this->lang->line('inbox'); ?></a>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-2">
                    <a href="<?php echo base_url() . 'announcement/sent'; ?>" class="btn btn-primary btn-block <?php echo ($page == 'sent') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('sent'); ?>"><?php echo $this->lang->line('sent'); ?></a>
                </div>
                <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                    <a data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" class="btn btn-primary btn-block" id="delete_announcements_button"><i class="fa fa-trash-o"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="the-box margin-killer no-border">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php echo $announcement_page_layout; ?>
            </div>
        </div>
    </div>
</div>