<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"bSortable": false, "sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "city/getjson"; ?>"
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage City',
            'message': 'Do you Want to Delete the City ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'city/delete/' + current_id,
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
    <div class="col-md-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('city'); ?></h1>    
    </div>

    <div class="col-md-6">
        <?php if (hasPermission('cities', 'addCity')) { ?>
            <a href="<?php echo base_url() . 'city/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('city'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('city'); ?></a>
        <?php } ?>

    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('city'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('state'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('country'), ' ', $this->lang->line('name'); ?></th>
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