<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
       
        $('#role_id').change(function(){
            loadDatable();
        });
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center","bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . "user/getjson/"; ?>" + $('#role_id').val()
        });
    }

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage User',
            'message': 'Do you Want to Delete the User ?',
            'buttons': {
                'Yes': {'class': 'btn btn-danger',
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
<div class="row">
    <div class="col-lg-4">
        <select class="form-control" id="role_id">
            <option value="0">Filter by Role</option>
            <?php foreach ($roles as $role) { ?>
                <option value="<?php echo $role->id; ?>" <?php echo (@$role_id == $role->id) ? 'selected' : ''; ?>><?php echo $role->{$session->language . '_role_name'}; ?></option>
            <?php } ?>    
        </select>
    </div>
</div>

<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('name'); ?></th>
                    <th width="200"><?php echo $this->lang->line('nickname'); ?></th>
                    <th width="125"><?php echo $this->lang->line('role'); ?></th>
                    <th width="100"><?php echo $this->lang->line('status'); ?></th>
                    <th width="100"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
            <td colspan="4"><i>Loading...</i></td>
            </tbody>
        </table>
    </div>
</div>