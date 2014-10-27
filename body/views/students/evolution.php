<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$('.apply_for_clan').click(function(e) {
			var post_data = {
				'clan_id' : $(this).data('clan'),
			};
			$('.apply_for_clan').hide();
			$(this).show();
			$(this).html('<i class="fa fa-cog fa-spin fa-2x text-primary"></i>');
			$.ajax({
				type: "POST",
				url: '<?php echo  base_url(). "evolution/apply_for_clan"; ?>',
				data: post_data,
				dataType : 'JSON',
				success: function(data) {
                    location.reload();
				}	
			});
			e.preventDefault();
		});	
	});
</script>


<h1 class="page-heading h1"><?php echo $this->lang->line('evolution'); ?></h1>

<?php
	if(isset($evolution_categories) && count($evolution_categories) > 0) {
		foreach ($evolution_categories as $category) {
?>
	<div class="the-box">
		<div class="featured-post-wide">
			<img src="<?php echo IMG_URL . 'evolution_images/'. $category->image; ?>" class="img-responsive" alt="Image">
			<div class="featured-text relative-left">
				<h3><a href="#"><?php echo $category->{$session->language.'_name'}; ?></a></h3>
				<p><?php echo @$category->description; ?></p>
			</div>
		</div>

		<?php if(isset(${'evolution_levels_' . $category->id}) && count(${'evolution_levels_' . $category->id}) > 0) { ?>
			<div class="row mar-bt-10 text-right">
				<div class="col-xs-12 col-xsm-12 col-md-12 col-lg-12">
					<label class="label label-success">Level Clear</label>
					<label class="label label-info">Level Active</label>
					<label class="label label-primary">Level Elegible</label>
					<label class="label label-danger">Level Not elegible</label>
				</div>
			</div>
			<div class="panel panel-warning">
				<div class="panel-heading">
					<h3 class="panel-title">
						<a class="block-collapse" data-toggle="collapse" href="<?php echo '#evolution_' . $category->id; ?>">
							Course Levels
							<span class="right-content">
								<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
							</span>
						</a>
					</h3>
				</div>

				<div id="<?php echo 'evolution_' . $category->id; ?>" class="collapse in">
					<div class="panel-body">
						<div class="panel-group" id="evolution-clan-list">
							<?php 
								foreach (${'evolution_levels_' . $category->id} as $levels) { 
									$can_apply = false;
									if(isset($evolution_clan_completed[$category->id]) && in_array($levels->id, $evolution_clan_completed[$category->id])) {
										$panel_class = 'panel-success';
									} else if(isset($evolution_clan_active[$category->id]) && in_array($levels->id, $evolution_clan_active[$category->id])) {
										$panel_class = 'panel-info';
									} else if($levels->on_passing == 0 || (isset($evolution_clan_completed[$category->id]) && in_array($levels->on_passing, $evolution_clan_completed[$category->id]))){
										$panel_class = 'panel-primary';
										$can_apply = true;
									} else {
										$panel_class = 'panel-danger';
									}
							?>
								<div class="panel <?php echo $panel_class; ?>">
									<div class="panel-heading">
										<h3 class="panel-title">
											<a class="block-collapse" data-parent="#evolution-clan-list" data-toggle="collapse" href="#levels-<?php echo $levels->id; ?>">
												<?php echo $levels->{$session->language.'_name'}; ?>
												<span class="right-content">
													<span class="right-icon"><i class="glyphicon glyphicon-plus icon-collapse"></i></span>
												</span>
											</a>
										</h3>
									</div>

									<div id="levels-<?php echo $levels->id; ?>" class="collapse">
										<div class="panel-body">
											<?php if(isset(${'evolution_clans_'. $levels->id}) && count(${'evolution_clans_'. $levels->id}) > 0) { ?>
												<ul class="list-group margin-bottom-killer">
													<?php foreach (${'evolution_clans_'. $levels->id} as $clan) { ?>
														<li class="list-group-item">
															<a data-target="#clan_detail_<?php echo$clan->id; ?>" data-toggle="modal"><?php echo $clan->{$session->language.'_class_name'}; ?></a>
															<?php if($can_apply) { ?>
																<a href="javascript:void(0)" class="pull-right apply_for_clan" data-clan="<?php echo $clan->id; ?>">Apply Now</a>
															<?php } ?>
														</li>

														<div id="clan_detail_<?php echo$clan->id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
															<div class="modal-dialog">
																<div class="modal-content modal-no-shadow modal-no-border">
																	<div class="modal-header bg-warning no-border">
																		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
																		<h4 class="modal-title"><?php echo $clan->{$session->language.'_class_name'}; ?></h4>
																	</div>
																	<div class="modal-body">
																		<div class="table-responsive">
																			<table class="table table-th-block margin-bottom-killer">
																				<tbody>
																					<tr>
																						<td><?php echo $this->lang->line('teacher'); ?>(s) :</td>
																						<td>
																							<?php 
																							$str = NULL;
																							foreach (explode(',', $clan->teacher_id) as $value) {
																								$user = userNameAvtar($value);
																								$str .= ', <a href="'.base_url().'profile/view/'.$value.'">' .$user['name']. '</a>';
																							}; 
																							echo substr($str, 2);
																							?>
																						</td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('address'); ?> :</td>
																						<td><?php echo $clan->address; ?></td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('postal_code'); ?> :</td>
																						<td><?php echo $clan->postal_code; ?></td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('location'); ?> :</td>
																						<td><?php echo getLocationName($clan->city_id, 'City'),', ', getLocationName($clan->state_id, 'State'),', ',getLocationName($clan->country_id, 'Country'); ?></td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('phone_number'); ?>#1 :</td>
																						<td><?php echo $clan->phone_1; ?></td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('phone_number'); ?>#2 :</td>
																						<td><?php echo $clan->phone_2; ?></td>
																					</tr>
																					<tr>
																						<td><?php echo $this->lang->line('email'); ?> :</td>
																						<td><?php echo $clan->email; ?></td>
																					</tr>
																				</tbody>
																			</table>
																		</div>
																	</div>
																	<div class="modal-footer margin-top-killer">
																		<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
																	</div>
																</div>
															</div>
														</div>
													<?php } ?>
												</ul>
											<?php } else { echo '<h4 class="text-danger">No clans in this Level !!</h4>'; }?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
<?php
		} 
	}
?>