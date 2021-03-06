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

        var statistics = Morris.Line({
			element: 'statistics-challenge',
			data: <?php echo $statistics_challenge; ?>,
	        hideHover: 'auto',
	        resize: true,
			xkey: "year",
			ykeys: ['victories', 'defeats'],
			labels: ["<?php echo $this->lang->line('victories'); ?>","<?php echo $this->lang->line('defeats'); ?>"],
			resize: true,
			lineColors: ['#8CC152', '#E9573F']
		});

		var delay = (function() {
			var timer = 0;
			return function(callback, ms) {
				clearTimeout(timer);
				timer = setTimeout(callback, ms);
			};
		})();
		
		$(window).resize(function() {
			delay(function() {
				statistics.redraw();
			}, 500);
		}).trigger('resize');

		$('button[data-toggle~="modal"]').on('click', function(e) {
			var target_modal = $(e.currentTarget).data('target');
			var modal = $(target_modal);
			modal.on('show.bs.modal', function () {
				if(target_modal == '#do_duel_box') {
					$('input[name="to_id"]').val($(e.currentTarget).data('userid'));
					$('input[name="challenge_type"]').val($(e.currentTarget).data('challenge-type'));
					$('.form-group').show();
			    	$('.animation_image').hide();
			    	$('#time_error').hide();
	        		$('#date_error').hide();
				}
			}).modal({
				backdrop: 'static',
				keyboard: false
			});
			return false;
		});

		$('#do_duel_box').on('shown.bs.modal', function(e){
			if ($('.timepicker').length > 0){
	            $('.timepicker').timepicker({
	                minuteStep: 5,
	                showInputs: false,
	                showMeridian : false,
	                defaultTime :false,
	            });
	        }

			if ($('.datepicker').length > 0){
		        $('.datepicker').datepicker({
		            format: "dd-mm-yyyy",
		            startDate: "<?php echo date('d-m-Y', strtotime('+2 day',  strtotime(get_current_date_time()->get_date_for_db()))); ?>",
		            startView: 2,
		            autoclose: true,
		            todayHighlight: true
		        }).on('changeDate', function (ev) {
		            $(this).datepicker('hide');
		        });
	    	}

	        $('#duel_date_time').submit(function(e) {
	        	if($('input[name="date"]').val() != '' && $('input[name="time"]').val() == ''){
	        		$('#time_error').show();
	        		$('#date_error').hide();
	        		$('.animation_image').hide();
	        		$('.message').hide();
	        	} else if($('input[name="date"]').val() == '' && $('input[name="time"]').val() != ''){
	        		$('#time_error').hide();
	        		$('#date_error').show();
	        		$('.animation_image').hide();
	        		$('.message').hide();
	        	} else{
	        		$('#time_error').hide();
	        		$('#date_error').hide();
	        		$('.animation_image').show();
	        		$('.form-group').hide();
	        		$('.message').hide();
	        		var post_data = {
	        			'challenge_type' : $('input[name="challenge_type"]').val(),
						'from_id' : $('input[name="from_id"]').val(),
						'to_id' : $('input[name="to_id"]').val(),
						'date' : $('input[name="date"]').val(),
						'time' : $('input[name="time"]').val(),
						'place' : $('input[name="place"]').val(),
					};
					$.ajax({
						type: "POST",
						url: '<?php echo  base_url(). "duels/do_it"; ?>',
						data: post_data,
						dataType : 'JSON',
						success: function(data) {
							if(data.status == true){
								$('.form-group').hide();
								$('.animation_image').hide();
								$('#time_error').hide();
    							$('#date_error').hide();
								$('.message').show();
							}
							setTimeout(function() {
	                        	$('#do_duel_box').modal('hide');
	                    	}, 2500);
						}	
					});
	        	}
				e.preventDefault();
			});
		});

		$('#do_duel_box').on('hidden.bs.modal', function(){
			$('input[name="to_id"]').val(0);
		    $('.form-group').show();
		    $('.animation_image').hide();
		    $('#time_error').hide();
    		$('#date_error').hide();
    		$('.message').hide();
		});
    });
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('duels'); ?></h1>

<div class="row">
	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<?php if($suggested_user != false){ ?>
			<div class="the-box no-border card-info text-center">
				<h4 class="bolded"><?php echo $this->lang->line('duel_suggested'); ?></h4>
				<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$suggested_user->avtar; ?>" class="social-avatar has-margin has-dark-shadow img-circle" alt="Avatar">
		  		<h3 class="bolded padding-killer"><?php echo @$suggested_user->name; ?></h3>
				<div class="row">
					<div class="col-xs-6">
						<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#<?php echo ($can_do_challege) ? 'do_duel_box' : 'cannot_do_duel_box'; ?>" data-userid="<?php echo $suggested_user->id; ?>" data-challenge-type="R"><i class="fa fa-user"></i><?php echo $this->lang->line('challenge'); ?></button>
					</div>
					<div class="col-xs-6">
						<a href="<?php echo base_url() .'message/compose'; ?>" class="btn btn-warning btn-block"><i class="fa fa-envelope"></i><?php echo $this->lang->line('message'); ?></a>
					</div>
				</div>
			</div>
		<?php } ?>

		<?php if($recommended_user != false){ ?>
			<div class="the-box no-border card-info text-center">
				<h4 class="bolded"><?php echo $this->lang->line('duel_recommended'); ?></h4>
				<i class="fa fa-question icon-circle special-icon-duel icon-bordered special-icon-default mar-bt-10"></i>
				<div class="row">
					<div class="col-xs-7">
						<a href="<?php echo base_url() .'rating_list'; ?>" class="btn btn-warning btn-block"><i class="fa fa-list icon-sidebar"></i> <?php echo $this->lang->line('choose_by_rating'); ?></a>
					</div>
					<div class="col-xs-5">
						<button class="btn btn-warning btn-block" data-userid="<?php echo $recommended_user->id; ?>" data-toggle="modal" data-target="#<?php echo ($can_do_challege) ? 'do_duel_box' : 'cannot_do_duel_box'; ?>" data-challenge-type="B"><i class="fa fa-user"></i><?php echo $this->lang->line('blind'); ?></button>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="panel-group" id="challenges">
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-made">
							<?php echo $this->lang->line('challenge_accepted'); ?>
							<span class="right-content">
							<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>
				<div id="challenges-made" class="collapse" style="height: 0px;">
					<div class="panel-body">
						<?php if($challenge_accepted != false) { ?>
							<?php foreach ($challenge_accepted as $made_key => $made_value) { 
								if($made_value->to_id == $session->id) {
	                    			$made_id = $made_value->from_id;
									$made_name = $made_value->from_name;
									$made_avtar = $made_value->from_avtar;
									$made_total_score = $made_value->from_total_score;
		                    	} else {
		                    		$made_id = $made_value->to_id;
									$made_name = $made_value->to_name;
									$made_avtar = $made_value->to_avtar;
									$made_total_score = $made_value->to_total_score;
		                    	}

							?>
			                	<div class="the-box no-border margin-top-killer margin-bottom-killer padding-bottom-killer">
			                		<div class="media">
										<p class="pull-left">
											<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$made_avtar; ?>" class="margin-top-killer margin-bottom-killer avatar avatar-60 img-circle">
										</p>
										<div class="media-body">
											<div class="pull-left">
												<h5 class="media-heading mar-bt-10">
													<a href="<?php echo base_url() . 'profile/view/'. $made_id ?>" class="text-success">
														<strong><?php echo $made_name; ?></strong>
													</a>
												</h5>
											<p class="small text-muted">Score : <?php echo @$made_total_score; ?></p>
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
		                <?php } else { echo '<strong>'. $this->lang->line('no_challenge_accepted') .'</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/accepted'; ?>" class="btn btn-block btn-success "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-recived">
							<?php echo $this->lang->line('challenges_recevied'); ?>
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
												<?php echo (!is_null($received_value->place) && $received_value->place != '0')  ? '<p class="small text-muted">Place : '. $received_value->place .'</p>' : ''; ?>
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
	                	<?php } else { echo '<strong>'. $this->lang->line('no_challenge_received') .'</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/received'; ?>" class="btn btn-block btn-primary "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>
			
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse collapsed" data-parent="#challenges" data-toggle="collapse" href="#challenges-rejected">
							<?php echo $this->lang->line('challenge_submitted'); ?>
							<span class="right-content">
							<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>
				<div id="challenges-rejected" class="collapse" style="height: 0px;">
					<div class="panel-body">
						<?php if($challenge_submitted != false) { ?>
							<?php foreach ($challenge_submitted as $submitted_key => $submitted_value) { ?>
			                	<div class="the-box no-border margin-top-killer margin-bottom-killer padding-bottom-killer">
			                		<div class="media">
										<p class="pull-left">
											<img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$submitted_value->to_avtar; ?>" class="margin-top-killer margin-bottom-killer avatar avatar-60 img-circle">
										</p>
										<div class="media-body">
											<div class="pull-left">
												<h5 class="media-heading mar-bt-10">
													<a href="<?php echo base_url() . 'profile/view/'. $submitted_value->to_id ?>" class="text-info">
														<strong><?php echo $submitted_value->to_name; ?></strong>
													</a>
												</h5>
												<p class="small text-muted">Score : <?php echo @$submitted_value->to_total_score; ?></p>
												<p class="small text-muted"><?php echo @time_elapsed_string($submitted_value->made_on); ?></p>
											</div>
											
											<div class="pull-right">
												<a href="<?php echo base_url() .'duels/single/' . $submitted_value->id; ?>" data-toggle="tooltip" data-placement="bottom" data-original-title="detail view" class="btn btn-info btn-xs"><i class="fa fa-share"></i></a>
											</div>
										</div>
									</div>
								</div>
								<hr class="margin-killer"/>
		                	<?php } ?>
		                <?php } else { echo '<strong>'. $this->lang->line('no_challenge_submitted') .'</strong>'; } ?>
					</div>

					<div class="panel-footer no-border padding-killer">
						<a href="<?php echo base_url() .'duels/view/submitted'; ?>" class="btn btn-block btn-info "><?php echo $this->lang->line('see_all'); ?></a>
					</div>
				</div>
			</div>
		</div>

		<div class="the-box no-border full">
			<div class="the-box no-border bg-danger no-margin">
				<h4 class="text-white padding-killer"><?php echo $this->lang->line('duel_logs'); ?></h4>
				<hr>
				<div id="tiles-slide-2" class="owl-carousel my-reminder">
					<?php if($duel_logs != false){ ?>
						<?php foreach ($duel_logs as $log_key => $log_value) { ?>
							<div class="item full">
								<p><?php echo '<a class="bolded text-white padding-killer" href="'.base_url() .'profile/view/'. $log_value->from_id.'">' , $log_value->from_name, '</a> has challenged <a class="bolded text-white padding-killer" href="'.base_url() .'profile/view/'. $log_value->to_id.'">', $log_value->to_name, '</a>'; ?></p>
								<?php if(!is_null($log_value->winner_id)) {
								 echo '<p>The winner is <a class="bolded text-white padding-killer" href="'.base_url() .'profile/view/'. $log_value->winner_id.'">' , $log_value->winner_name, '</a></p>';
								 } ?>
								<p class="small"><?php echo @time_elapsed_string($log_value->made_on); ?></p>
						  	</div>
						<?php } ?>
					<?php } ?>
	            </div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
		<div class="panel panel-warning panel-square panel-no-border">
	        <div class="panel-heading">
            	<span class="bolded"><a class="text-white padding-killer" href="<?php echo base_url() . 'profile/view/' . $topper->id; ?>"><?php echo $topper->name; ?></a></span>
	        </div>

	        <div class="the-box no-border full card-info">
            	<div class="the-box no-border text-center no-margin">
	                <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $topper->avtar; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
	                <?php if(isset($topper_degree_batch_name)){ ?>
	                	<p class="text-info"><?php echo @$topper_degree_batch_name; ?></p>
	                <?php } ?>
	                <?php if(isset($topper_ac_sc_clan_name)){ ?>
	                	<p class="text-muted"><?php echo @$topper_ac_sc_clan_name; ?></p>
	                <?php } ?>
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

	                <?php if(!is_null($batch_image)) { ?>
	                    <p class="social-icon">
	                        <?php foreach ($batch_image as $image) { ?>
	                            <img src="<?php echo $image['image']; ?>" width="40" height="40" alt="<?php echo $image['name']; ?>" data-toggle="tooltip" data-original-title="<?php echo $image['name']; ?>">
	                        <?php } ?>
	                    </p>
	                <?php } ?>
	            </div>
	            <button class="btn btn-warning btn-block btn-lg btn-square"><?php echo $this->lang->line('score'); ?> : <?php echo @$topper_userdetail->total_score; ?></button>
	        </div>
	    </div>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
		<div class="panel panel-success panel-square panel-no-border">
			<div class="panel-heading">
				<div class="right-content">
					<button class="btn btn-success btn-sm to-collapse" data-toggle="collapse" data-target="#my_last_victories"><i class="fa fa-chevron-up"></i></button>
				</div>
				<h4 class="panel-title"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $this->lang->line('my_last_victoreis'); ?></h4>
			</div>
			<div id="my_last_victories" class="collapse in" style="height: auto;">
				<div class="panel-body">
				<?php if($my_victories != false){ ?>
					<ul class="media-list media-sm media-team">
						<?php foreach ($my_victories as $victory_key => $victory_value) { 
							if($victory_value->to_id == $session->id) {
	                    			$victory_id = $victory_value->from_id;
									$victory_name = $victory_value->from_name;
									$victory_avtar = $victory_value->from_avtar;
									$victory_total_score = $victory_value->from_total_score;
		                    	} else {
		                    		$victory_id = $victory_value->to_id;
									$victory_name = $victory_value->to_name;
									$victory_avtar = $victory_value->to_avtar;
									$victory_total_score = $victory_value->to_total_score;
		                    	}

							?>
							<li class="media">
								<a class="pull-left" href="#fakelink">
									<img class="media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$victory_avtar; ?>" alt="Avatar">
								</a>
								<div class="media-body">
									<a href="<?php echo base_url() .'profile/view/' . $victory_id; ?>">
										<h4 class="media-heading"><?php echo @$victory_name; ?></h4>
									</a>
									<p class="text-danger"><?php echo $this->lang->line('score'); ?>: <strong><?php echo @$victory_total_score; ?></strong></p>
								</div>
							</li>
						<?php } ?>
					</ul>
				<a href="<?php echo base_url() .'duels/view/wins'; ?>" class="btn btn-success btn-block"><?php echo $this->lang->line('see_all'); ?></a>
				<?php } else { echo  $this->lang->line('no_victories') ; }?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
		<div class="panel panel-danger panel-square panel-no-border">
			<div class="panel-heading">
				<div class="right-content">
					<button class="btn btn-danger btn-sm to-collapse" data-toggle="collapse" data-target="#my_last_defeats"><i class="fa fa-chevron-up"></i></button>
				</div>
				<h4 class="panel-title"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $this->lang->line('my_last_defeats'); ?></h4>
			</div>
			<div id="my_last_defeats" class="collapse in" style="height: auto;">
				<div class="panel-body">
				<?php if($my_defeats != false){ ?>
					<ul class="media-list media-sm media-team">
						<?php foreach ($my_defeats as $defeat_key => $defeat_value) {
							if($defeat_value->to_id == $session->id) {
	                    			$defeat_id = $defeat_value->from_id;
									$defeat_name = $defeat_value->from_name;
									$defeat_avtar = $defeat_value->from_avtar;
									$defeat_total_score = $defeat_value->from_total_score;
		                    	} else {
		                    		$defeat_id = $defeat_value->to_id;
									$defeat_name = $defeat_value->to_name;
									$defeat_avtar = $defeat_value->to_avtar;
									$defeat_total_score = $defeat_value->to_total_score;
		                    	}
						 ?>
							<li class="media">
								<a class="pull-left" href="#fakelink">
									<img class="media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$defeat_avtar; ?>" alt="Avatar">
								</a>
								<div class="media-body">
									<a href="<?php echo base_url() .'profile/view/' . $defeat_id; ?>">
										<h4 class="media-heading"><?php echo @$defeat_name; ?></h4>
									</a>
									<p class="text-danger"><?php echo $this->lang->line('score'); ?>: <strong><strong><?php echo @$defeat_total_score; ?></strong></strong></p>
								</div>
							</li>
						<?php } ?>
					</ul>
					<a href="<?php echo base_url() .'duels/view/defeats'; ?>" class="btn btn-danger btn-block"><?php echo $this->lang->line('see_all'); ?></a>
				<?php } else { echo  $this->lang->line('no_defeats') ; }?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
		<div class="panel panel-info panel-square panel-no-border">
			<div class="panel-heading">
				<div class="right-content">
					<button class="btn btn-info btn-sm to-collapse" data-toggle="collapse" data-target="#my_last_faliure"><i class="fa fa-chevron-up"></i></button>
				</div>
				<h4 class="panel-title"><i class="fa fa-arrow-circle-o-up"></i> <?php echo $this->lang->line('my_last_failure'); ?></h4>
			</div>
			<div id="my_last_faliure" class="collapse in" style="height: auto;">
				<div class="panel-body">
				<?php if($my_failures != false){ ?>
					<ul class="media-list media-sm media-team">
						<?php foreach ($my_failures as $failure_key => $failure_value) {
							if($failure_value->to_id == $session->id) {
	                    			$failure_id = $failure_value->from_id;
									$failure_name = $failure_value->from_name;
									$failure_avtar = $failure_value->from_avtar;
									$failure_total_score = $failure_value->from_total_score;
		                    	} else {
		                    		$failure_id = $failure_value->to_id;
									$failure_name = $failure_value->to_name;
									$failure_avtar = $failure_value->to_avtar;
									$failure_total_score = $failure_value->to_total_score;
		                    	}
						 ?>
							<li class="media">
								<a class="pull-left" href="#fakelink">
									<img class="media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$failure_avtar; ?>" alt="Avatar">
								</a>
								<div class="media-body">
									<a href="<?php echo base_url() .'profile/view/' . $failure_id; ?>">
										<h4 class="media-heading"><?php echo @$failure_name; ?></h4>
									</a>
									<p class="text-danger"><?php echo $this->lang->line('score'); ?>: <strong><strong><?php echo @$failure_total_score; ?></strong></strong></p>
								</div>
							</li>
						<?php } ?>
					</ul>
					<a href="<?php echo base_url() .'duels/view/faliure'; ?>" class="btn btn-info btn-block"><?php echo $this->lang->line('see_all'); ?></a>
				<?php } else { echo  $this->lang->line('no_failure') ; }?>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
		<?php if((isset($before_me_users) && $before_me_users != false) || (isset($before_me_users) && $after_me_users != false)) { ?>
			<div class="the-box bg-dark no-border text-center more-padding">
				<?php if($before_me_users != false){ 
					krsort($before_me_users);
				?>
					<h4 class="text-white padding-killer"><?php echo ucwords(convertNumber2Words(count($before_me_users))),' ', $this->lang->line('before_me')  ?></h4><br />
					<div class="row">
						<?php foreach ($before_me_users as $before_key => $before_value) { ?>
							<div class="col-xs-3">
								<p><a href="<?php echo base_url() . 'profile/view/'. $before_value->id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $before_value->name; ?>"><img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$before_value->avtar; ?>" class="img-responsive img-circle" alt="Avatar"></a></p>
							</div>
						<?php } ?>
					</div>
				<?php } else { /*echo '<h4 class="text-white margin-killer">You are First, Congrulations</h4>';*/ } ?>
				<?php if($after_me_users != false){ ?>	
					<h4 class="text-white padding-killer"><?php echo ucwords(convertNumber2Words(count($after_me_users))),' ', $this->lang->line('after_me')  ?></h4><br />
					<div class="row">
						<?php foreach ($after_me_users as $after_key => $after_value) { ?>
							<div class="col-xs-3">
								<p><a href="<?php echo base_url() . 'profile/view/'. $after_value->id ?>" data-toggle="tooltip" title="" data-original-title="<?php echo $after_value->name; ?>"><img src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$after_value->avtar; ?>" class="img-responsive img-circle" alt="Avatar"></a></p>
							</div>
						<?php } ?>
					</div>
				<?php } else { /*echo '<h4 class="text-white margin-killer">Sorry but you are last</h4>';*/ } ?>
			</div>
		<?php } ?>
	</div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-8 col-lg-8">
		<div class="the-box">
			<h4 class="small-title"><?php echo $this->lang->line('statistics'); ?></h4>
			<div id="statistics-challenge"></div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-5 col-md-4 col-lg-4">
		<?php if(isset($top_five_users) && $top_five_users != false){ ?>
			<div class="panel panel-success panel-square panel-no-border">
				<div class="panel-heading">
					<div class="right-content">
						<button class="btn btn-success btn-sm to-collapse" data-toggle="collapse" data-target="#top-five-users"><i class="fa fa-chevron-up"></i></button>
					</div>
					<h4 class="panel-title"><i class="fa fa-users"></i> <?php echo $this->lang->line('top'); ?> 5</h4>
				</div>
				<div id="top-five-users" class="collapse in">
                	<?php foreach ($top_five_users as $top_five_key => $top_five_value) { ?>
	                	<div class="the-box no-border margin-bottom-killer padding-bottom-killer">
							<div class="media user-card-sm">
		                        <img class="pull-left media-object img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . @$top_five_value->avtar; ?>">
		                        <div class="media-body">
		                            <h5 class="media-heading">
										<a href="<?php echo base_url() . 'profile/view/'. $top_five_value->id ?>">
											<strong><?php echo $top_five_value->name; ?></strong>
										</a>
									</h5>
									<p class="small text-muted margin-killer"><?php echo $this->lang->line('score'); ?> : <?php echo @$top_five_value->total_score; ?></p>
									<p class="small text-muted margin-killer"><?php echo @$top_five_value->academy; ?></p>
		                        </div>
		                        <div class="right-button">
		                        	<?php //$check = Challenge::isRequestedBefore($session->id, $top_five_value->id);
		                        		if($top_five_value->total_challenge == 0 && $top_five_value->id != $session->id){
		                        	?>
		                            	<button class="btn btn-warning btn-block" data-toggle="modal" data-target="#<?php echo ($can_do_challege) ? 'do_duel_box' : 'cannot_do_duel_box'; ?>" data-userid="<?php echo $top_five_value->id; ?>">&nbsp;<?php echo $this->lang->line('challenge'); ?>&nbsp;</button>
		                            <?php } ?>
		                        </div>
                    		</div>
						</div>
						<p></p>
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
				<h4 class="modal-title text-white padding-killer"><?php echo $this->lang->line('prepare_to_fight'); ?></h4>
			</div>
			<form id="duel_date_time" method="post" class="form-horizontal" action="<?php echo  base_url(). "duels/do_it"; ?>">
				<input type="hidden" name="from_id" value="<?php echo $session->id; ?>">
				<input type="hidden" name="to_id" value="0">
				<input type="hidden" name="challenge_type" value="R">
				<div class="modal-body padding-bottom-killer">
					<div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('date')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control datepicker" name="date" placeholder="Date" readonly="readonly">
		                </div>
		            </div>
	            	<div class="form-group" id="date_error" style="display:none">
		                <label class="col-lg-3 control-label">&nbsp;</label>
		                <div class="col-lg-5">
		                    <label for="date" class="error text-white padding-killer"><?php echo $this->lang->line('date_required'); ?></label>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('time')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control timepicker" name="time" placeholder="Time" readonly="readonly">
		                </div>
		            </div>
		            <div class="form-group" id="time_error" style="display:none">
		                <label class="col-lg-3 control-label">&nbsp;</label>
		                <div class="col-lg-5">
		                    <label for="date" class="error text-white padding-killer"><?php echo $this->lang->line('time_required'); ?></label>
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
		            	<?php echo $this->lang->line('challenge_success_message'); ?>
		            </div>
		            <div class="animation_image" style="display:none" align="center">
                    	<i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
                	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('just_kidding'); ?></button>
					<button type="submit" class="btn btn-danger"><?php echo $this->lang->line('do_it'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="cannot_do_duel_box" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow modal-no-border bg-danger">
			<div class="modal-header">
				<h4 class="modal-title text-white padding-killer"><?php echo $this->lang->line('cannot_challenge'); ?></h4>
			</div>
			<div class="modal-body padding-bottom-killer">
				<p><?php echo $this->lang->line('cannot_challenge_error'); ?></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('ok'); ?></button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo PLUGIN_URL .'morris-chart/raphael.min.js'; ?>"></script>
<script src="<?php echo PLUGIN_URL .'morris-chart/morris.min.js'; ?>"></script>