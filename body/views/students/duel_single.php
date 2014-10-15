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
			$("input[name='id']").val($(e.currentTarget).data('challenge_id'));
			modalBody.load(remote_content);
		}).modal();
		return false;
	});

	$('#duel_declare_result').on('shown.bs.modal', function(){
		$('#duel_declare_result .modal-body').find('input').iCheck({radioClass: 'iradio_square-grey'});
		$('#duel_result').validate();

		$('#duel_result').submit(function(e) {
			var post_data = {
				'id' : $("input[name='id']").val(),
				'winner' : $("input[name='winner']:checked").val(),
			};
			$.ajax({
				type: "POST",
				url: '<?php echo  base_url(). "duels/declare_result"; ?>',
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
	});
});
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('challenge') . @$type; ?></h1>
<div class="row">
	<div class="col-lg-8">
		<div class="the-box duel-single">
			<form class="form-horizontal" role="form" method="post" action="<?php echo base_url().'duels/single/' . $single->id ; ?>">
				<input type="hidden" name="from_id" value="<?php echo $single->from_id?>" />
				<input type="hidden" name="to_id" value="<?php echo $single->to_id; ?>" />
				<input type="hidden" name="id" value="<?php echo $single->id; ?>" />
				<?php if($status != false){?>
	            	<div class="form-group">
                    	<?php echo $status; ?>
		            </div>
	            <?php } ?>

				<div class="form-group">
	                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('from')), ' : '; ?></label>
	                <div class="col-lg-8">
	                    <p class="form-control-static"><a href="<?php echo base_url() .'profile/view/' .$challenge_user->id ; ?>"><?php echo $challenge_user->firstname .' ' . $challenge_user->lastname; ?></a></p>
	                </div>
	            </div>

	            <div class="form-group">
	                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('score')), ' : '; ?></label>
	                <div class="col-lg-8">
	                    <p class="form-control-static"><?php echo $challenge_userdetail->total_score; ?></p>
	                </div>
	            </div>

	            <div class="form-group">
	                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('clan')), ' : '; ?></label>
	                <div class="col-lg-8">
	                    <p class="form-control-static"><?php echo $challenge_user_ac_sc_clan_name; ?></p>
	                </div>
	            </div>

	            <?php if(!is_null($single->played_on)) { ?>
		            <div class="form-group">
		                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('date')), ' : '; ?></label>
		                <div class="col-lg-8">
		                    <p class="form-control-static"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($single->played_on)) ?></p>
		                </div>
		            </div>
	            <?php } ?>

	            <?php if(!is_null($single->played_on)) { ?>
		            <div class="form-group">
		                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('time')), ' : '; ?></label>
		                <div class="col-lg-8">
		                    <p class="form-control-static"><?php echo date('H:i a', strtotime($single->played_on)) ?></p>
		                </div>
		            </div>
	            <?php } ?>

	            <?php if(!is_null($single->place) && $single->place != 0) { ?>
	            	<div class="form-group">
		                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('place')), ' : '; ?></label>
		                <div class="col-lg-8">
		                    <p class="form-control-static"><?php echo @$single->place; ?></p>
		                </div>
		            </div>
	            <?php } ?>

	            <?php if($single->from_status == 'R' || $single->to_status == 'R') { ?>
	            	<div class="form-group">
		                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('rejected')), ' : '; ?></label>
		                <div class="col-lg-8">
		                    <p class="form-control-static">
		                    	<?php
		                    	if(($single->from_id == $session->id && $single->from_status == 'R') || $single->to_id == $session->id && $single->to_status == 'R') {
	                    			echo $this->lang->line('challenge_you');
		                    	} else if(($single->from_id == $session->id && $single->to_status == 'R')|| ($single->to_id == $session->id && $single->from_status == 'R')) {
		                    		echo $this->lang->line('challenge_opponent');
		                    	}
		                    	?>
		                    </p>
		                </div>
		            </div>
	            <?php } ?>

	            <?php if($show_accept_button || $show_reject_button || $show_result_button) { ?>
		            <div class="form-group">
		            	<label class="col-lg-2 control-label">&nbsp;</label>
		                <div class="col-lg-8">
		                	<?php if($show_accept_button){ ?>
		                    	<button type="submit" name="action" value="A" class="btn btn-success btn-perspective"><?php echo $this->lang->line('duel_accept'); ?></button>
		                    <?php } ?>
		                    <?php if($show_reject_button){ ?>
		                    	<button type="submit" name="action" value="R" class="btn btn-danger btn-perspective"><?php echo $this->lang->line('duel_reject'); ?></button>
		                    <?php } ?>
		                    <?php if($show_result_button){ ?>
		                    	<a href="<?php echo base_url().'duels/declare_result_box/'. $single->id; ?>" data-target="#duel_declare_result" data-toggle="modal" data-original-title="<?php echo $this->lang->line('duel_result'); ?>" data-challenge_id="<?php echo $single->id; ?>" class="btn btn-warning btn-perspective"><?php echo $this->lang->line('duel_result'); ?></a>
		                    <?php } ?>
		                </div>
		            </div>
	            <?php } ?>
            </form>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="panel panel-warning panel-square panel-no-border">
	        <div class="panel-heading">
            	<span class="bolded"><a class="text-white padding-killer" href="<?php echo base_url() . 'profile/view/' . $challenge_user->id; ?>"><?php echo $challenge_user->firstname .' ' . $challenge_user->lastname; ?></a></span>
	        </div>

	        <div class="the-box no-border full card-info">
            	<div class="the-box no-border text-center no-margin">
	                <img src="<?php echo IMG_URL . 'user_avtar/70X70/' . $challenge_user->avtar; ?>" class="social-avatar has-margin has-light-shadow img-circle" alt="Avatar">
	                <p class="text-info"><?php echo @$challenge_user_batch_detail->{$session->language.'_name'}; ?></p>
	                <p class="text-muted bordered"><?php echo @$challenge_user_ac_sc_clan_name; ?></p>

	                <?php if(!is_null($challenge_user->quote) && !empty($challenge_user->quote)) { ?>
	                    <p class="text-muted">
	                        "<?php echo $challenge_user->quote; ?>"
	                    </p>
	                <?php } ?>

                 	<?php if(!is_null($batch_image)) { ?>
	                    <p class="social-icon">
	                        <?php foreach ($batch_image as $image) { ?>
	                            <img src="<?php echo $image['image']; ?>" width="40" height="40" alt="<?php echo $image['name']; ?>" data-toggle="tooltip" data-original-title="<?php echo $image['name']; ?>">
	                        <?php } ?>
	                    </p>
	                <?php } ?>
	            </div>
	            <button class="btn btn-warning btn-block btn-lg btn-square">Score : <?php echo $challenge_userdetail->total_score; ?></button>
	        </div>
	    </div>
	</div>
</div>

<div class="modal fade" id="duel_declare_result" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow modal-no-border">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $this->lang->line('result_of_fight'); ?></h4>
			</div>
			<form id="duel_result" method="post" class="form-horizontal" action="<?php echo  base_url(). "duels/declare_result"; ?>">
				<input type="hidden" name="id" value="0">
				<div class="modal-body padding-bottom-killer">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-inverse" data-dismiss="modal"><?php echo $this->lang->line('cancel');?></button>
					<button type="submit" class="btn btn-success"><?php echo $this->lang->line('save');?></button>
				</div>
			</form>
		</div>
	</div>
</div>