<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"bSortable": false, "sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "level/getjson"; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Level',
            'message': 'Do you Want to Delete the Level ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'level/delete/' + current_id,
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
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('level'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('levels', 'addLevel')) { ?>
            <a href="<?php echo base_url() . 'level/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('level'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('level'); ?></a>
        <?php } ?>
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('level'), ' ', $this->lang->line('name'); ?></th>
                    <th width="125"><?php echo $this->lang->line('level'), ' ', $this->lang->line('is_basic'); ?></th>
                    <th width="125"><?php echo $this->lang->line('level'), ' ', $this->lang->line('under_sixteen'); ?></th>
                    <th width="125"><?php echo $this->lang->line('actions'); ?></th>
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