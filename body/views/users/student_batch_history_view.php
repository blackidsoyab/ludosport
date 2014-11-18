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
            "aaSorting": [[ 2, "desc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-right","bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . 'user_student/badge_history/get_json_batch_history/'. $user->id .'/'; ?>" + $('#batch_type').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }

    function deleteRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage User',
            'message': 'Do you Want to Delete the Badge ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'user_student/badge_history/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                loadDatable();
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
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-heading h1 pull-left"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('batch_history'); ?> : <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></a></h1>        

        <?php if (hasPermission('users', 'addStudentBatches')) { ?>
            <a href="<?php echo base_url() . 'user_student/badge_history/add/'. $user->id ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('batch_history'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch_history'); ?></a>
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
                    <option value="H"><?php echo $this->lang->line('honour'); ?></option>
                    <option value="Q"><?php echo $this->lang->line('qualification'); ?></option>
                    <option value="S"><?php echo $this->lang->line('security'); ?></option> 
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
                    <th width="150"><?php echo $this->lang->line('type'); ?></th>
                    <th width="100"><?php echo $this->lang->line('assign_date'); ?></th>
                    <th width="100"><?php echo $this->lang->line('assign_by'); ?></th>
                    <th width="150"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <td colspan="5"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
            </tbody>
        </table>
    </div>
</div>