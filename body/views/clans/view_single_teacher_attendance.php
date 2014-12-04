<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
             "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
            echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aaSorting": [[ 0, "desc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'clan/view_single_teacher_attendance_json/' . $teacher_id; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }
</script>
<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading h1"><?php echo $this->lang->line('view'), ' ',  $this->lang->line('view_teacher_attendance'); ?></h1>    


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo ucwords($this->lang->line('date')); ?></th>
                    <th width="100"><?php echo $this->lang->line('type')?></th>
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