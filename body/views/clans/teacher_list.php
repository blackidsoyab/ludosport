<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bSort": false,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": ""}
            ],
            "sAjaxSource": "<?php echo base_url() . "clan/teacherjson"; ?>"
        });
    });
</script>

<div class="row">
    <div class="col-md-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('list'), ' ', $this->lang->line('teacher'); ?></h1>    
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('teacher'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('school'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('academy'), ' ', $this->lang->line('name'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                     <td colspan="4"><i>Loading...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>