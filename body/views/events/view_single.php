<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript" >
    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Event',
            'message': 'Do you Want to Delete the Event ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
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
                'No': {
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
			<p class="pull-right">
				<?php
					if (hasPermission('events', 'editEvent')) {
			            echo '<a href="' . base_url() . 'event/edit/' . $event_detail->id. '" class="actions" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('edit') . '"><i class="fa fa-pencil icon-circle icon-xs icon-primary"></i></a>';
			        }

			        if (hasPermission('events', 'deleteEvent')) {
			            echo '<a href="javascript:;" onclick="UpdateRow(this)" class="actions" id="' .  $event_detail->id . '" data-toggle="tooltip" title="" data-original-title="' . $this->lang->line('delete') . '"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>';
			        }
				?>
			</p>
			<img src="<?php echo IMG_URL .'event_images/' . $event_detail->image; ?>" class="img-responsive" alt="Image">
			<div class="featured-text relative-left">
				<h3><a href="#"><?php echo ucfirst($event_detail->{$session->language.'_name'}); ?></a></h3>
				<p class="date">
					<?php
						echo ucwords($this->lang->line('date')), ' ', $this->lang->line('from') ,' : ' , date('d-m-Y', strtotime($event_detail->date_from)), ' ', strtolower($this->lang->line('to')) ,' ' , date('d-m-Y', strtotime($event_detail->date_to));
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
			<div class="no-border text-center no-margin the-box">
				<h4 class="bolded"><?php echo $user_info['name']; ?></h4>
				<img src="<?php echo $user_info['avtar']; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
			</div>
		<?php } ?>
		</div>
	</div>
</div>