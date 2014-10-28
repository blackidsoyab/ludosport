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
		"bFilter" : false,
		"aoColumns": [
			{"sClass": ""},{"sClass": "text-center"},{"sClass": ""},{"sClass": "text-center"}
		],
		"sAjaxSource": "<?php echo base_url() . 'event/get_event_invited_json'; ?>",
		"fnInitComplete": function (oSettings, json) {
			PositionFooter();     
		}
	});
});
//]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('view') ,' ', $this->lang->line('event_inivted'); ?></h1>

<div class="the-box">
	<div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th width="20%"><?php echo $this->lang->line('event'); ?></th>
                    <th width="15%"><?php echo ucfirst($this->lang->line('date')); ?></th>
                    <th><?php echo $this->lang->line('invitation_send_from_name'); ?></th>
                    <th width="10%"><?php echo $this->lang->line('total_invitation_send'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td colspan="4"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>