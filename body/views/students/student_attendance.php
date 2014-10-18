<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$('#step_2').hide();
	$('#step_3').hide();
	$('#step_4').hide();
	$('#date-error').hide();
	
	 $(".absence-radio-btn label").click(function(){
	 	$('#date-error').hide();
	});


	$('#recover-absence-btn').click(function(){
		if($("#step_1 .panel-body").find('.checked').length == 0){
			$('#date-error').show();
		}else{
			$('#step_2').show();
			$('#step_4').show();
			$('#recover-clan-btn').hide();
			$('#cancel-recover-btn').show();
			<?php if (isset($clans) && is_object($clans)) { ?>
				$('#confirm-absence-btn').hide();
				$('#recover-absence-btn').hide();
			<?php } ?>
		}
	});

	$('#cancel-recover-btn').click(function(){
		$('#step_2').hide();
		$('#step_3').hide();
		$('#step_4').hide();
		$('#recover-absence-btn').show();
		$('#confirm-absence-btn').show();
	});


	$(".ludosport-class :radio").hide().click(function(e){
		e.stopPropagation();
	});

	$(".ludosport-class div.clan").click(function(e){
		$(this).closest(".ludosport-class").find("div.the-box").removeClass("bg-primary");
		$(this).find("div.the-box").addClass("bg-primary").find(":radio").click();

		val = $(".ludosport-class div.clan").find("div.bg-primary").attr("data-clan");
		$.ajax({
			type: 'GET',
			url: '<?php echo base_url(); ?>getclandates/' + val,
			success: function(data)
			{
				$("#step_3").show();
				$('#clan_dates').empty();
				$('#clan_dates').html(data);

				$(".ludosport-class-date :radio").hide().click(function(e){
					e.stopPropagation();
				});

				$(".ludosport-class-date div.clan-date").click(function(e){
					$(this).closest(".ludosport-class-date").find("div.the-box").removeClass("bg-primary");
					$(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
					$('#recover-clan-btn').show();
				});
			}
		});
	});

	$('#recover-clan-btn').click(function(e) {
		e.preventDefault(); // prevent the link's default behaviour
		if($("#step_1 .panel-body").find('.checked').length == 0){
			$('#date-error').show();
		}else{
			$('#student_mark_absence').submit(); // trigget the submit handler
		}
    });


	$('#confirm-absence-btn').click(function(e) {
		e.preventDefault(); // prevent the link's default behaviour
		if($("#step_1 .panel-body").find('.checked').length == 0){
			$('#date-error').show();
		}else{
			$('input[name="clan_id"]').prop('disabled', true);
			$('input[name="date"]').prop('disabled', true);
			$('#student_mark_absence').submit(); // trigget the submit handler
		}
    });
});
//]]>
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('communicate_absence'); ?></h1>

<?php if(!empty($next_clans_dates)){ ?>
<form id="student_mark_absence" action="<?php echo base_url().'student_mark_absence'; ?>" method="post">
	<div class="panel panel-primary" id="step_1">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('select_date_of_absence'); ?></h3>
		</div>

		<div class="panel-body">
			<div class="row">
				<?php foreach ($next_clans_dates as $date) { ?>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 mar-bt-10">
					<div class="radio pull-left margin-killer padding-top-killer padding-left-killer absence-radio-btn">
						<label>
							<input type="radio" value="<?php echo $date;?>" class="i-grey-square" name="absence_date">
							<?php echo date('l, j<\s\u\p>S</\s\u\p> F Y', strtotime($date));?>
						</label>
					</div>
				</div>
				<?php } ?>
			</div>
			<div class="row" id="date-error">
				<div class="col-lg-12">
					<small class="help-block text-danger"><?php echo $this->lang->line('select_date'); ?></small>
				</div>
			</div>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 pull-right">
					<a class="btn btn-primary btn-block" id="confirm-absence-btn"><?php echo $this->lang->line('confirm_absence'); ?></a>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 pull-right">
					<a class="btn btn-primary btn-block" id="recover-absence-btn"><?php echo $this->lang->line('recover_absence'); ?></a>
				</div>
			</div>
		</div>
	</div>
	<?php if (isset($clans) && is_object($clans)) { ?>
	<div class="panel panel-primary" id="step_2">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-university"></i> <?php echo $this->lang->line('select_clan'); ?></h3>
		</div>

		<div class="panel-body ludosport-class">
			<?php foreach ($clans as $clan) { ?>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 clan">
				<div class="the-box rounded text-center" data-clan="<?php echo $clan->id; ?>">
					<input type="radio" value="<?php echo $clan->id; ?>" name="clan_id" />
					<h4 class="light"><?php echo $clan->{$session->language . '_class_name'}; ?></h4>
				</div>
			</div> 
			<?php } ?>
		</div>
	</div>

	<div class="panel panel-primary" id="step_3">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('select_date'); ?></h3>
		</div>

		<div class="panel-body ludosport-class-date" id="clan_dates">
		</div>
	</div>

	<div id="step_4">
		<div class="row">
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 pull-right">
				<a class="btn btn-primary btn-block" id="cancel-recover-btn"><?php echo $this->lang->line('cancel'); ?></a>
			</div>
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 pull-right">
				<a class="btn btn-primary btn-block" id="recover-clan-btn"><?php echo $this->lang->line('confirm_absence'); ?></a>
			</div>
		</div>
	</div>
	<?php } else if(isset($clans)) { ?>
	<div class="col-lg-12" id="step_2">
		<div class="alert alert-<?php echo $type;?> fade in alert-dismissable">
			<p class="text-center">
				<?php echo $clans; ?>
			</p>
		</div>
	</div>    
	<?php } ?>
</form>
<?php } ?>