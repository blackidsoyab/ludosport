<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo $this->lang->line('change_status'), ' ', $this->lang->line('batch_request'); ?></h1>

<div class="row">

	<div class="col-sm-4">
		<div class="the-box no-border full">
			<div class="the-box no-border text-center">
				<h4 class="bolded"><?php echo $this->lang->line('pupil'), ' ',$this->lang->line('details'); ?></h4>
				<img src="<?php echo IMG_URL ."user_avtar/100X100/" . $request_details->student_image; ?>" class="img-circle request-img" alt="Avatar">
				<h4><a href="<?php echo base_url() .'profile/view/'. $request_details->student_id; ?>"><?php echo $request_details->student; ?></a></h4>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="the-box no-border full">
			<div class="the-box no-border text-center">
				<h4 class="bolded"><?php echo $this->lang->line('batch'), ' ',$this->lang->line('details'); ?></h4>
				<img src="<?php echo IMG_URL ."batches/" . $request_details->batch_image; ?>" class="img-circle request-img" alt="Avatar">
				<h4><?php echo $batch_type ,' : ', $request_details->batch_name; ?></h4>
			</div>
		</div>
	</div>

	<div class="col-sm-4">
		<div class="the-box no-border full">
			<div class="the-box no-border text-center">
				<h4 class="bolded"><?php echo $this->lang->line('request_user'), ' ',$this->lang->line('details'); ?></h4>
				<img src="<?php echo IMG_URL ."user_avtar/100X100/" . $request_details->request_user_image; ?>" class="img-circle request-img" alt="Avatar">
				<h4><a href="<?php echo base_url() .'profile/view/'. $request_details->from_id; ?>"><?php echo $request_details->request_user; ?></a></h4>
			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="the-box">
			<?php if(!is_null($request_details->description)) { ?>
				<p><?php echo  $this->lang->line('reason'), ' : ', $request_details->description?></p>
			<?php } ?>

			<?php if($request_details->status != 'P' && isset($request_status)) { ?>
				<p><?php echo  $this->lang->line('status'), ' : ', $request_status; ?></p>
			<?php } ?>

			<?php if($request_details->status != 'P' && isset($request_status_changed_by)) { ?>
				<p><?php echo  $this->lang->line('done_by'), ' : ', $request_status_changed_by['name']; ?></p>
			<?php } ?>

			<div class="text-center">
				<?php if($show_approve_button || $show_unapprove_button) { ?>
					<form action="<?php base_url() . 'batchrequest/changestatus/' . $request_details->id ?>" method="post" class="inline">
						<input type="hidden" name="from_role" value="<?php echo $request_details->from_role; ?>" />
						<input type="hidden" name="from_id" value="<?php echo $request_details->from_id; ?>" />
						<input type="hidden" name="batch_id" value="<?php echo $request_details->batch_id; ?>" />
						<input type="hidden" name="student_id" value="<?php echo $request_details->student_id; ?>" />
						<?php if($show_approve_button) { ?>
							<button type="submit" name="approved" value="A" class="btn btn-success"><?php echo $this->lang->line('approve_batch_request'); ?></button>
						<?php } ?>

						<?php if($show_unapprove_button) { ?>
		                    <button type="submit" name="unapproved" value="U" class="btn btn-danger"><?php echo $this->lang->line('unapprove_batch_request'); ?></button>
						<?php } ?>
					</form>
				<?php } ?>
	            <a href="<?php echo base_url(). 'batchrequest'; ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('back'); ?>"><?php echo $this->lang->line('back'); ?></a>
            </div>
		</div>
	</div>
</div>