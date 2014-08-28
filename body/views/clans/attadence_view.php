<?php $session = $this->session->userdata('user_session'); ?>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h1 class="page-heading"><?php echo $this->lang->line('attendance_sheet'), ' : ', $clan_details->{$session->language.'_class_name'}; ?></h1>
	</div>

	<?php if(strtotime($date) == strtotime($current_date)) { ?>
	<div class="col-lg-6 col-xs-6">
		<a href="<?php echo base_url() . 'clan/next_week_attendance/'.$clan_details->id; ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('next_week'), ' ', $this->lang->line('attendance'); ?>"><?php echo $this->lang->line('next_class'), ' ', $this->lang->line('attendance'); ?></a>
	</div>
	<?php } ?>
</div>

<?php if(!empty($userdetails)){ ?>
<div class="the-box full no-border">
	<div class="table-responsive">
		<form class="form-horizontal" method="post" action="<?php echo base_url().'clan/save_attendance/'.$clan_details->id; ?>">
			<input type="hidden" name="date" value="<?php echo $date; ?>">
			<table class="table table-th-block table-primary">
				<thead>
					<tr>
						<th style="width: 50px;">No</th>
						<th style="width: 150px;">Full name</th>
						<th><?php echo date('l, j<\s\u\p>S</\s\u\p> F Y', strtotime($date));?></th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$count = 0;
					$first_names = array_map(function($element){return $element['firstname']; }, $userdetails);
					array_multisort($first_names, SORT_ASC, $userdetails);
					foreach ($userdetails as $value) { 
						$count++;
						?>
						<tr>
							<td>
								<?php echo $count; ?>
							</td>
							<td>
								<?php echo $value['firstname'], ' ', $value['lastname'] , ($value['type'] == 'recover') ? '&nbsp;&nbsp;<i class="fa fa-info text-danger" data-toggle="tooltip" data-original-title="Absense Recovery Student"></i>&nbsp;' : '&nbsp;'; ?>
							</td>
							<td>
								<div class="radio pull-left no-margin">
									<label>
										<input type="radio" value="1" class="i-grey-square" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 1)? 'checked' : ''; ?>>
										<?php echo $this->lang->line('present'); ?>
									</label>
								</div>
								<div class="radio pull-left no-margin">
									<label>
										<input type="radio" value="0" class="i-grey-square" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 0)? 'checked' : ''; ?>>
										<?php echo $this->lang->line('absent'); ?>
									</label>
								</div>
							</td>
						</tr>
						<?php } ?>
						<tr>
							<td colspan="3">
								<button type="submit" class="btn btn-primary">
									<?php echo $this->lang->line('save'); ?>
								</button>
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
	</div>
	<?php } else { ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-danger fade in alert-dismissable">
				<p class="text-center">
					<?php echo 'No Student is there in your Clan'; ?>
				</p>
			</div>
		</div>
	</div>
	<?php } ?>