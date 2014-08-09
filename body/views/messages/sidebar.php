<div class="mail-apps-wrap">
    <div class="the-box toolbar no-border no-margin">
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group">
                <p class="h1"><?php echo @$view_title; ?></p>
            </div>
            <div class="btn-group pull-right">
                <button data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </div>
        </div>
    </div>
    <?php $page = ($this->uri->segment(2) ? $this->uri->segment(2) : 'inbox'); ?>
    <div class="the-box no-margin">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="list-group primary square no-border">

                    <a href="<?php echo base_url() . 'message/compose'; ?>" class="list-group-item btn btn-primary <?php echo ($page == 'compose') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('compose'), ' ', $this->lang->line('message'); ?>"><?php echo $this->lang->line('compose'), ' ', $this->lang->line('message'); ?></a>

                    <hr class="mail-tab-hr"/>

                    <a href="<?php echo base_url() . 'message'; ?>" class="list-group-item <?php echo ($page == 'inbox') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('inbox'); ?>"><?php echo $this->lang->line('inbox'); ?> <span class="badge badge-primary"><?php echo $count_inbox; ?></span></a>

                    <a href="<?php echo base_url() . 'message/sent'; ?>" class="list-group-item <?php echo ($page == 'sent') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('sent'); ?>"><?php echo $this->lang->line('sent'); ?> <span class="badge badge-success"><?php echo $count_sent; ?></span></a>

                    <a href="<?php echo base_url() . 'message/draft'; ?>" class="list-group-item <?php echo ($page == 'draft') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('draft'); ?>"><?php echo $this->lang->line('draft'); ?> <span class="badge badge-warning"><?php echo $count_draft; ?></span></a>

                    <a href="<?php echo base_url() . 'message/trash'; ?>" class="list-group-item <?php echo ($page == 'trash') ? 'active' : ''; ?>" data-toggle="tooltip" title="<?php echo $this->lang->line('trash'); ?>"><?php echo $this->lang->line('trash'); ?> <span class="badge badge-danger"><?php echo $count_trash; ?></span></a>

                </div>
            </div>
            <div class="col-sm-8 col-md-9">
                <?php echo $message_page_layout; ?>
            </div>
        </div>
    </div>
</div>