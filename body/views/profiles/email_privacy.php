<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('change_email_privacy'); ?></h1>
<div class="the-box">

    <form id="form" method="post" class="form-horizontal" action="<?php echo base_url() . 'change_email_privacy'; ?>">
    	<?php foreach ($emails as $email_key => $email_value) { ?>
    		<div class="form-group">
	            <label for="question" class="col-lg-4 control-label">
	                <?php echo  $email_value; ?>
	            </label>
	            <div class="col-lg-5">
	                <div class="radio pull-left margin-killer padding-left-killer padding-top-killer">
						<label>
							<input type="radio" value="1" class="i-grey-square" name="<?php echo $email_key; ?>" <?php echo (!isset($email_privacy[$email_key]) || $email_privacy[$email_key] == 1) ? 'checked' : ''; ?>>
							<?php echo $this->lang->line('yes'); ?>
						</label>
					</div>
					<div class="radio pull-left margin-killer padding-top-killer">
						<label>
							<input type="radio" value="0" class="i-grey-square" name="<?php echo $email_key; ?>" <?php echo (isset($email_privacy[$email_key]) && $email_privacy[$email_key] == 0) ? 'checked' : ''; ?>>
							<?php echo $this->lang->line('No'); ?>
						</label>
					</div>
	            </div>
	        </div>
    	<?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url(); ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>