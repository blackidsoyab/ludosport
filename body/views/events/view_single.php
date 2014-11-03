<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript" >
    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Event',
            'message': 'Do you Want to Delete the Event ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'event/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                window.location.reload();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('error');
                            }
                        });
                    }
                },
                '<?php echo $this->lang->line("no"); ?>': {
                    'class': 'btn btn-default',
                    'action': function() {
                    }	// Nothing to do in this case. You can as well omit the action property.
                }
            }
        });
        return false;
    }
</script>
<h1 class="page-heading"><?php echo $this->lang->line('event'); ?></h1>

<div class="col-lg-8">
	<div class="the-box">
		<div class="featured-post-wide">
			<div class="row">
				<?php if (hasPermission('events', 'sendEventInvitation') || in_array($session->id, explode(',', $event_detail->
				manager))) { ?>
					<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
						<a href="<?php echo base_url() . 'event/invitation/' . $event_detail->id; ?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('send') .' '. $this->lang->line('invitation'); ?>"> <?php echo $this->lang->line('send') .' '. $this->lang->line('invitation'); ?></a>
					</div>
			    <?php } ?>

			    <?php if (hasPermission('events', 'viewEventInvitation') || in_array($session->id, explode(',', $event_detail->manager))) { ?>
			    	<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			        	<a href="<?php echo base_url() . 'event/view_invitation/' . $event_detail->id; ?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('view') .' '. $this->lang->line('invitation'); ?>"><?php echo $this->lang->line('view') .' '. $this->lang->line('invitation'); ?> </a>
			        </div>
			    <?php } ?>

			    <?php if (hasPermission('events', 'assignTournamentBatches') || in_array($session->id, explode(',', $event_detail->manager))) { ?>
			    	<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
			        	<a href="<?php echo base_url() . 'event/tournament/batch_assignment/' . $event_detail->id; ?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('batch_assignment'); ?>"><?php echo $this->lang->line('batch_assignment'); ?> </a>
			        </div>
			    <?php } ?>

			    <div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 text-right event-action-btn">
					<?php if (hasPermission('events', 'editEvent') || in_array($session->id, explode(',', $event_detail->manager))) { ?>
			        	<a href="<?php echo base_url() . 'event/edit/' . $event_detail->id; ?>" class="actions" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('edit'); ?>"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>
				    <?php } ?>

				    <?php if (hasPermission('events', 'deleteEvent') || in_array($session->id, explode(',', $event_detail->manager))) { ?>
			        	<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="<?php echo $event_detail->id; ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('delete'); ?>"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>
				    <?php } ?>
			    </div>
			</div>
			<hr class="mar-tp-10 mar-bt-10" />
			<img src="<?php echo IMG_URL .'event_images/780X450/' . $event_detail->image; ?>" class="img-responsive" alt="Image">
			<div class="featured-text relative-left">
				<h3><a href="#"><?php echo ucfirst($event_detail->{$session->language.'_name'}); ?></a></h3>
				<p class="date">
				 	<?php
                                if(strtotime($event_detail->date_from) == strtotime($event_detail->date_to)){
                                    echo ucwords($this->lang->line('date')) ,' : ', date('d-m-Y', strtotime($event_detail->date_from));
                                } else{
                                    echo ucwords($this->lang->line('date')), ' ', $this->lang->line('from') ,' : ' , date('d-m-Y', strtotime($event_detail->date_from)), ' ', strtolower($this->lang->line('to')) ,' ' , date('d-m-Y', strtotime($event_detail->date_to));
                                }
                                
                    ?>
                    <?php
						
					?>
				</p>
				<p><?php echo $event_detail->description; ?></p>
				<p class="additional-post-wrap">
					<?php $user_info = userNameAvtar($event_detail->user_id); ?>
					<span class="additional-post"><i class="fa fa-user"></i>by <a href="#"><?php echo $user_info['name']; ?></a></span>
				</p>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-4">
	<div class="panel panel-primary panel-square panel-no-border">
		<div class="panel-heading">
			<span class="bolded"></span><?php echo $this->lang->line('manager'); ?>
		</div>
		<div class="the-box no-border full card-info">
		<?php
			$manager_list = explode(',', $event_detail->manager);
			sort($manager_list);
			foreach ($manager_list as $value) { 
				$user_info = userNameAvtar($value);
				?>
			<div class="no-border text-center margin-killer the-box">
				<h4 class="bolded"><?php echo $user_info['name']; ?></h4>
				<img src="<?php echo $user_info['avtar']; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
			</div>
		<?php } ?>
		</div>
	</div>
</div>