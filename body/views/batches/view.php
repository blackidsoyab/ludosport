<script src="<?php echo JS_URL; ?>jquery-ui.js"></script>
<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();
        
         $('#batch_type').change(function(){
            loadDatable();

            if($('#batch_type').val() != 'all'){
                $("#list_data tbody").sortable({ opacity: 0.6, cursor: 'move', update: function() {
                        var order = $(this).sortable("serialize");
                        var url = "<?php echo base_url() . 'batches/sortable'; ?>";
                        $.post(url, order, function(){
                            loadDatable();
                        });
                    }                             
                });
            }
        });
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
            "bServerSide" : true,
            "bPaginate": false,
            "bLengthChange": false,
            "aoColumns": [
                {"bSortable": false, "sClass": "vetrical-middle"},
                {"bSortable": false, "sClass": "vetrical-middle text-center"},
                {"bSortable": false, "sClass": "text-center"},
                {"bSortable": false, "sClass": "vetrical-middle text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "batch/getjson/"; ?>" + $('#batch_type').val(),
            "fnCreatedRow": function( nRow, aData, iDataIndex ) {
                $(nRow).attr('id', aData[4]);
            },
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
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
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
                <select class="form-control" name="batch_type" id="batch_type">
                    <option value="all"><?php echo $this->lang->line('all'); ?></option>
                    <option value="D"><?php echo $this->lang->line('degree'); ?></option>
                    <option value="H"><?php echo $this->lang->line('honor'); ?></option>
                    <option value="M"><?php echo $this->lang->line('master'); ?></option>
                    <option value="Q"><?php echo $this->lang->line('qualification'); ?></option>
                    <option value="S"><?php echo $this->lang->line('security'); ?></option> 
                </select>
            </div>

            <div class="col-lg-8">
                <p class="text-muted"><?php echo $this->lang->line('badge_change_sequence_information'); ?></p>
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
                    <td colspan="4"><i><?php echo $this->lang->line('loaing'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>