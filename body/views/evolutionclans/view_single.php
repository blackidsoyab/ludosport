<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript" >
	$(document).ready(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			PositionFooter();
		});
	});
</script>
<h1 class="page-heading"><?php echo $evolution_clan->{$session->language.'_class_name'}; ?></h1>

<div class="row">
	<div class="col-md-12">
		<div class="panel with-nav-tabs panel-primary panel-square panel-no-border">
			<div class="panel-heading">
				<ul class="nav nav-tabs">
					<li>
						<a href="#academy-detail" data-toggle="tab">
							<?php echo $this->lang->line('academy'); ?>
						</a>
					</li>

					<li>
						<a href="#school-detail" data-toggle="tab">
							<?php echo $this->lang->line('school'); ?>
						</a>
					</li>

					<li class="active">
						<a href="#evolution-clan-detail" data-toggle="tab">
							<?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('clan'); ?>
						</a>
					</li>

					<li>
						<a href="#student-detail" data-toggle="tab">
							<?php echo $this->lang->line('student'); ?>
							<span class="badge badge-primary"><?php echo count($students); ?></span>
						</a>
					</li>

					<li>
						<a href="#evolution-clan-dates" data-toggle="tab">
							<?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('date'); ?>
						</a>
					</li>

					<li>
						<a href="#student-attadence" data-toggle="tab">
							<?php echo $this->lang->line('student'), ' ', $this->lang->line('attendance'); ?>
						</a>
					</li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade" id="academy-detail">
						<h4><?php echo $academy->{$session->language.'_academy_name'}; ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
								<tbody>
									<tr>
										<td width="35%"><?php echo $this->lang->line('type'); ?> :</td>
										<td><?php echo ($academy->type == 'ac') ? $this->lang->line('academy') : $this->lang->line('affiliated_school'); ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('rector'); ?>(s) :</td>
										<td>
											<?php 
											$str = NULL;
											foreach (explode(',', $academy->rector_id) as $value) {
												$user = userNameAvtar($value);
												$str .= ', <a href="'.base_url().'profile/view/'.$value.'">' .$user['name']. '</a>';
											}; 
											echo substr($str, 2);
											?>
										</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('fee'); ?>1 :</td>
										<td><?php echo $academy->fee1; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('fee'); ?>2 :</td>
										<td><?php echo $academy->fee2; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
						<h4><?php echo $this->lang->line('contact'), ' ', $this->lang->line('details'); ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
								<tbody>
									<tr>
										<td width="35%"><?php echo $this->lang->line('name'); ?> :</td>
										<td><?php echo $academy->contact_firstname, ' ', $academy->contact_lastname; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('association_full_name'); ?> :</td>
										<td><?php echo $academy->association_fullname; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('role_referent'); ?> :</td>
										<td><?php echo $academy->role_referent; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('address'); ?> :</td>
										<td><?php echo $academy->address; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('postal_code'); ?> :</td>
										<td><?php echo $academy->postal_code; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('location'); ?> :</td>
										<td><?php echo getLocationName($academy->city_id, 'City'),', ', getLocationName($academy->state_id, 'State'),', ',getLocationName($academy->country_id, 'Country'); ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#1 :</td>
										<td><?php echo $academy->phone_1; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#2 :</td>
										<td><?php echo $academy->phone_2; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('email'); ?> :</td>
										<td><?php echo $academy->email; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade" id="school-detail">
						<h4><?php echo $school->{$session->language.'_school_name'}; ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
								<tbody>
									<tr>
										<td><?php echo $this->lang->line('dean'); ?>(s) :</td>
										<td>
											<?php 
											$str = NULL;
											foreach (explode(',', $school->dean_id) as $value) {
												$user = userNameAvtar($value);
												$str .= ', <a href="'.base_url().'profile/view/'.$value.'">' .$user['name']. '</a>';
											}; 
											echo substr($str, 2);
											?>
										</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('address'); ?> :</td>
										<td><?php echo $school->address; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('postal_code'); ?> :</td>
										<td><?php echo $school->postal_code; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('location'); ?> :</td>
										<td><?php echo getLocationName($school->city_id, 'City'),', ', getLocationName($school->state_id, 'State'),', ',getLocationName($school->country_id, 'Country'); ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#1 :</td>
										<td><?php echo $school->phone_1; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#2 :</td>
										<td><?php echo $school->phone_2; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('email'); ?> :</td>
										<td><?php echo $school->email; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade in active" id="evolution-clan-detail">
						<h4><?php echo $evolution_clan->{$session->language.'_class_name'}; ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
								<tbody>
									<tr>
										<td><?php echo $this->lang->line('teacher'); ?>(s) :</td>
										<td>
											<?php 
											$str = NULL;
											foreach (explode(',', $evolution_clan->teacher_id) as $value) {
												$user = userNameAvtar($value);
												$str .= ', <a href="'.base_url().'profile/view/'.$value.'">' .$user['name']. '</a>';
											}; 
											echo substr($str, 2);
											?>
										</td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('address'); ?> :</td>
										<td><?php echo $evolution_clan->address; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('postal_code'); ?> :</td>
										<td><?php echo $evolution_clan->postal_code; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('location'); ?> :</td>
										<td><?php echo getLocationName($evolution_clan->city_id, 'City'),', ', getLocationName($evolution_clan->state_id, 'State'),', ',getLocationName($evolution_clan->country_id, 'Country'); ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#1 :</td>
										<td><?php echo $evolution_clan->phone_1; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('phone_number'); ?>#2 :</td>
										<td><?php echo $evolution_clan->phone_2; ?></td>
									</tr>
									<tr>
										<td><?php echo $this->lang->line('email'); ?> :</td>
										<td><?php echo $evolution_clan->email; ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="tab-pane fade" id="student-detail">
						<?php if(!is_null($students)) { ?>
						<h4><?php echo $this->lang->line('list'), ' ', $this->lang->line('student'), '(s)'; ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
								<thead>
									<td><?php echo $this->lang->line('full_name'); ?></td>
									<td><?php echo $this->lang->line('dob'); ?></td>
									<td><?php echo $this->lang->line('status'); ?></td>
									<td><?php echo $this->lang->line('location'); ?></td>
								</thead>
								<tbody>
									<?php 
										$students = subvalue_sort($students, 'firstname');
										foreach ($students as $stud) { 
									?>
									<tr>
										<td>
											<img src="<?php echo IMG_URL .'user_avtar/40X40/' . $stud->avtar; ?>" class="avatar img-circle" alt="avatar">
											<a href="<?php echo base_url().'profile/view/'.$stud->id; ?>">
												<?php echo $stud->firstname,' ',$stud->lastname; ?>
											</a>
										</td>
										<td><?php echo date('d-m-Y', $stud->date_of_birth);?></td>
										<td>
											<?php 
											if($stud->status == 'A') {
												echo '<span class="label label-success">Active</span>';
											} else if($stud->status == 'P') {
												echo '<span class="label label-warning">Pending</span>';
											} else if($stud->status == 'D') {
												echo '<span class="label label-default">Deactive</span>';
											} else if($stud->status == 'U') {
												echo '<span class="label label-danger">Unapproved</span>';
											} 
											?>
										</td>
										<td>
											<?php echo getLocationName($stud->city_id, 'City'),', ', getLocationName($stud->state_id, 'State'),', ',getLocationName($stud->country_id, 'Country'); ?>
										</td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
						<?php } else { ?>
						<h3 class="text-danger"><?php echo $this->lang->line('no_student'); ?></h3>
						<?php } ?>
					</div>

					<div class="tab-pane fade" id="evolution-clan-dates">
						<h4><?php echo $this->lang->line('evolutionclan'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('date'); ?></h4>
						<?php if($next_clan_dates->result_count() > 0) { ?>
							<div class="the-box no-border tags-cloud">
								<?php foreach($next_clan_dates as $date) { ?>
									<a href="#"><span class="label label-primary"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date->clan_date)); ?></span></a>
								<?php } ?>
							</div>	
						<?php } ?>
					</div>

					<div class="tab-pane fade" id="student-attadence">
						<h4><?php echo $this->lang->line('student'), ' ', $this->lang->line('attendance'); ?></h4>
						<?php if($next_clan_dates->result_count() > 0) { ?>
							<div class="the-box no-border tags-cloud">
								<?php foreach($next_clan_dates as $date) { ?>
									<a href="<?php echo base_url() .'evolutionclan/clan_attendance/' . $date->evolutionclan_id .'/'. $date->clan_date; ?>"><span class="label label-primary"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date->clan_date)); ?></span></a>
								<?php } ?>
							</div>	
						<?php } else { ?>
							<h3 class="text-danger"><?php echo $this->lang->line('no_attendance'); ?></h3>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>