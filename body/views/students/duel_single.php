<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo 'Challenge : ' . $type;; ?></h1>
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
	                    <p class="form-control-static"><a href="<?php echo base_url() .'profile/single/' .$challenge_user->id ; ?>"><?php echo $challenge_user->firstname .' ' . $challenge_user->lastname; ?></a></p>
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

	            <div class="form-group">
	                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('date')), ' : '; ?></label>
	                <div class="col-lg-8">
	                    <p class="form-control-static"><?php echo date('j<\s\u\p>S</\s\u\p> F Y', strtotime($single->played_on)) ?></p>
	                </div>
	            </div>

	            <div class="form-group">
	                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('time')), ' : '; ?></label>
	                <div class="col-lg-8">
	                    <p class="form-control-static"><?php echo date('H:i A', strtotime($single->played_on)) ?></p>
	                </div>
	            </div>

	            <?php if(!is_null($single->place)) { ?>
	            	<div class="form-group">
		                <label class="col-lg-2 control-label"><?php echo ucwords($this->lang->line('place')), ' : '; ?></label>
		                <div class="col-lg-8">
		                    <p class="form-control-static"><?php echo @$single->place; ?></p>
		                </div>
		            </div>
	            <?php } ?>

	            <?php if($show_accept_button || $show_reject_button) { ?>
		            <div class="form-group">
		            	<label class="col-lg-2 control-label">&nbsp;</label>
		                <div class="col-lg-8">
		                	<?php if($show_accept_button){ ?>
		                    	<button type="submit" name="action" value="A" class="btn btn-success btn-perspective"><?php echo $this->lang->line('duel_accept'); ?></button>
		                    <?php } ?>
		                    <?php if($show_reject_button){ ?>
		                    	<button type="submit" name="action" value="R" class="btn btn-danger btn-perspective"><?php echo $this->lang->line('duel_reject'); ?></button>
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
	                <p class="text-muted bordered">Gegio: <?php echo @$challenge_user_ac_sc_clan_name; ?></p>

	                <?php if(!is_null($challenge_user->quote) && !empty($challenge_user->quote)) { ?>
	                    <p class="text-muted">
	                        "<?php echo $challenge_user->quote; ?>"
	                    </p>
	                <?php } ?>

	                <?php if(!is_null($challenge_user_batch_image)) { ?>
	                    <p class="social-icon">
	                        <img src="<?php echo $challenge_user_batch_image; ?>" width="40" height="40" alt="<?php echo $challenge_user_batch_detail->{$session->language.'_name'}; ?>" data-toggle="tooltip" data-original-title="<?php echo $challenge_user_batch_detail->{$session->language.'_name'}; ?>">
	                    </p>
	                <?php } ?>
	            </div>
	            <button class="btn btn-warning btn-block btn-lg btn-square">Score : <?php echo $challenge_userdetail->total_score; ?></button>
	        </div>
	    </div>
	</div>
</div>