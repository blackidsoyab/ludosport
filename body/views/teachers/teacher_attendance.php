<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$('#step_2').hide();
	$('#step_3').hide();
	$('#step_4').hide();
	$('#date-error-teacher').hide();
	$('#date-error').hide();
	
	 $(".absence-radio-btn label").click(function(){
	 	$('#date-error').hide();
	});

	$('#cancel-replace-btn').click(function(){
		$('#step_3').hide();
		$('#step_4').hide();
		$('#replace-teacher-btn').closest('.panel-footer').show();
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
				$("#step_2").show();
				$('#clan_dates').empty();
				$('#clan_dates').html(data);
				PositionFooter();
				$(".ludosport-class-date :radio").hide().click(function(e){
					e.stopPropagation();
				});

				$(".ludosport-class-date div.clan-date").click(function(e){
					$(this).closest(".ludosport-class-date").find("div.the-box").removeClass("bg-primary");
					$(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
					$('#date-error').hide();
				});
			}
		});

		$.ajax({
			type: 'GET',
			url: '<?php echo base_url(); ?>teacher/school_related_teacher/' + val,
			success: function(teachers_list_data)
			{
				$('#teachers_list').empty();
				$('#teachers_list').html(teachers_list_data);

				$(".ludosport-teacher-id :radio").hide().click(function(e){
					e.stopPropagation();
				});
			}
		});
	});

	$('#replace-teacher-btn').click(function(e) {
		e.preventDefault();
		$('#step_3').show();
		$('#step_4').show();
		$('#replace-teacher-btn').closest('.panel-footer').hide();
    });

	$('#recover-teacher-btn').click(function(e) {
		e.preventDefault();
		if($("#step_2 #clan_dates").find('.clan-date').find('.bg-primary').length == 0){
			$('#date-error').show();
		}if($("#step_3 #teachers_list").find('.clan-date').find('.bg-primary').length == 0){
			$('#date-error-teacher').show();
		} else{
			$('input[name="action"]').val('recover-teacher');
			$('#teacher_mark_absence').submit();
		}
    });


	$('#confirm-absence-btn').click(function(e) {
		e.preventDefault();
		if($("#step_2 #clan_dates").find('.clan-date').find('.bg-primary').length == 0){
			$('#date-error').show();
		}else{
			$('input[name="teacher_id"]').prop('disabled', true);
			$('#teacher_mark_absence').submit();
		}
    });
});
//]]>
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('communicate_absence'); ?></h1>

<?php if(!empty($clans)){ ?>
<form id="teacher_mark_absence" action="<?php echo base_url().'teacher_mark_absence'; ?>" method="post">
	<input type="hidden" name="action" value="confirm_absence">
	<div class="panel panel-primary" id="step_1">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('select_clan'); ?></h3>
		</div>

		<div class="panel-body">
			<div class="panel-body ludosport-class">
				<?php foreach ($clans as $clan) { ?>
				<div class="col-lg-2 col-xs-4 clan">
					<div class="the-box rounded text-center padding-killer margin-bottom-killer" data-clan="<?php echo $clan->id; ?>">
						<input type="radio" value="<?php echo $clan->id; ?>" name="clan_id" />
						<h4 class="light"><?php echo $clan->{$session->language . '_class_name'}; ?></h4>
					</div>
				</div> 
				<?php } ?>
			</div>

			<div class="form-group" id="from_message">
				<label class="control-label"><?php echo $this->lang->line('reason'); ?> : </label>
				<textarea name="from_message" class="form-control bold-border required"></textarea>
			</div>
		</div>
	</div>

	<div class="panel panel-primary" id="step_2">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> <?php echo $this->lang->line('select_date'); ?></h3>
		</div>

		<div class="panel-body ludosport-class-date" id="clan_dates">
		</div>

		<div class="row" id="date-error">
			<div class="col-lg-12">
				<small class="help-block text-danger"><?php echo $this->lang->line('select_date'); ?></small>
			</div>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-right">
					<a class="btn btn-primary" id="replace-teacher-btn"><?php echo $this->lang->line('replace_teacher'); ?></a>
					<a class="btn btn-primary" id="confirm-absence-btn"><?php echo $this->lang->line('confirm_absence'); ?></a>					
				</div>
			</div>
		</div>
	</div>

	<div class="panel panel-primary" id="step_3">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-user"></i> <?php echo $this->lang->line('select_teacher'); ?></h3>
		</div>

		<div class="panel-body ludosport-class-date" id="teachers_list">
		</div>

		<div class="row" id="date-error-teacher">
			<div class="col-lg-12">
				<small class="help-block text-danger"><?php echo $this->lang->line('select_teacher'); ?></small>
			</div>
		</div>
	</div>

	<div id="step_4">
		<div class="text-center">
			<a class="btn btn-primary" id="recover-teacher-btn"><?php echo $this->lang->line('confirm_absence'); ?></a>
			<a class="btn btn-primary" id="cancel-replace-btn"><?php echo $this->lang->line('cancel'); ?></a>
		</div>
	</div>
</form>
<?php } ?>