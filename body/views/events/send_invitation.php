<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	loadChoseSelect('individual');

	$('.nav-tabs a').click(function (e) {
		str = e.currentTarget.href;
		array = str.split("#")
		loadChoseSelect(array[1]);
	})
});

function loadChoseSelect(select_name){
	$('#' + select_name + ' .chosen-select').chosen();
	$('#' + select_name + ' .chosen-select').chosen('destroy').chosen({
			display_disabled_options:false,
			display_selected_options:false
	});
}
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('send') ,' ', $this->lang->line('event'), ' ', $this->lang->line('invitation'); ?></h1>

<div class="the-box">
	<legend>
	<?php
		echo ucfirst($event_detail->{$session->language.'_name'}), ' on ';
		if(strtotime($event_detail->date_from) == strtotime($event_detail->date_to)){
		    echo date('d-m-Y', strtotime($event_detail->date_from));
		} else{
		    echo date('d-m-Y', strtotime($event_detail->date_from)), ' : ', date('d-m-Y', strtotime($event_detail->date_to));
		}
	?>
	</legend>

	<form class="form-horizontal" action="<?php echo base_url() .'event/invitation/'.$event_detail->id; ?>" method="post">
		<div class="row">
			<div class="col-sm-2">
				<ul class="nav nav-tabs left-position">
					<li class="active"><a href="#individual" data-toggle="tab"><?php echo $this->lang->line('individual'); ?></a></li>
					<li><a href="#academies" data-toggle="tab"><?php echo $this->lang->line('academy'); ?></a></li>
					<li><a href="#schools" data-toggle="tab"><?php echo $this->lang->line('school'); ?></a></li>
					<li><a href="#clans" data-toggle="tab"><?php echo $this->lang->line('clan'); ?></a></li>
					<li><a href="#students" data-toggle="tab"><?php echo $this->lang->line('student'); ?></a></li>
				</ul>
			</div>
			<div class="col-sm-10">
				<div class="tab-content">
					<div class="tab-pane active text-style" id="individual">
						<h4 class="small-title"><?php echo $this->lang->line('select_inidvidual_users'); ?></h4>
						<select class="form-control chosen-select mar-tp-10" name="to_individuals[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select_any_user'); ?>">
							<?php 
								foreach ($users as $user) {
									echo '<option value="'.$user->id.'">' . $user->firstname .' '. $user->lastname .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="academies">
						<h4 class="small-title"><?php echo $this->lang->line('select_academies'); ?></h4>
						<select class="form-control chosen-select" name="to_academies[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select_any_academy'); ?>">
							<?php 
								foreach ($academies as $academy) {
									echo '<option value="'.$academy->id.'">' . $academy->{$session->language.'_academy_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="schools">
						<h4 class="small-title"><?php echo $this->lang->line('select_schools'); ?></h4>
						<select class="form-control chosen-select required" name="to_schools[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select_any_school'); ?>">
							<?php 
								foreach ($schools as $school) {
									echo '<option value="'.$school->id.'">' . $school->{$session->language.'_school_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="clans">
						<h4 class="small-title"><?php echo $this->lang->line('select_clans'); ?></h4>
						<select class="form-control chosen-select required" name="to_clans[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select_any_clan'); ?>">
							<?php 
								foreach ($clans as $clan) {
									echo '<option value="'.$clan->id.'">' . $clan->{$session->language.'_class_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="students">
						<h4 class="small-title"><?php echo $this->lang->line('select_studetns'); ?></h4>
						<select class="form-control chosen-select required" name="to_students[]" multiple="multiple" data-placeholder="<?php echo $this->lang->line('select_any_student'); ?>">
							<?php 
								foreach ($students as $student) {
									echo '<option value="'.$student->id.'">' . $student->firstname .' '. $student->lastname .'</option>';
								}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-2">
				&nbsp;
			</div>
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary"><?php echo $this->lang->line('send') ,' ', $this->lang->line('invitation'); ?></button>
			</div>
		</div>
	</form>
</div>