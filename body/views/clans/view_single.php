<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript" >
	function deleteRow(ele) {
	    $.confirm({
	        'title': 'Manage Clan Date',
	        'message': 'Do you Want to Delete ?',
	        'buttons': {
	            '<?php echo $this->lang->line("yes"); ?>': {
	            	'class': 'btn btn-danger',
	                'action': function() {
	                    UpdateClanDate(ele, 0);
	            	}
	            },
	            '<?php echo $this->lang->line("yes").', '. $this->lang->line("notify"); ?>': {
	                'class': 'btn btn-primary',
	                'action': function() {
	                    UpdateClanDate(ele, 1);
	            	},
	        	},
	            '<?php echo $this->lang->line("no"); ?>': {
	                'class': 'btn btn-default'	
	            }
	   		}
	    });
	    return false;
	}

	function UpdateClanDate(ele, notify){
		var current_id = $(ele).attr('id');
	    var parent = $(ele).parent().parent();
		$.ajax({
			type: 'POST',
			url: http_host_js + 'clan/delete_date/' + current_id,
			data: {'id' : current_id, 'notify' : notify},
			dataType : 'JSON',
			success: function(data) {
				window.location.reload();
			}
		});
	}

	$(document).ready(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
			PositionFooter();
		});
	});
</script>
<h1 class="page-heading"><?php echo $clan->{$session->language.'_class_name'}; ?></h1>

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
						<a href="#clan-detail" data-toggle="tab">
							<?php echo $this->lang->line('clan'); ?>
						</a>
					</li>

					<li>
						<a href="#student-detail" data-toggle="tab">
							<?php echo $this->lang->line('student'); ?>
							<span class="badge badge-primary"><?php echo count($students); ?></span>
						</a>
					</li>

					<li>
						<a href="#clan-dates" data-toggle="tab">
							<?php echo $this->lang->line('clan'), ' ', $this->lang->line('date'); ?>
						</a>
					</li>

					<li>
						<a href="#teacher-attadence" data-toggle="tab">
							<?php echo $this->lang->line('teacher'), ' ', $this->lang->line('attendance'); ?>
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

					<div class="tab-pane fade in active" id="clan-detail">
						<h4><?php echo $clan->{$session->language.'_class_name'}; ?></h4>
						<div class="table-responsive">
							<table class="table table-th-block">
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

					<div class="tab-pane fade" id="clan-dates">
						<?php if (hasPermission('clans', 'changeClanDate')) { ?>
							<script type="text/javascript">
								$(document).ready(function() {
									$('.datepicker').datepicker({
							            format: "dd-mm-yyyy",
							            startDate: "<?php echo date('d-m-Y', strtotime(get_current_date_time()->get_date_for_db())); ?>",
							            endDate: "<?php echo date('d-m-Y', strtotime($clan->clan_to)); ?>",
							            startView: 2,
							            autoclose: true,
							            todayHighlight: true
							        }).on('changeDate', function (ev) {
							            $(this).datepicker('hide');
							        });

							        $('#form-clan-change-date').validate();
							    });
							</script>

							<h4><?php echo $this->lang->line('change'), ' ',$this->lang->line('clan'), ' ', $this->lang->line('date'); ?></h4>
							<form id="form-clan-change-date" class="form-horizontal" method="post" action="<?php echo base_url() .'clan/change_date/' .$clan->id; ?>">
								<input type="hidden" value="<?php echo $clan->id; ?>" name="clan_id">
								<div class="form-group">
						            <label for="question" class="col-lg-3 control-label">
						                <?php echo $this->lang->line('date_from'); ?>
						                <span class="text-danger">*</span>
						            </label>
						            <div class="col-lg-5">
						                <select name="clan_shift_from" class=" form-control required">
						                	<option value=""><?php echo $this->lang->line('date_from'); ?></option>
						                	<?php foreach ($next_clan_dates as $clan_date) { ?>
						                        <option value="<?php echo $clan_date; ?>"><?php echo date('d-m-Y', strtotime($clan_date)); ?></option>
						                    <?php } ?>
						                </select>
						            </div>
						        </div>

						        <div class="form-group">
						            <label for="question" class="col-lg-3 control-label">
						                <?php echo $this->lang->line('date_to'); ?>
						                <span class="text-danger">*</span>
						            </label>
						            <div class="col-lg-5">
						                <input type="text" name="clan_date"  class=" form-control required datepicker" placeholder="<?php echo $this->lang->line('date_to'); ?>"/>
						            </div>
						        </div>

						        <div class="form-group">
						            <label for="question" class="col-lg-3 control-label">
						                <?php echo $this->lang->line('reason'); ?>
						                <span class="text-danger">&nbsp;</span>
						            </label>
						            <div class="col-lg-5">
						                <textarea name="description" class="form-control"></textarea>
						            </div>
						        </div>

						        <div class="form-group">
						            <label class="col-lg-3 control-label">Notify related users</label>
						            <div class="col-lg-5">
						                <input type="checkbox" value="1" class="i-grey-square" name="notify">
						            </div>
						        </div>
						        <div class="form-group">
						            <label class="col-lg-3 control-label">&nbsp;</label>
						            <div class="col-lg-5">
						                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
						                <a href="<?php echo base_url() . 'user' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
						            </div>
						        </div>

						        <div class="form-group">
						            <label class="col-lg-3 control-label">&nbsp;</label>
						            <div class="col-lg-5">
						                <?php echo $this->lang->line('compulsory_note'); ?>
						            </div>
						        </div>
							</form>
						<?php } ?>
						<h4><?php echo $this->lang->line('manage'),' ', $this->lang->line('clan'), ' ', $this->lang->line('dates'); ?></h4>
						<?php if($clan_dates->result_count() > 0) { ?>
							<div class="table-responsive">
								<table class="table table-th-block">
									<thead>
										<td><?php echo ucwords($this->lang->line('date')); ?></td>
										<td><?php echo $this->lang->line('shift_from'); ?></td>
										<td><?php echo $this->lang->line('reason'); ?></td>
										<?php if (hasPermission('clans', 'changeClanDate')) { ?>
											<td><?php echo $this->lang->line('actions'); ?></td>
										<?php } ?>
									</thead>
									<tbody>
										<?php foreach($clan_dates as $date) { ?>
											<tr>
												<td>
												<span class="label label-primary"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date->clan_date)); ?></span>
												</td>
												<td>
													<?php if(!is_null($date->clan_shift_from)) { ?>
														<span class="label label-default"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date->clan_shift_from)); ?></span>
													<?php } else { echo '&nbsp;'; } ?>
												</td>
												<td><p><?php echo @$date->description; ?></p></td>
												<?php if (hasPermission('clans', 'changeClanDate')) { ?>
													<td>
														<?php if(strtotime(get_current_date_time()->get_date_for_db()) < strtotime($date->clan_date) && $date->type == 'S') { ?>
															<a href="javascript:;" onclick="deleteRow(this)" class="actions" id="<?php echo $date->id; ?>" data-toggle="tooltip" title="" data-original-title="Delete"><i class="fa fa-times-circle icon-circle icon-xs icon-danger"></i></a>
														<?php }else{
															echo '&nbsp;';
														}
														?>
													</td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						<?php } ?>
					</div>

					<div class="tab-pane fade" id="teacher-attadence">
						<h4><?php echo $teacher['name'], '\'s  ', $this->lang->line('attendance'); ?></h4>
						<?php if(!is_null($teacher_attendance)) { ?>
							<div class="the-box no-border tags-cloud margin-killer padding-killer">
								<span class="label label-primary"><?php echo $this->lang->line('total'); ?> </span><span class="badge badge-primary"><?php echo count($teacher_attendance); ?></span>
								<span class="label label-default"><?php echo $this->lang->line('holiday_aproval_pending'); ?></span>
								<span class="label label-success"><?php echo $this->lang->line('present'); ?></span><span class="badge badge-success"><?php echo $present; ?></span>
								<span class="label label-danger"><?php echo $this->lang->line('absence'); ?></span> <span class="badge badge-danger"><?php echo $absence; ?></span>
								<span class="label label-danger-warning"><?php echo $this->lang->line('absence_recover_teacher'); ?></span>
								<span class="label label-success-danger"><?php echo $this->lang->line('holiday_unapproved'); ?></span>
								<p class="help-block margin-killer pull-left">
									<span class="label label-danger-warning">&nbsp;</span>
									<?php echo $this->lang->line('note_mouseover_recovery_teacher_name'); ?>
								</p>
								<p class="help-block margin-killer">
									<span class="label label-success-danger">&nbsp;</span>
									<?php echo $this->lang->line('note_mouseover_unapproval_reason'); ?>
								</p>
							</div>
							<hr class="mar-tp-10 mar-bt-10" />
							<div class="the-box no-border tags-cloud padding-killer">
								<?php foreach($teacher_attendance as $date) { ?>
									<?php if($date['status'] == 'P'){ ?>
										<a href="<?php echo base_url(). 'dean/absence_approval/'. $date['id'] ; ?>">
											<span class="<?php echo $date['type']; ?>"  data-toggle="tooltip" data-original-title="<?php echo @$date['recover_teacher']['name']; ?>">
												<?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date['date'])); ?>
											</span>	
										</a>
									<?php } else if($date['status'] == 'U') { ?>
										<a href="<?php echo base_url(). 'dean/absence_approval/'. $date['id'] ; ?>">
											<span class="<?php echo $date['type']; ?>" data-toggle="tooltip" data-original-title="<?php echo @$date['unapproved_reason']; ?>">
												<?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date['date'])); ?>
											</span>
										</a>
									<?php } else { ?>
										<a href="<?php echo base_url(). 'dean/absence_approval/'. $date['id'] ; ?>">
											<span class="<?php echo $date['type']; ?>" data-toggle="tooltip" data-original-title="<?php echo @$date['recover_teacher']['name']; ?>">
												<?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date['date'])); ?>
											</span>
										</a>
									<?php } ?>
								<?php } ?>
							</div>	
						<?php } else { ?>
							<h3 class="text-danger"><?php echo $this->lang->line('no_attendance'); ?></h3>
						<?php } ?>
					</div>

					<div class="tab-pane fade" id="student-attadence">
						<h4><?php echo $this->lang->line('student'), ' ', $this->lang->line('attendance'); ?></h4>
						<?php if($clan_dates->result_count() > 0) { ?>
							<div class="the-box no-border tags-cloud">
								<?php foreach($clan_dates as $date) { ?>
									<a href="<?php echo base_url() .'clan/clan_attendance/' . $date->clan_id .'/'. $date->clan_date; ?>"><span class="label label-primary"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($date->clan_date)); ?></span></a>
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