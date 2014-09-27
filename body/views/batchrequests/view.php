<script src="<?php echo JS_URL; ?>jquery-ui.js"></script>
<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
           "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length')); echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": "vetrical-middle"},
                {"sClass": "vetrical-middle"},
                {"sClass": "vetrical-middle"},
                {"sClass": "vetrical-middle"},
                {"bSortable": false, "sClass": "vetrical-middle text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'batchrequest/getjson'; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Batch Request',
            'message': 'Do you Want to Delete the Batch Request?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'batchrequest/delete/' + current_id,
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
                '<?php echo $this->lang->line("no"); ?>': {
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
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('batch_request'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('batchrequests', 'addBatchrequest')) { ?>
            <a href="<?php echo base_url() . 'batchrequest/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('batch_request'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch_request'); ?></a>
        <?php } ?>
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('request_student_name'); ?></th>
                    <th width="150"><?php echo $this->lang->line('batch_request'); ?></th>
                    <th width="150"><?php echo $this->lang->line('request_user_name'); ?></th>
                    <th width="150"><?php echo $this->lang->line('clan'); ?></th>
                    <th width="150"><?php echo $this->lang->line('actions'); ?></th>
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