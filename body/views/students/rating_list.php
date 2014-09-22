<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();
        
        $('.dataTables_filter').find('input').attr('placeholder', 'Search Pupil');

        $('#list_type').change(function(){
            loadDatable();
        });

        $('button[data-toggle~="modal"]').on('click', function(e) {
			var target_modal = $(e.currentTarget).data('target');
			var modal = $(target_modal);
			modal.on('show.bs.modal', function () {
				$("input[name='to_id']").val($(e.currentTarget).data('userid'));
				$('.form-group').show();
		    	$('.animation_image').hide();
		    	$('#time_error').hide();
        		$('#date_error').hide();
			}).modal({
				backdrop: 'static',
				keyboard: false
			});
			return false;
		});

		$('#do_duel_box').on('shown.bs.modal', function(){
			if ($('.timepicker').length > 0){
	            $('.timepicker').timepicker({
	                minuteStep: 5,
	                showInputs: false,
	                showMeridian : false,
	                defaultTime :false,
	            });
	        }

			if ($('.datepicker').length > 0){
		        $('.datepicker').datepicker({
		            format: "dd-mm-yyyy",
		            startDate: "<?php echo date('d-m-Y', strtotime('+2 day',  strtotime(get_current_date_time()->get_date_for_db()))); ?>",
		            startView: 2,
		            autoclose: true,
		            todayHighlight: true
		        }).on('changeDate', function (ev) {
		            $(this).datepicker('hide');
		        });
	    	}

	        $('#duel_date_time').submit(function(e) {
	        	if($("input[name='date']").val() != '' && $("input[name='time']").val() == ''){
	        		$('#time_error').show();
	        		$('#date_error').hide();
	        		$('.animation_image').hide();
	        		$('.message').hide();
	        	} else if($("input[name='date']").val() == '' && $("input[name='time']").val() != ''){
	        		$('#time_error').hide();
	        		$('#date_error').show();
	        		$('.animation_image').hide();
	        		$('.message').hide();
	        	} else{
	        		$('#time_error').hide();
	        		$('#date_error').hide();
	        		$('.animation_image').show();
	        		$('.form-group').hide();
	        		$('.message').hide();
	        		var post_data = {
						'from_id' : $("input[name='from_id']").val(),
						'to_id' : $("input[name='to_id']").val(),
						'date' : $("input[name='date']").val(),
						'time' : $("input[name='time']").val(),
						'place' : $("input[name='place]").val(),
					};
					$.ajax({
						type: "POST",
						url: '<?php echo  base_url(). "duels/do_it"; ?>',
						data: post_data,
						dataType : 'JSON',
						success: function(data) {
							if(data.status == true){
								$('.form-group').hide();
								$('.animation_image').hide();
								$('#time_error').hide();
    							$('#date_error').hide();
								$('.message').show();
							}
							setTimeout(function() {
	                        	$('#do_duel_box').modal('hide');
	                    	}, 2500);
						}	
					});
	        	}
				e.preventDefault();
			});
		});

		$('#do_duel_box').on('hidden.bs.modal', function(){
		    $('.form-group').show();
		    $('.animation_image').hide();
		    $('#time_error').hide();
    		$('#date_error').hide();
    		$('.message').hide();
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
            "bSort" : false,
            "aoColumns": [
                {"bSortable": false, "sClass": "vetrical-middle"},
                {"sClass": "vetrical-middle text-center"},
                {"bSortable": false, "sClass": "vetrical-middle"},
                {"bSortable": false, "sClass": "vetrical-middle"},
                {"bSortable": false, "sClass": "vetrical-middle"},
                {"bSortable": false, "sClass": "vetrical-middle text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'student/rating_list_json/'; ?>" + $('#list_type').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }  
        });
    }
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('rating_list'); ?></h1>
<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control" name="list_type" id="list_type">
                    <option value="all"><?php echo $this->lang->line('all'); ?></option>    
                    <option value="xpr"  <?php echo (isset($type) && !is_null($type) && $type == 'xp') ? 'selected' : ''; ?>><?php echo $this->lang->line('xpr'); ?></option>
                    <option value="war"  <?php echo (isset($type) && !is_null($type) && $type == 'war') ? 'selected' : ''; ?>><?php echo $this->lang->line('war'); ?></option>
                    <option value="sty"  <?php echo (isset($type) && !is_null($type) && $type == 'sty') ? 'selected' : ''; ?>><?php echo $this->lang->line('sty'); ?></option>
                </select>
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
					<th><?php echo $this->lang->line('name'); ?></th>
					<th width="10%"><?php echo $this->lang->line('score'); ?></th>
					<th width="15%"><?php echo $this->lang->line('academy'); ?></th>
					<th width="15%"><?php echo $this->lang->line('school'); ?></th>
					<th width="15%"><?php echo $this->lang->line('clan'); ?></th>
					<th width="10%"><?php echo $this->lang->line('challenge'); ?></th>
				</tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6"><i><?php echo $this->lang->line('loaing'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="do_duel_box" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-no-shadow modal-no-border bg-danger">
			<div class="modal-header">
				<h4 class="modal-title text-white padding-killer"><?php echo $this->lang->line('prepare_to_fight'); ?></h4>
			</div>
			<form id="duel_date_time" method="post" class="form-horizontal" action="<?php echo  base_url(). "duels/do_it"; ?>">
				<input type="hidden" name="from_id" value="<?php echo $session->id; ?>">
				<input type="hidden" name="to_id" value="0">
				<div class="modal-body padding-bottom-killer">
					<div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('date')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control datepicker" name="date" placeholder="Date" readonly="readonly">
		                </div>
		            </div>
	            	<div class="form-group" id="date_error" style="display:none">
		                <label class="col-lg-3 control-label">&nbsp;</label>
		                <div class="col-lg-5">
		                    <label for="date" class="error text-white padding-killer"><?php echo $this->lang->line('date_required'); ?></label>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('time')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control timepicker" name="time" placeholder="Time" readonly="readonly">
		                </div>
		            </div>
		            <div class="form-group" id="time_error" style="display:none">
		                <label class="col-lg-3 control-label">&nbsp;</label>
		                <div class="col-lg-5">
		                    <label for="date" class="error text-white padding-killer"><?php echo $this->lang->line('time_required'); ?></label>
		                </div>
		            </div>
		            <div class="form-group">
		                <label class="col-lg-3 control-label">
		                	<?php echo ucwords($this->lang->line('place')); ?>
		                </label>
		                <div class="col-lg-5">
		                    <input type="text" class="form-control required" name="place" placeholder="Place">
		                </div>
		            </div>
		            <div class="alert alert-success message" style="display:none;">
		            	<?php echo $this->lang->line('challenge_success_message'); ?>
		            </div>
		            <div class="animation_image" style="display:none" align="center">
                    	<i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
                	</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('just_kidding'); ?></button>
					<button type="submit" class="btn btn-danger"><?php echo $this->lang->line('do_it'); ?></button>
				</div>
			</form>
		</div>
	</div>
</div>