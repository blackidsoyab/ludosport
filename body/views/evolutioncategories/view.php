<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            "aLengthMenu": [ [<?php echo $this->config->item('data_table_length'); ?>], [<?php echo $this->config->item('data_table_length'); ?>] ],
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length'));
            echo $lengths[0]; ?>,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""}, {"bSortable": false, "sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'evolutioncategory/getjson'; ?>",
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    });
</script>

<h1 class="page-heading"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('evolutioncategory'); ?></h1>    

<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('evolutioncategory'), ' ', $this->lang->line('name'); ?></th>
                    <th width="125"><?php echo $this->lang->line('actions'); ?></th>
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