<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
        $('#score_type').change(function(){
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
                {"sClass":""},{"sClass":""},{"sClass":"text-center"},{"sClass":""},{"sClass":"",},
                {"sClass": "text-center","bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . 'user_student/score_history/get_json_score_history/'. $user->id .'/'; ?>" + $('#score_type').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }

    function deleteRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Histroy',
            'message': 'Do you Want to Delete the Histroy ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'user_student/score_history/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                window.location.reload();
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
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('score_history'); ?> : <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></a></h1>    
    </div>
</div>

<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control" name="score_type" id="score_type">
                    <option value="all"><?php echo $this->lang->line('all'); ?></option>    
                    <option value="xpr"><?php echo $this->lang->line('xpr'); ?></option>
                    <option value="war"><?php echo $this->lang->line('war'); ?></option>
                    <option value="sty"><?php echo $this->lang->line('sty'); ?></option>
                </select>
            </div>

            <div class="col-lg-8 text-right">
                <p>
                    <?php echo $this->lang->line('type'); ?>: 
                    <span class="label label-info"><?php echo $this->lang->line('xpr'); ?></span>
                    <span class="label label-warning"><?php echo $this->lang->line('war'); ?></span>
                    <span class="label label-default"><?php echo $this->lang->line('sty'); ?></span>
                    &nbsp;&nbsp;
                    <?php echo $this->lang->line('score'); ?> : 
                    <span class="label label-success"><?php echo $this->lang->line('merit'); ?></span>
                    <span class="label label-danger"><?php echo $this->lang->line('demerit'); ?></span>
                </p>
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
                    <th width="75"><?php echo $this->lang->line('type'); ?></th>
                    <th width="100"><?php echo $this->lang->line('score'); ?></th>
                    <th width="125"><?php echo $this->lang->line('assign_date'); ?></th>
                    <th width="175"><?php echo $this->lang->line('assign_by'); ?></th>
                    <th><?php echo $this->lang->line('description'); ?></th>
                    <th width="50"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <td colspan="6"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
            </tbody>
        </table>
    </div>
</div>