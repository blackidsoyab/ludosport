<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bSort": false,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""}, {"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . "permission/getJson"; ?>"
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Permissions',
            'message': 'Do you Want to Delete the Permission ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'permission/delete/' + current_id,
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
        <h1 class="page-heading h1">Manage Permissions</h1>    
    </div>

    <div class="col-md-6">
        <a href="<?php echo base_url() . 'permission/add' ?>" class="btn btn-primary h1 pull-right">Add New Permission</a>
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th>Permission</th>
                    <th>Controller</th>
                    <th>Method</th>
                    <th width="150">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>etc</td>
                    <td>etc</td>
                    <td>etc</td>
                    <td>etc</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>