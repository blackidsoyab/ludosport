<!--
<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
            echo $lengths[0]; ?>,
            "aaSorting": [[ 2, "desc" ]],
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"bSortable": false, "sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'shop/json_data'; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    });

</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('payment'), ' ', $this->lang->line('history'); ?></h1>    

<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('description'); ?></th>
                    <th><?php echo $this->lang->line('amount'); ?></th>
                    <th><?php echo ucwords($this->lang->line('date')); ?></th>
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
-->
<h1 class="text-white text-center">coming soon</h1>  