<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('attendance_sheet'), ' : ', $clan_details->{$session->language.'_class_name'}; ?></h1>

<?php if(!empty($userdetails)){ ?>
<div class="the-box full no-border">
	<div class="table-responsive">
		<form class="form-horizontal" method="post" action="<?php echo base_url().'clan/save_attadence/'.$clan_details->id; ?>">
		<input type="hidden" name="date" value="<?php echo $date; ?>">
			<table class="table table-th-block table-primary">
				<thead>
					<tr>
						<th style="width: 30px;">No</th>
						<th style="width: 150px;">Full name</th>
						<th><?php echo date('l, jS F Y', strtotime($date));?></th>
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
								<?php echo $value['firstname'], ' ', $value['lastname']; ?>
							</td>
							<td>
								<div class="radio pull-left no-margin">
									<label>
										<input type="radio" value="1" class="i-grey-square" name="user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 1)? 'checked' : ''; ?>>
										<?php echo $this->lang->line('present'); ?>
									</label>
								</div>
								<div class="radio pull-left no-margin">
									<label>
										<input type="radio" value="0" class="i-grey-square" name="user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 0)? 'checked' : ''; ?>>
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