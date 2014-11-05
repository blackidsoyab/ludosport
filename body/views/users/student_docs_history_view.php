<?php $session = $this->session->userdata('user_session'); ?>
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
            "sAjaxSource": "<?php echo base_url() . 'list_docs/json_data/' . $user->id; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    });

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Documents',
            'message': 'Do you Want to Delete the Document ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'user_student/delete_docs_history/' + current_id,
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
                    }   // Nothing to do in this case. You can as well omit the action property.
                }
            }
        });
        return false;
    }
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('list_docs'); ?> : <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></a></h1>

<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('student_file_name'); ?></th>
                    <th width="150"><?php echo ucwords($this->lang->line('student_file_valid_till')); ?></th>
                    <th width="125"><?php echo $this->lang->line('download'); ?></th>
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