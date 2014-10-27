<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading"><?php echo $this->lang->line('attendance_sheet'), ' : ', $clan_details->{$session->language.'_class_name'}; ?></h1>


<?php if(!empty($userdetails)){ ?>
	<div class="the-box full no-border">	
		<div class="table-responsive">
			<form class="form-horizontal" method="post" action="<?php echo base_url().'evolutionclan/save_attendance/'.$clan_details->id; ?>">
				<input type="hidden" name="date" value="<?php echo $date; ?>">
				<table class="table">
					<thead>
						<tr class="bg-primary">
							<td style="width: 50px;"><?php echo $this->lang->line('no'); ?></td>
							<td style="width: 150px;"><?php echo $this->lang->line('full_name'); ?></td>
							<td style="width: 250px;"><?php echo date('l, j<\s\u\p>S</\s\u\p> F Y', strtotime($date));?></td>
							<td ><?php echo $this->lang->line('clan'), ', ', $this->lang->line('school'), ', ', $this->lang->line('academy'); ?></td>
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
							<tr id="<?php echo 'user_id_', $value['id']; ?>">
								<td>
									<?php echo $count; ?>
								</td>
								<td>
									<?php echo $value['firstname'], ' ', $value['lastname']; ?>
								</td>
								<td>
									<div class="row">
										<div class="col-md-12">
											<label class="radio-inline" for="P-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]">
										      <input type="radio" for="P-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" value="1" class="radio i-grey-square" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 1)? 'checked' : ''; ?>>
										      <?php echo $this->lang->line('present'); ?>
										    </label>

										    <label class="radio-inline margin-left-killer" for="A-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]">
										      <input type="radio" for="A-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" value="0" class="radio i-grey-square" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 0)? 'checked' : ''; ?>>
										      <?php echo $this->lang->line('absent'); ?>
										    </label>
										</div> 
									</div> 
								</td>
								<td>
									<?php echo $value['clan'],', ', $value['school'],', ', $value['academy']; ?>
								</td>
							</tr>
							<?php } ?>
							<?php if($show_save_button){ ?>
								<tr>
									<td colspan="5">
										<button type="submit" class="btn btn-primary">
											<?php echo $this->lang->line('save'); ?>
										</button>
									</td>
								</tr>
							<?php } ?>
							
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
					<?php echo $this->lang->line('no_student_in_clan'); ?>
				</p>
			</div>
		</div>
	</div>
<?php } ?>