<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading"><?php echo $this->lang->line('challenge_history'), (is_null($type)) ? '' : ' : ' . $type ; ?></h1>

<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();

        $('#type-wise-2').hide();
        $('#type-wise').change(function(){
        	if($('#type-wise').val() == 'all'){
        		$('.page-heading').html("<?php echo $this->lang->line('challenge_history'); ?>");
        	}else{
        		$('.page-heading').html("<?php echo $this->lang->line('challenge_history') .' : '; ?>" + $('#type-wise').val());
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
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <select class="form-control required" id="type-wise">
		            <option value="all"><?php echo $this->lang->line('all'); ?></option>
		            <option value="accepted" <?php echo (isset($type) && !is_null($type) && $type == 'accepted') ? 'selected' : ''; ?>><?php echo $this->lang->line('accepted'); ?></option>
		            <option value="received" <?php echo (isset($type) && !is_null($type) && $type == 'received') ? 'selected' : ''; ?>><?php echo $this->lang->line('received'); ?></option>
		            <option value="submitted" <?php echo (isset($type) && !is_null($type) && $type == 'submitted') ? 'selected' : ''; ?>><?php echo $this->lang->line('submitted'); ?></option>
		            <option value="pending" <?php echo (isset($type) && !is_null($type) && $type == 'pending') ? 'selected' : ''; ?>><?php echo $this->lang->line('pending'); ?></option>
                    <option value="faliure" <?php echo (isset($type) && !is_null($type) && $type == 'faliure') ? 'selected' : ''; ?>><?php echo $this->lang->line('faliure'); ?></option>
		            <option value="wins" <?php echo (isset($type) && !is_null($type) && $type == 'wins') ? 'selected' : ''; ?>><?php echo $this->lang->line('wins'); ?></option>
		            <option value="defeats" <?php echo (isset($type) && !is_null($type) && $type == 'defeats') ? 'selected' : ''; ?>><?php echo $this->lang->line('defeats'); ?></option>
		        </select>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                <select class="form-control required" id="type-wise-2">
		            <option value="null"><?php echo $this->lang->line('all'); ?></option>
		            <option value="P"><?php echo $this->lang->line('pending'); ?></option>
		            <option value="A"><?php echo $this->lang->line('accepted'); ?></option>
		            <option value="R"><?php echo $this->lang->line('rejected'); ?></option>
		        </select>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right">
            	<p>
            		<span class="label label-default"><?php echo $this->lang->line('challenge_made'); ?></span>
            		<span class="label label-info"><?php echo $this->lang->line('challenge_received'); ?></span>
            	</p>
            	<p>
            		<span class="label label-warning"><?php echo $this->lang->line('pending'); ?></span>
            		<span class="label label-success"><?php echo $this->lang->line('accepted'); ?></span>
            		<span class="label label-danger"><?php echo $this->lang->line('rejected'); ?></span>
            	</p>
            </div> 
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        &nbsp;
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('full_name'); ?></th>
					<th width="125"><?php echo $this->lang->line('score'); ?></th>
					<th width="125"><?php echo $this->lang->line('status'); ?></th>
					<th width="175"><?php echo $this->lang->line('time'); ?></th>
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