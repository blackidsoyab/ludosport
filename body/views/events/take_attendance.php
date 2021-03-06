<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".clan-selection").change(function(){
	        var filter = 'clan-' + $(this).val();
	        var count = 0;
	        $(".event_attendance tr").each(function(){
	        	console.log($(this).hasClass(filter));
	            if ($(this).hasClass(filter) > 0) {
	                $(this).show();
	            } else {
	                $(this).fadeOut();
	            }
	        });
	        PositionFooter();
	    });
	});
</script>

<h1 class="page-heading">
	<?php echo $this->lang->line('event_take_attendance') ,' : '; ?>
 	<a href="<?php echo base_url() .'event/view/'. $event_detail->id;?>"><?php echo $event_detail->{$session->language.'_name'}; ?></a>
 </h1>

<?php if(!empty($event_students)){ ?>
	<div class="the-box full no-border">	
		<div class="table-responsive">
			<form class="form-horizontal" method="post" action="<?php echo base_url().'event/attendance/'.$event_detail->id; ?>">
				<table class="table">
					<thead>
						<tr class="bg-primary">
							<td style="width: 50px;"><?php echo $this->lang->line('no'); ?></td>
							<td style="width: 150px;"><?php echo $this->lang->line('full_name'); ?></td>
							<td style="width: 250px;"><?php echo date('l, j<\s\u\p>S</\s\u\p> F Y', strtotime(get_current_date_time()->get_date_for_db()));?></td>
							<td style="width: 150px;">
								<select class="form-control clan-selection">
									<option value="0">All</option>
									<?php foreach ($clans as $clan) { ?>
										<option value="<?php echo $clan->id?>"><?php echo $clan->{$session->language.'_class_name'}?></option>
									<?php } ?>
								</select>
							</td>
						</tr>
					</thead>
					<tbody class="event_attendance">
						<?php 
						$count = 0;
						$first_names = array_map(function($element){return strtolower($element['firstname']); }, $event_students);
						array_multisort($first_names, SORT_ASC, $event_students);
						foreach ($event_students as $value) { 
							$count++;
							?>
							<tr id="<?php echo 'user_id_', $value['id']; ?>" class="main_tr clan-0 clan-<?php echo @$value['clan_id']; ?> ">
								<td><?php echo $count; ?></td>
								<td><a href="<?php echo base_url() .'profile/view/' . $value['id']; ?>"><?php echo ucwords($value['firstname']), ' ', ucwords($value['lastname']); ?></a></td>
								<td colspan="2">
									<div class="row">
										<div class="col-md-12">
											<label class="radio-inline" for="p-radios-<?php echo $value['id']; ?>">
										      <input type="radio" id="p-radios-<?php echo $value['id']; ?>" value="1" class="radio i-grey-square" name="student[<?php echo $value['id']; ?>]" <?php echo (is_null($value['attendance'])) ? 'checked="checked"' : ($value['attendance'] == '1') ? 'checked="checked"' : ''; ?>/>
										      <?php echo $this->lang->line('present'); ?>
										    </label>
										    <label class="radio-inline" for="a-radios-<?php echo $value['id']; ?>">
										      <input type="radio" id="a-radios-<?php echo $value['id']; ?>" value="0" class="radio i-grey-square" name="student[<?php echo $value['id']; ?>]" <?php echo ($value['attendance'] == '0') ? 'checked="checked"' : ''; ?>/>
										      <?php echo $this->lang->line('absent'); ?>
										    </label>
										</div> 
									</div> 
								</td>
							</tr>
							<?php } ?>
						</tbody>
						<tfoot>
							<?php if($show_save_button){ ?>
								<tr>
									<td colspan="5">
										<button type="submit" class="btn btn-primary">
											<?php echo $this->lang->line('save'); ?>
										</button>
									</td>
								</tr>
							<?php } ?>	
						</tfoot>
					</table>
				</form>
			</div>
	</div>
<?php } ?>