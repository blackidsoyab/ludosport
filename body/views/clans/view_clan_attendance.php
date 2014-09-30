<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
            "bPaginate": false,
            "bLengthChange": false,
            "bServerSide" : true,
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'clan/view_clan_attendance_json/' . $clan_id; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }
</script>
<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading h1"><?php echo $this->lang->line('view'), ' ', $this->lang->line('clan'), ' ', $this->lang->line('view_attendance'); ?></h1>    


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('student'), ' ', $this->lang->line('name'); ?></th>
                    <th width="100"><?php echo $this->lang->line('presence')?></th>
                    <th width="100"><?php echo $this->lang->line('absence')?></th>
                    <th width="100"><?php echo $this->lang->line('recovery')?></th>
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