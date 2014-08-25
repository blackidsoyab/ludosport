<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$('#step_2').hide();
	$('#step_3').hide();
	$('#step_4').hide();

	$('#recover-absence-btn').click(function(){
		$('#step_2').show();
		$('#confirm-absence-btn').hide();
		$('#recover-absence-btn').hide();
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
					$("#step_4").show();
				});
			},
			error: function(XMLHttpRequest, textStatus, errorThrown)
			{
				alert('error');
			}
		});
	});

	$('#recover-clan-btn').click(function(e) {
            e.preventDefault(); // prevent the link's default behaviour
            $('#student_mark_absence').submit(); // trigget the submit handler
        });


	$('#confirm-absence-btn').click(function(e) {
        e.preventDefault(); // prevent the link's default behaviour
        $("input[name='clan_id']").prop('disabled', true);
        $("input[name='date']").prop('disabled', true);
        $('#student_mark_absence').submit(); // trigget the submit handler
    });
});
//]]>
</script>

<div class="row">
	<div class="col-lg-6 col-xs-6">
		<h1 class="page-heading h1">Absence Managment</h1>
	</div>
</div>

<?php if(!empty($next_clans_dates)){ ?>
<form id="student_mark_absence" action="<?php echo base_url().'student_mark_absence'; ?>" method="post">
	<div class="panel panel-primary" id="step_1">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-calendar"></i> Select date of Absence</h3>
		</div>

		<div class="panel-body">
			<?php foreach ($next_clans_dates as $date) { ?>
			<div class="radio pull-left no-margin">
				<label>
					<input type="radio" value="<?php echo $date;?>" class="i-grey-square" name="absence_date">
					<?php echo $date; ?>
				</label>
			</div> 
			<?php } ?>
		</div>

		<div class="panel-footer">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-right">
					<a class="btn btn-primary" id="recover-absence-btn">Recover Absence</a>
					<a class="btn btn-primary" id="confirm-absence-btn">Confirm Absence</a>					
				</div>
			</div>
			
		</div>
	</div>
	<?php if (isset($clans) && is_object($clans)) { ?>
	<div class="panel panel-primary" id="step_2">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-university"></i> Select Clan</h3>
		</div>

		<div class="panel-body ludosport-class">
			<?php foreach ($clans as $clan) { ?>
			<div class="col-lg-4 col-xs-4 clan">
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
			<h3 class="panel-title"><i class="fa fa-calendar"></i> Select Date for Recover</h3>
		</div>

		<div class="panel-body ludosport-class-date" id="clan_dates">
		</div>
	</div>

	<div id="step_4">
		<div class="text-center">
			<a class="btn btn-primary" id="recover-clan-btn">Confirm Absence</a>
			<a class="btn btn-primary" id="cancel-recover-btn">Cancel</a>
		</div>
	</div>
	<?php } else if(isset($clans)) { ?>
	<div class="col-lg-12">
		<div class="alert alert-<?php echo $type;?> fade in alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<p class="text-center">
				<?php echo $clans; ?>
			</p>
		</div>
	</div>    
	<?php } ?>
</form>
<?php } ?>