<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
<div class="alert alert-primary alert-block square"><?php echo $this->lang->line('numbers'); ?></div>