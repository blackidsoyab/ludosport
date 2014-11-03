<?php $session = $this->session->userdata('user_session'); ?>

<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#batch_assignment").validate({
        	ignore: "",
        	errorPlacement: function(error, element) {
                element.parent().find('.select-error').html(error);
            }
        });
    });
    //]]>
</script>

<h1 class="page-heading">
	<?php echo $this->lang->line('tournament'), ' ', $this->lang->line('batch_assignment'), ' : '; ?>
	<a href="<?php echo base_url() .'event/view/'. $event_detail->id;?>"><?php echo $event_detail->{$session->language.'_name'}; ?></a>
</h1>

<div class="the-box">
	<?php if($batches_details != false && $present_students != false) { ?>
        <form id="batch_assignment" method="post" class="form-horizontal" action="<?php echo base_url() . 'event/tournament/batch_assignment/'. $event_detail->id; ?>">
			<?php foreach($batches_details as $batch) { ?>
				<div class="form-group">
	            	<label class="col-lg-3 control-label"><?php echo $batch->{$session->language.'_name'}; ?></label>
	            	<div class="col-lg-5">
	            		<select class="form-control chosen-select" name="batch[<?php echo $batch->id?>]">
	            			<option value=""><?php echo $this->lang->line('select'),' ', $this->lang->line('student')  ?></option>
                            <?php
                                if (count($assigned_batches) > 0 &&(in_array($batch->id, array_keys($assigned_batches))) !== false) {
                                    $batch_student_id = $assigned_batches[$batch->id];
                                }else{
                                    $batch_student_id = 0;
                                }
                            ?>
            				<?php foreach($present_students as $student) { ?>
            					<option value="<?php echo $student->student_id; ?>" <?php echo ($batch_student_id == $student->student_id) ? 'selected' : ''; ?>><?php echo $student->student_name; ?></option>
            				<?php } ?>
	            		</select>
	            		<span class="select-error"></span>
	            	</div>
	            </div>
            <?php } ?>
            <div class="form-group">
                <label class="col-lg-3 control-label">&nbsp;</label>
                <div class="col-lg-5">
                    <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                    <a href="<?php echo base_url() . 'event/view/'.$event_detail->id ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
                </div>
            </div>
        </form>
	<?php } else { echo '<h1 class="text-center text-danger">'. $this->lang->line('no_student_present') .'</h1>'; }?>
</div>
