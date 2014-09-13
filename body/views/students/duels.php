<?php $session = $this->session->userdata('user_session'); ?>
<link href="<?php echo PLUGIN_URL .'morris-chart/morris.min.css'; ?>" rel="stylesheet">
<style>
	.datepicker{z-index:9999 !important;}
	.bootstrap-timepicker-widget{z-index:9999 !important;}
</style>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('#tiles-slide-2').length > 0){
            $("#tiles-slide-2").owlCarousel({
                navigation : true,
				pagination: false,
				slideSpeed : 1000,
				paginationSpeed : 400,
				singleItem:true,
				autoPlay: 3000,
				theme : "my-reminder",
				navigationText : ["&larr;","&rarr;"],
            });
        }

    	Morris.Line({
		  element: 'statistics-challenge',
		  data: <?php echo $statistics_challenge; ?>,
		  xkey: "year",
		  ykeys: ['victories', 'defeats'],
		  labels: ['Victories', 'Defeats'],
		  resize: true,
		  lineColors: ['#F6BB42', '#8CC152']
		});

		$('button[data-toggle~="modal"]').on('click', function(e) {
			var target_modal = $(e.currentTarget).data('target');
			var modal = $(target_modal);
			modal.on('show.bs.modal', function () {
				$("input[name='to_id']").val($(e.currentTarget).data('userid'));
			}).modal({
				backdrop: 'static',
				keyboard: false
			});
			return false;
		});

		$('#do_duel_box').on('shown.bs.modal', function(){

			if ($('.timepicker').length > 0){
	            $('.timepicker').timepicker({
	                minuteStep: 5,
	                showInputs: false,
	                showMeridian : false
	            });
	        }

			if ($('.datepicker').length > 0){
		        $('.datepicker').datepicker({
		            format: "dd-mm-yyyy",
		            startDate: "<?php echo date('d-m-Y', strtotime(get_current_date_time()->get_date_for_db())); ?>",
		            startView: 2,
		            autoclose: true,
		            todayHighlight: true
		        }).on('changeDate', function (ev) {
		            $(this).datepicker('hide');
		        });
	    	}

	        $('#duel_date_time').validate({
	        	rules: {
					date: {required: true},
					time: {required: true}
				},
				messages: {
					date: {required: '* Please select any Date'},
					time: {required: '* Please select any time'}
				}
	        });

	        $('#duel_date_time').submit(function(e) {
				var post_data = {
					'from_id' : $("input[name='from_id']").val(),
					'to_id' : $("input[name='to_id']").val(),
					'date' : $("input[name='date']").val(),
					'time' : $("input[name='time']").val(),
					'place' : $("input[name='place]").val(),
				};
				$.ajax({
					type: "POST",
					url: '<?php echo  base_url(). "duels/do_it"; ?>',
					data: post_data,
					dataType : 'JSON',
					success: function(data) {
						if(data.status == true){
							$('.form-group').hide();
							$('.message').show();
						}
						setTimeout(function() {
                        	$('#do_duel_box').modal('hide');
                    	}, 2500);
					}	
				});
				e.preventDefault();
			});
		});

		$('#do_duel_box').on('hidden.bs.modal', function(){
		    $('.form-group').show();
		    $('.message').hide();
		});
    });
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('duels'); ?></h1>

<div class="row">
	<div class="col-lg-4">
		<div class="the-box no-border card-info text-center">
			<h4 class="bolded">Duel Suggested</h4>
			<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$recommended_user->avtar; ?>" class="social-avatar has-margin has-dark-shadow img-circle" alt="Avatar">
	  		<h3 class="bolded padding-killer"><?php echo @$recommended_user->name; ?></h3>
			<div class="row">
				<div class="col-xs-6">
					<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#do_duel_box" data-userid="<?php echo $recommended_user->id; ?>"><i class="fa fa-user"></i>Challenge!</button>
				</div>
				<div class="col-xs-6">
					<button class="btn btn-warning btn-block"><i class="fa fa-envelope"></i>Message</button>
				</div>
			</div>
		</div>

		<div class="the-box no-border card-info text-center">
			<h4 class="bolded">Challenge to a duel</h4>
			<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$suggested_user->avtar; ?>" class="social-avatar has-margin has-dark-shadow img-circle" alt="Avatar">
	  		<h3 class="bolded padding-killer"><?php echo @$suggested_user->name; ?></h3>
			<div class="row">
				<div class="col-xs-6">
					<button class="btn btn-warning btn-block"><i class="fa fa-list icon-sidebar"></i> View Rating</button>
				</div>
				<div class="col-xs-6">
					<button class="btn btn-warning btn-block" data-userid="<?php echo $suggested_user->id; ?>" data-toggle="modal" data-target="#do_duel_box"><i class="fa fa-user"></i>Blind</button>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel-group" id="challenges">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-recived">
							Challenges recieved
							<span class="right-content">
							<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>
				<div id="challenges-recived" class="collapse" style="height: 0px;">
					<div class="panel-body">
						<?php if($challenge_received != false) { ?>
							<?php foreach ($challenge_received as $received_key => $received_value) { ?>
			                	<div class="the-box no-border margin-top-killer margin-bottom-killer padding-bottom-killer">
			                		<div class="media">
										<p class="pull-left">
											<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$received_value->from_avtar; ?>" class="margin-top-killer margin-bottom-killer avatar avatar-60 img-circle">
										</p>
										<div class="media-body">
											<div class="pull-left">
												<h5 class="media-heading mar-bt-10">
													<a href="<?php echo base_url() . 'profile/view/'. $received_value->from_id ?>" class="text-primary">
														<strong><?php echo $received_value->from_name; ?></strong>
													</a>
												</h5>
												<p class="small text-muted">Score : <?php echo @$received_value->from_total_score; ?></p>
												<p class="small text-muted"><?php echo @time_elapsed_string($received_value->made_on); ?></p>
											</div>
											
											<div class="pull-right">
												<a href="<?php echo base_url() .'duels/single/' . $received_value->id; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="detail view" class="btn btn-primary btn-xs"><i class="fa fa-share"></i></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="margin-killer"/>
		                	<?php } ?>
	                	<?php } else { echo '<strong>No Challenges recieved</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/received'; ?>" class="btn btn-block btn-primary "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>
			
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-made">
							Challenges made
							<span class="right-content">
							<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>
				<div id="challenges-made" class="collapse" style="height: 0px;">
					<div class="panel-body">
						<?php if($challenge_made != false) { ?>
							<?php foreach ($challenge_made as $made_key => $made_value) { ?>
			                	<div class="the-box no-border margin-top-killer margin-bottom-killer padding-bottom-killer">
			                		<div class="media">
										<p class="pull-left">
											<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$made_value->to_avtar; ?>" class="margin-top-killer margin-bottom-killer avatar avatar-60 img-circle">
										</p>
										<div class="media-body">
											<div class="pull-left">
												<h5 class="media-heading mar-bt-10">
													<a href="<?php echo base_url() . 'profile/view/'. $made_value->to_id ?>" class="text-success">
														<strong><?php echo $made_value->to_name; ?></strong>
													</a>
												</h5>
											<p class="small text-muted">Score : <?php echo @$made_value->to_total_score; ?></p>
											<p class="small text-muted"><?php echo @time_elapsed_string($made_value->made_on); ?></p>
										</div>
									
										<div class="pull-right">
												<a href="<?php echo base_url() .'duels/single/' . $made_value->id; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="detail view" class="btn btn-success btn-xs"><i class="fa fa-share"></i></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="margin-killer"/>
		                	<?php } ?>
		                <?php } else { echo '<strong>No Challenges made</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/made'; ?>" class="btn btn-block btn-success "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>

			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-rejected">
							Challenges rejected
							<span class="right-content">
							<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>
				<div id="challenges-rejected" class="collapse" style="height: 0px;">
					<div class="panel-body">
						<?php if($challenge_rejected != false) { ?>
							<?php foreach ($challenge_rejected as $rejected_key => $rejected_value) { ?>
			                	<div class="the-box no-border margin-top-killer margin-bottom-killer padding-bottom-killer">
			                		<div class="media">
										<p class="pull-left">
											<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$rejected_value->from_avtar; ?>" class="margin-top-killer margin-bottom-killer avatar avatar-60 img-circle">
										</p>
										<div class="media-body">
											<div class="pull-left">
												<h5 class="media-heading mar-bt-10">
													<a href="<?php echo base_url() . 'profile/view/'. $rejected_value->from_id ?>" class="text-info">
														<strong><?php echo $rejected_value->from_name; ?></strong>
													</a>
												</h5>
												<p class="small text-muted">Score : <?php echo @$rejected_value->from_total_score; ?></p>
												<p class="small text-muted"><?php echo @time_elapsed_string($rejected_value->status_changed_on); ?></p>
											</div>
										
											<div class="pull-right">
												<a href="<?php echo base_url() .'duels/single/' . $received_value->id; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="detail view" class="btn btn-info btn-xs"><i class="fa fa-share"></i></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="margin-killer"/>
		                	<?php } ?>
		                <?php } else { echo '<strong>No Challenges rejected</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/rejected'; ?>" class="btn btn-block btn-info "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>
		</div>

		<div class="the-box no-border full">
			<div class="the-box no-border bg-danger no-margin">
				<h4 class="text-white padding-killer">DUELS LOG</h4>
				<hr>
				<div id="tiles-slide-2" class="owl-carousel my-reminder">
	                <div class="item full">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
						<p class="small">Wrote 1 days ago</p>
				  	</div>

				  	<div class="item full">
						<p>Praesent id leo nec erat pharetra dapibus vel vel orci.</p>
						<p class="small">Wrote 5 days ago</p>
				  	</div>

				  	<div class="item full">
						<p>Donec mattis neque quis pulvinar pretium.</p>
						<p class="small">Wrote 12 days ago</p>
				  	</div>

				  	<div class="item full">
						<p>Fusce non neque et erat tincidunt gravida.</p>
						<p class="small">Wrote 20 days ago</p>
				  	</div>
	            </div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-warning panel-square panel-no-border">
	        <div class="panel-heading">
            	<span class="bolded"><a class="text-white padding-killer" href="<?php echo base_url() . 'profile/view/' . $topper->id; ?>"><?php echo $topper->firstname .' ' . $topper->lastname; ?></a></span>
	        </div>

	        <div class="the-box no-border full card-info">
            	<div class="the-box no-border text-center no-margin">
	                <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $topper->avtar; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
	                <p class="text-info"><?php echo @$topper_batch_detail->{$session->language.'_name'}; ?></p>
	                <p class="text-muted">Gegio: <?php echo @$topper_ac_sc_clan_name; ?></p>
	                <p class="text-muted bordered">
	                <?php
		                $role_name = NULL;
		                foreach (explode(',', $topper->role_id) as $role) {
		                    $role_name .= ', ' . getRoleName($role);
		                }
		                echo substr($role_name, 2);
		            ?>
	                </p>
	                <?php if(!is_null($topper->quote) && !empty($topper->quote)) { ?>
	                    <p class="text-muted">
	                        "<?php echo $topper->quote; ?>"
	                    </p>
	                <?php } ?>

	                <?php if(!is_null($topper_batch_image)) { ?>
	                    <p class="social-icon">
	                        <img src="<?php echo $topper_batch_image; ?>" width="40" height="40" alt="<?php echo $topper_batch_detail->{$session->language.'_name'}; ?>" data-toggle="tooltip" data-original-title="<?php echo $topper_batch_detail->{$session->language.'_name'}; ?>">
	                    </p>
	                <?php } ?>
	            </div>
	            <button class="btn btn-warning btn-block btn-lg btn-square">Score : 1843</button>
	        </div>
	    </div>
	</div>
</div>

<div class="row">
	<div class="col-lg-4">
		<div class="panel panel-success panel-square panel-no-border">
			<div class="panel-heading">
				<div class="right-content">
					<button class="btn btn-success btn-sm to-collapse" data-toggle="collapse" data-target="#my_last_victories"><i class="fa fa-chevron-up"></i></button>
				</div>
				<h4 class="panel-title"><i class="fa fa-arrow-circle-o-up"></i> MY LAST VICTORIES</h4>
			</div>
			<div id="my_last_victories" class="collapse in" style="height: auto;">
				<div class="panel-body">
					<ul class="media-list media-sm media-team">
						<?php foreach ($my_victories as $victory_key => $victory_value) { ?>
							<li class="media">
								<a class="pull-left" href="#fakelink">
									<img class="media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$victory_value->avtar; ?>" alt="Avatar">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><?php echo @$victory_value->name; ?></h4>
									<p class="text-danger">Score: <strong><?php echo @$victory_value->total_score; ?></strong></p>
								</div>
							</li>
						<?php } ?>
					</ul>
				<a href="<?php echo base_url() .'duels/view/wins'; ?>" class="btn btn-success btn-block"><?php echo $this->lang->line('see_all'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-danger panel-square panel-no-border">
			<div class="panel-heading">
				<div class="right-content">
					<button class="btn btn-danger btn-sm to-collapse" data-toggle="collapse" data-target="#my_last_defeats"><i class="fa fa-chevron-up"></i></button>
				</div>
				<h4 class="panel-title"><i class="fa fa-arrow-circle-o-up"></i>  MY LAST DEFEATS</h4>
			</div>
			<div id="my_last_defeats" class="collapse in" style="height: auto;">
				<div class="panel-body">
					<ul class="media-list media-sm media-team">
						<?php foreach ($my_defeats as $defeat_key => $defeat_value) { ?>
							<li class="media">
								<a class="pull-left" href="#fakelink">
									<img class="media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$defeat_value->avtar; ?>" alt="Avatar">
								</a>
								<div class="media-body">
									<h4 class="media-heading"><?php echo @$defeat_value->name; ?></h4>
									<p class="text-danger">Score: <strong><strong><?php echo @$defeat_value->total_score; ?></strong></strong></p>
								</div>
							</li>
						<?php } ?>
					</ul>
				<a href="<?php echo base_url() .'duels/view/defeats'; ?>" class="btn btn-danger btn-block"><?php echo $this->lang->line('see_all'); ?></a>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="the-box bg-dark no-border text-center more-padding">
			<h4 class="text-white padding-killer">The four before me</h4><br>
			<div class="row">
				<?php if($four_before_me_users != false){ ?>
					<?php foreach ($four_before_me_users as $before_key => $before_value) { ?>
						<div class="col-xs-3">
							<p><a href="<?php echo base_url() . 'profile/view/'. $before_value->id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $before_value->name; ?>"><img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$before_value->avtar; ?>" class="img-responsive img-circle" alt="Avatar"></a></p>
						</div>
					<?php } ?>
				<?php } ?>
			</div>	
			<h4 class="text-white padding-killer">The four after me</h4><br>
			<div class="row">
				<?php if($four_after_me_users != false){ ?>
					<?php foreach ($four_after_me_users as $after_key => $after_value) { ?>
						<div class="col-xs-3">
							<p><a href="<?php echo base_url() . 'profile/view/'. $after_value->id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $after_value->name; ?>"><img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$after_value->avtar; ?>" class="img-responsive img-circle" alt="Avatar"></a></p>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-8">
		<div class="the-box">
			<h4 class="small-title">STATISTICS</h4>
			<div id="statistics-challenge"></div>
		</div>
	</div>

	<div class="col-lg-4">
		<?php if($top_five_users != false){ ?>
			<div class="panel panel-success panel-square panel-no-border">
				<div class="panel-heading">
					<div class="right-content">
						<button class="btn btn-success btn-sm to-collapse" data-toggle="collapse" data-target="#top-five-users"><i class="fa fa-chevron-up"></i></button>
					</div>
					<h4 class="panel-title"><i class="fa fa-users"></i> Top 5</h4>
				</div>
				<div id="top-five-users" class="collapse in">
                	<?php foreach ($top_five_users as $top_five_key => $top_five_value) { ?>
	                	<div class="the-box no-border margin-bottom-killer padding-bottom-killer">
	                		<div class="media">
								<p class="pull-left">
									<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$top_five_value->avtar; ?>" class="top-user-image img-circle">
								</p>
								<div class="media-body">
									<h5 class="media-heading">
										<a href="<?php echo base_url() . 'profile/view/'. $top_five_value->id ?>">
											<strong><?php echo $top_five_value->name; ?></strong>
										</a>
									</h5>
									<p class="small text-muted margin-killer">Score : <?php echo @$top_five_value->total_score; ?></p>
									<p class="small text-muted margin-killer"><?php echo @$top_five_value->academy; ?></p>
								</div>
							</div>
						</div>
						<hr class="margin-killer"/>
                	<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>

<div class="modal fade" id="do_duel_box" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow modal-no-border bg-danger">
			<div class="modal-header">
				<h4 class="modal-title text-white padding-killer">Prepare to fight!</h4>
			</div>
			<form id="duel_date_time" method="post" class="form-horizontal" action="<?php echo  base_url(). "duels/do_it"; ?>">
				<input type="hidden" name="from_id" value="<?php echo $session->id; ?>">
				<input type="hidden" name="to_id" value="0">
				<div class="modal-body padding-bottom-killer">
					<div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('date')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control datepicker required" name="date" value="<?php echo date('d-m-Y', strtotime(get_current_date_time()->get_date_for_db())); ?>">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('time')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control timepicker required" name="time">
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('place')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control required" name="place" placeholder="Place">
		                </div>
		            </div>
		            <div class="alert alert-success message" style="display:none;">
		            	Prepare for the fight the Challenge made Sucessfully !!
		            </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Just kidding</button>
					<button type="submit" class="btn btn-danger">Do it!</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?php echo PLUGIN_URL .'morris-chart/raphael.min.js'; ?>"></script>
<script src="<?php echo PLUGIN_URL .'morris-chart/morris.min.js'; ?>"></script>