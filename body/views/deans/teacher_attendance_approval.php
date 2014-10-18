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
			$('input[name="attendance_id"]').val($(e.currentTarget).data('attendanceid'));
			modalBody.load(remote_content);
		}).modal();
		return false;
	});

	$('#change_teacher').on('shown.bs.modal', function(){
		if($('#change_teacher .modal-body').find('input').length == 0){
			$('.replace-teacher').hide();
		}else{
			$('#change_teacher .modal-body').find('input').iCheck({radioClass: 'iradio_square-grey'});
			$('#change_recovery_teacher').validate();

			$('#change_recovery_teacher').submit(function(e) {
				var post_data = {
					'teacher_id' : $('input[name="teacher_id"]').val(),
					'attendance_id' : $('input[name="attendance_id"]').val()
				};
				$.ajax({
					type: "POST",
					url: '<?php echo  base_url(). 'dean/update_recovery_teacher'; ?>',
					data: post_data,
					dataType : 'JSON',
					success: function(data) {
						if(data.status == true){
							window.location.reload();
						}
					}	
				});
				e.preventDefault();
			});
		}
	});

	$('#to_reason').hide();

	$('#teacher_absence_approval input[name="status"]').click(function(){
        if($('input:radio[name="status"]:checked').val() == "A"){
            $('#to_reason').hide();
        }
        
        if($('input:radio[name="status"]:checked').val() == "P"){
            $('#to_reason').hide();
        }
        
        if($('input:radio[name="status"]:checked').val() == "U"){
            $('#to_reason').show();
        }
    });
});
//]]>
</script>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h1 class="page-heading h1"><?php echo $this->lang->line('communicate_absence'); ?></h1>
	</div>
</div>

<form id="teacher_absence_approval" action="<?php echo base_url().'dean/absence_approval/' . $attendance->id; ?>" method="post" class="form-horizontal">
	<div class="panel panel-primary" id="step_1">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user"></i> <?php echo $this->lang->line('communicate_absence'); ?></h3>
		</div>

		<div class="panel-body">
			<div class="panel-body ludosport-class">
				<div class="form-group">
					<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?> : </label>
					<div class="col-lg-5">
						<?php echo $clan_details->{$session->language.'_class_name'}; ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo ucwords($this->lang->line('date')); ?> : </label>
					<div class="col-lg-5">
						<?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($attendance->clan_date)); ?>
					</div>
				</div>

				<div class="form-group">
					<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo $this->lang->line('teacher'); ?> : </label>
					<div class="col-lg-5">
						<?php echo $teacher_info['name']; ?>
					</div>
				</div>

				<?php if(!is_null($attendance->from_message)){ ?>
					<div class="form-group">
						<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo $this->lang->line('reason'); ?> : </label>
						<div class="col-lg-5">
							<?php echo $attendance->from_message; ?>
						</div>
					</div>
				<?php } ?>

				<div class="form-group">
					<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo $this->lang->line('recover_teacher'); ?> : </label>
					<div class="col-lg-5">
					<?php if(isset($recovery_teacher)){ ?>
						<?php echo $recovery_teacher['name']; ?>&nbsp;&nbsp;
					<?php } else { echo '--'; } ?>
						<a href="<?php echo base_url().'dean/change_recovery_teacher/'. $attendance->id; ?>" data-target="#change_teacher" data-toggle="modal tooltip" data-original-title="<?php echo $this->lang->line('change_recovery_teacher'); ?>" data-attendanceid="<?php echo $attendance->id; ?>"><?php echo $this->lang->line('change_recovery_teacher'); ?></a>
					</div>
				</div>
				
				<div class="form-group">
		            <label class="col-lg-2 control-label" for="radios"><?php echo $this->lang->line('change_status'); ?> : </label>
		            <div class="col-lg-5"> 
		                <label class="radio-inline" for="radios-0">
		                    <input type="radio" name="status" id="radios-0" value="A" <?php echo ($attendance->status == 'A') ? 'checked' : ''; ?>>
		                    <?php echo $this->lang->line('approved'); ?>
		                </label> 
		                <label class="radio-inline" for="radios-1">
		                    <input type="radio" name="status" id="radios-1" value="P" <?php echo ($attendance->status == 'P') ? 'checked' : ''; ?>>
		                    <?php echo $this->lang->line('pending'); ?>
		                </label> 
		                <label class="radio-inline" for="radios-2">
		                    <input type="radio" name="status" id="radios-2" value="U" <?php echo ($attendance->status == 'U') ? 'checked' : ''; ?>>
		                    <?php echo $this->lang->line('unapproved'); ?>
		                </label> 
		            </div>
		        </div>

		        <div class="form-group" id="to_reason">
					<label class="col-lg-2 control-label padding-top-killer margin-killer"><?php echo $this->lang->line('reason'); ?> : </label>
					<div class="col-lg-5">
						<textarea name="to_reason" class="form-control bold-border required"></textarea>
					</div>
				</div>

				<div class="form-group">
	            <label class="col-lg-2 control-label">&nbsp;</label>
	            <div class="col-lg-5">
	                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
	                <a href="<?php echo base_url() . 'clan/view/'. $attendance->clan_id; ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
	            </div>
	        </div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="change_teacher"  tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow">
			<form id="change_recovery_teacher" method="post">
			<input type="hidden" name="attendance_id" value="0">
				<div class="modal-header bg-primary no-border text-white">
					<h4 class="modal-title"><?php echo $this->lang->line('select'), ' ' , $this->lang->line('recovery'); ?></h4>
				</div>
				<div class="modal-body">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-inverse" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
					<button type="submit" class="btn btn-primary replace-teacher"><?php echo $this->lang->line('save'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>