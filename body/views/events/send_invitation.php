<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
		 $('.nav-tabs a').click(function (e) {
		 	str = e.currentTarget.href;
		 	array = str.split("#")
		 	//alert(array[1]);
			$('#' + array[1] + ' .chosen-select').chosen('destroy').chosen();
		})
});
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('send') ,' ', $this->lang->line('event'), ' ', $this->lang->line('invitation'); ?></h1>

<div class="the-box">
	<legend>
		<?php echo ucfirst($event_detail->{$session->language.'_name'}), ' on ',  date('d-m-Y', strtotime($event_detail->date_from)), ' ', strtolower($this->lang->line('to')) ,' ' , date('d-m-Y', strtotime($event_detail->date_to));
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
						<h2>Select Individuals User's</h2>
						<select class="form-control chosen-select" name="to_individuals[]" multiple="multiple" required data-bv-notempty-message="Select any User" data-bv-excluded="false">
							<?php 
								foreach ($users as $user) {
									echo '<option value="'.$user->id.'">' . $user->firstname .' '. $user->lastname .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="academies">
						<h2>Select Academies</h2>
						<select class="form-control chosen-select" name="to_academies[]" multiple="multiple">
							<?php 
								foreach ($academies as $academy) {
									echo '<option value="'.$academy->id.'">' . $academy->{$session->language.'_academy_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="schools">
						<h2>Select Schools</h2>
						<select class="form-control chosen-select required" name="to_schools[]" multiple="multiple" >
							<?php 
								foreach ($schools as $school) {
									echo '<option value="'.$school->id.'">' . $school->{$session->language.'_school_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="clans">
						<h2>Select Clans</h2>
						<select class="form-control chosen-select required" name="to_clans[]" multiple="multiple">
							<?php 
								foreach ($clans as $clan) {
									echo '<option value="'.$clan->id.'">' . $clan->{$session->language.'_class_name'} .'</option>';
								}
							?>
						</select>
					</div>

					<div class="tab-pane text-style" id="students">
						<h2>Select Students</h2>
						<select class="form-control chosen-select required" name="to_students[]" multiple="multiple">
							<?php 
								foreach ($students as $student) {
									echo '<option value="'.$student->id.'">' . $student->firstname .' '. $student->lastname .'</option>';
								}
							?>
						</select>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
				<button type="submit" class="btn btn-primary">Send</button>
			</div>
		</div>
	</form>
</div>