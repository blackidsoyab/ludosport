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
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": ""}
            ],
            "sAjaxSource": "<?php echo base_url() . 'clan/view_attendance_json'; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }
</script>
<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading h1"><?php echo $this->lang->line('view'), ' ', $this->lang->line('view_attendance'); ?></h1>    


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('total'), ' ', $this->lang->line('student'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="2"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>