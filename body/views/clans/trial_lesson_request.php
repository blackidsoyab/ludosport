<?php 
$session = $this->session->userdata('user_session'); 

if(!is_null($clan_details)){
    $url = base_url() . 'clan/listTrialLessonRequestJson/' . $clan_details->id;
    $clan_name = ' : '. $clan_details->{$session->language .'_class_name'} ;
}else{
    $url = base_url() . 'clan/listTrialLessonRequestJson';
    $clan_name = null;
}
?>
<script type="text/javascript" >
    $(document).ready(function() {
        $('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center", "bSortable": false},{"sClass": "text-center", "bSortable": false}
            ],
            "sAjaxSource": "<?php echo $url; ?>"
        });
    });
</script>

<div class="row">
    <div class="col-md-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('list'), ' ', $this->lang->line('trial_lesson'), ' ', $this->lang->line('student'), $clan_name; ?></h1>    
    </div>
</div>


<div class="the-box">
    <div class="table-responsive">
        <table class="table table-striped table-hover" id="list_data">
            <thead class="the-box dark full">
                <tr align="left">
                    <th><?php echo $this->lang->line('student'), ' ', $this->lang->line('name'); ?></th>
                    <th width="200"><?php echo $this->lang->line('clan'); ?></th>
                    <th width="150"><?php echo $this->lang->line('date'); ?></th>
                    <th width="100"><?php echo $this->lang->line('status'); ?></th>
                    <th width="100"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="5"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>