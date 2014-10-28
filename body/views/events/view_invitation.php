<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$('#list_data').dataTable({
		"bProcessing": true,
		"aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
		'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
			echo $lengths[0]; ?>,
		"bServerSide" : true,
		"aaSorting": [[ 1, "ASC" ]],
		"bFilter" : false,
		"aoColumns": [
			{"sClass": ""},{"sClass": ""},{ "bSearchable": false, "sClass": "text-center"}
		],
		"sAjaxSource": "<?php echo base_url() . 'event/get_event_inivtation_json/' . $event_detail->id; ?>",
		"fnInitComplete": function (oSettings, json) {
			PositionFooter();     
		}
	});
});
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('view') ,' ', $this->lang->line('event'), ' ', $this->lang->line('invitation'); ?></h1>

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

	<div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('invitation_send_from_name'); ?></th>
                    <th width="20%"><?php echo $this->lang->line('invitation_send_to_name'); ?></th>
                    <th width="10%"><?php echo $this->lang->line('total_invitation_send'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td colspan="3"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>