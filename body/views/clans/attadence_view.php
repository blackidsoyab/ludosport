<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {

	$('a[data-toggle~="modal"]').on('click', function(e) {
		var target_modal = $(e.currentTarget).data('target');
		var remote_content = e.currentTarget.href;
		var modal = $(target_modal);
		var modalBody = $(target_modal + ' .modal-body');
		modal.on('show.bs.modal', function () {
			$("input[name='student_id']").val($(e.currentTarget).data('studentid'));
			$("input[name='attendance_id']").val($(e.currentTarget).data('attendanceid'));
			modalBody.load(remote_content);
		}).modal();
		return false;
	});


	$('#change_dates').on('shown.bs.modal', function(){
		$('#change_dates .modal-body').find('input').iCheck({radioClass: 'iradio_square-grey'});
			$('#clan_dates').validate({
			rules: {
				clan_id: {required: true},
				absence_date: {required: true},
			},
			messages: {
				absence_date: {required: '* Please select any Date'},
			}
		});

		$("input[name='clan_id']").on('ifChecked', function(event){
			$.ajax({
				type: "POST",
				url: '<?php echo  base_url(). "getclandates_teacher/"; ?>' + $("input[name='clan_id']:checked").val(),
				success: function(data) {
					$('#clan-dates-selection').html(data);
					$('#change_dates .modal-body').find('input').iCheck({radioClass: 'iradio_square-grey'});
				}
			});
		});			

		$('#clan_dates').submit(function(e) {
			var post_data = {
				'current_clan_id' : $("input[name='current_clan_id']").val(),
				'clan_id' : $("input[name='clan_id']:checked").val(),
				'student_id' : $("input[name='student_id']").val(),
				'date' : $("input[name='date']:checked").val(),
				'attendance_id' : $("input[name='attendance_id']").val()
			};
			$.ajax({
				type: "POST",
				url: '<?php echo  base_url(). 'mark_student_absence_teacher'; ?>',
				data: post_data,
				dataType : 'JSON',
				success: function(data) {
					if(data.status == true){
						$('#change_dates').modal('hide');
						$('tr#user_id_' + data.student_id).animate({height: 0}, 1000,"swing",function() {
                            $(this).remove();
                        })
					}
				}	
			});
			e.preventDefault();
		});
	});

});
//]]>
</script>
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
				<table class="table">
					<thead>
						<tr class="bg-primary">
							<td style="width: 50px;"><?php echo $this->lang->line('no'); ?></td>
							<td style="width: 150px;"><?php echo $this->lang->line('full_name'); ?></td>
							<td style="width: 250px;"><?php echo date('l, j<\s\u\p>S</\s\u\p> F Y', strtotime($date));?></td>
							<td ><?php echo $this->lang->line('clan'), ', ', $this->lang->line('school'), ', ', $this->lang->line('academy'); ?></td>
							<td style="width: 100px;"><?php echo $this->lang->line('recovery'); ?></td>
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
										      <input type="radio" for="P-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" value="1" class="radio" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 1)? 'checked' : ''; ?>>
										      <?php echo $this->lang->line('present'); ?>
										    </label>

										    <label class="radio-inline" for="A-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]">
										      <input type="radio" for="A-radios-<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" value="0" class="radio" name="<?php echo $value['type']; ?>_user_id[<?php echo $value['id']; ?>]" <?php echo ($value['attadence'] == 0)? 'checked' : ''; ?>>
										      <?php echo $this->lang->line('absent'); ?>
										    </label>
										</div> 
									</div> 
								</td>
								<td>
									<?php echo $value['clan'],', ', $value['school'],', ', $value['academy']; ?>
								</td>
								<td>
									<?php if(strtotime(get_current_date_time()->get_date_for_db()) <= strtotime($date) &&  !empty($value['attadence_id'])){ ?>
										<a href="<?php echo base_url().'get_same_level_clan/'. $clan_details->id; ?>" data-target="#change_dates" data-toggle="modal tooltip" data-original-title="<?php echo $this->lang->line('assign_recovery_clan'); ?>" data-studentid="<?php echo $value['id']; ?>" data-attendanceid="<?php echo $value['attadence_id']; ?>">
											<i class="fa fa-repeat icon-circle icon-bordered icon-xs icon-primary"></i>
										</a>
									<?php } ?>
									<?php if($value['type'] == 'recover'){ ?>
										 <i class="fa fa-info icon-circle icon-bordered icon-xs icon-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('absenece_recovery_student'); ?>"></i>
									<?php } ?>
									<?php if($value['type'] == 'trial'){ ?>
										 <i class="fa fa-info icon-circle icon-bordered icon-xs icon-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('trial_request_student'); ?>"></i>
									<?php } ?>
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


<div class="modal fade" id="change_dates"  tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow">
			<form id="clan_dates">
			<input type="hidden" name="current_clan_id" value="<?php echo $clan_details->id; ?>">
			<input type="hidden" name="student_id" value="0">
			<input type="hidden" name="attendance_id" value="0">
				<div class="modal-header bg-primary no-border text-white">
					<h4 class="modal-title"><?php echo $this->lang->line('select'), ' ' , $this->lang->line('recovery'); ?></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-inverse" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
					<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>