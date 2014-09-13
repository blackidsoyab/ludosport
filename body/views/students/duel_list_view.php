<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading"><?php echo 'Challenge history', (is_null($type)) ? '' : ' : ' . $type ; ?></h1>

<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();

        $('#type-wise-2').hide();
        $('#type-wise').change(function(){
        	if($('#type-wise').val() == 'all'){
        		$('.page-heading').html('Challenge history');
        	}else{
        		$('.page-heading').html('Challenge history : ' + $('#type-wise').val());
        	}
        	
            loadDatable();
            if($('#type-wise').val() == 'made' || $('#type-wise').val() == 'received') {
				$('#type-wise-2').show();
            }else{
            	$('#type-wise-2').hide();
            }
        });

        $('#type-wise-2').change(function(){
            loadDatable();
        });
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
									echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"sClass": "text-center"},{"sClass": "text-center", "bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . 'duels/json_data/' .$session->id .'/'; ?>" + $('#type-wise').val() +'/'+ $('#type-wise-2').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }
</script>

<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class="col-lg-4">
                <select class="form-control required" id="type-wise">
		            <option value="all">All</option>
		            <option value="made" <?php echo (isset($type) && !is_null($type) && $type == 'made') ? 'selected' : ''; ?>>Made</option>
		            <option value="received" <?php echo (isset($type) && !is_null($type) && $type == 'received') ? 'selected' : ''; ?>>Received</option>
		            <option value="rejected" <?php echo (isset($type) && !is_null($type) && $type == 'rejected') ? 'selected' : ''; ?>>Rejected</option>
		            <option value="accepted" <?php echo (isset($type) && !is_null($type) && $type == 'accepted') ? 'selected' : ''; ?>>Accepted</option>
		            <option value="pending" <?php echo (isset($type) && !is_null($type) && $type == 'pending') ? 'selected' : ''; ?>>Pending</option>
		            <option value="wins" <?php echo (isset($type) && !is_null($type) && $type == 'wins') ? 'selected' : ''; ?>>Wins</option>
		            <option value="defetas" <?php echo (isset($type) && !is_null($type) && $type == 'defetas') ? 'selected' : ''; ?>>Defetas</option>
		        </select>
            </div>
            <div class="col-lg-4">
                <select class="form-control required" id="type-wise-2">
		            <option value="null">All</option>
		            <option value="P">Pending</option>
		            <option value="A">Accepted</option>
		            <option value="R">Rejected</option>
		            
		        </select>
            </div>

            <div class="col-lg-4 text-right">
            	<p>
            		<span class="label label-default">Challenge Made</span>
            		<span class="label label-info">Challenge Received</span>
            	</p>
            	<p>
            		<span class="label label-warning">Pending</span>
            		<span class="label label-success">Accepted</span>
            		<span class="label label-danger">Rejected</span>
            	</p>
            </div> 
        </div>
    </div>
    <div class="col-lg-12">
        &nbsp;
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('full_name'); ?></th>
					<th><?php echo $this->lang->line('score'); ?></th>
					<th><?php echo $this->lang->line('status'); ?></th>
					<th><?php echo $this->lang->line('time'); ?></th>
                    <th width="100"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>