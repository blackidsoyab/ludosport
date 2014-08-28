<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();
        
         $('#batch_type').change(function(){
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
            "aoColumns": [
                {"sClass": "vetrical-middle"},{"sClass": "vetrical-middle text-center"},{"bSortable": false, "sClass": "text-center"},{"bSortable": false, "sClass": "vetrical-middle text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "batch/getjson/"; ?>" + $('#batch_type').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }  
        });
    }

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Batch',
            'message': 'Do you Want to Delete the Batch ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'batch/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                window.location.reload();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('error');
                            }
                        });
                    }
                },
                'No': {
                    'class': 'btn btn-default',
                    'action': function() {
                    }	// Nothing to do in this case. You can as well omit the action property.
                }
            }
        });
        return false;
    }
</script>

<div class="row">
    <div class="col-lg-6 col-xs-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('batch'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('batches', 'addBatch')) { ?>
            <a href="<?php echo base_url() . 'batch/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('batch'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch'); ?></a>
        <?php } ?>
    </div>
</div>


<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control" name="batch_type" id="batch_type" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('batch'); ?>">
                    <option value="all"><?php echo $this->lang->line('all'), ' ', $this->lang->line('batch'); ?></option>    
                    <option value="D"><?php echo $this->lang->line('degrees'); ?></option>
                    <option value="H"><?php echo $this->lang->line('honors'); ?></option>
                    <option value="Q"><?php echo $this->lang->line('qualifications'); ?></option>
                    <option value="S"><?php echo $this->lang->line('securities'); ?></option> 
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
                    <th><?php echo $this->lang->line('batch'), ' ', $this->lang->line('name'); ?></th>
                    <th width="150"><?php echo $this->lang->line('type'); ?></th>
                    <th width="150"><?php echo $this->lang->line('image'); ?></th>
                    <th width="150"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4"><i>Loading...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>