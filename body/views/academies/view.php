<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"bSortable": false, "sClass": "text-center"},{"bSortable": false, "sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "academy/getjson"; ?>"
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Academy',
            'message': 'Do you Want to Delete the Academy ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'academy/delete/' + current_id,
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
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('academy'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('academies', 'addAcademy')) { ?>
            <a href="<?php echo base_url() . 'academy/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?></a>
        <?php } ?>
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('academy'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('rector'), ' ', $this->lang->line('name'); ?></th>
                    <th width="125"><?php echo $this->lang->line('city'); ?></th>
                    <th width="100"><?php echo $this->lang->line('total'), ' ', $this->lang->line('school') . 's'; ?></th>
                    <th width="110"><?php echo $this->lang->line('total'), ' ', $this->lang->line('student') . 's'; ?></th>
                    <th width="100"><?php echo $this->lang->line('paid'); ?></th>
                    <th width="100"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7"><i>Loading...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>