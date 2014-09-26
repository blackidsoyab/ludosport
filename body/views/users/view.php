<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
        $('#assigned_users').prop('disabled', true);
        $('#role_id').change(function(){
            loadDatable();
            if($('#role_id').val() != 0){
                $('#assigned_users').prop('disabled', false);
            }
        });

        $('#assigned_users').change(function(){
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
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-center"},{"sClass": "text-right","bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . "user/getjson/"; ?>" + $('#role_id').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage User',
            'message': 'Do you Want to Delete the User ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'user/delete/' + current_id,
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
<?php $session = $this->session->userdata('user_session'); ?>
<div class="row">
    <div class="col-lg-6 col-xs-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('user'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('users', 'addUser')) { ?>
            <a href="<?php echo base_url() . 'user/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
<?php } ?>

    </div>
</div>

<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control" id="role_id">
                    <option value="0">Filter by Role</option>
                    <?php foreach ($roles as $role) { ?>
                        <option value="<?php echo $role->id; ?>" <?php echo (@$role_id == $role->id) ? 'selected' : ''; ?>><?php echo $role->{$session->language . '_role_name'}; ?></option>
<?php } ?>    
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
                    <th width="200"><?php echo $this->lang->line('nickname'); ?></th>
                    <th width="100"><?php echo $this->lang->line('role'); ?></th>
                    <th width="75"><?php echo $this->lang->line('status'); ?></th>
                    <th width="175"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <td colspan="5"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
            </tbody>
        </table>
    </div>
</div>