<script type="text/javascript" >
    
    $(document).ready(function() {
        loadDatable();
       
        $('#school_id').change(function(){
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
            "aaSorting": [[ 0, "asc" ]],
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-center"},{"sClass": "text-center"},{"sClass": "text-center", "bSortable": false},{"sClass": "text-center", "bSortable": false}
            ],
            "sAjaxSource": "<?php echo base_url() . "clan/getjson/"; ?>" +  $('#school_id').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }

    function UpdateRow(ele) {
        var current_id = $(ele).attr('id');
        var parent = $(ele).parent().parent();

        $.confirm({
            'title': 'Manage Class',
            'message': 'Do you Want to Delete the Class ?',
            'buttons': {
                '<?php echo $this->lang->line("yes"); ?>': {'class': 'btn btn-danger',
                    'action': function() {
                        $.ajax({
                            type: 'POST',
                            url: http_host_js + 'clan/delete/' + current_id,
                            data: id = current_id,
                            success: function() {
                                window.location.reload();
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {
                                alert('error');
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
        <h1 class="page-heading h1 pull-left"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('clan'); ?></h1>    

        <?php if (hasPermission('clans', 'addClan')) { ?>
            <a href="<?php echo base_url() . 'clan/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?></a>
        <?php } ?>
    </div>
</div>

<div class="the-box">
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control required" id="school_id">
            <option value="0">Filter by School</option>
            <?php foreach ($schools as $school) { ?>
                <option value="<?php echo $school->id; ?>" <?php echo (@$school_id == $school->id) ? 'selected' : ''; ?>><?php echo $school->{$session->language . '_school_name'}; ?></option>
            <?php } ?>    
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
                    <th><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('instructor'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('level'); ?></th>
                    <th><?php echo $this->lang->line('school'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('total'), ' ', $this->lang->line('student'); ?></th>
                    <th><?php echo $this->lang->line('trial_lesson'); ?></th>
                    <th width="100"><?php echo $this->lang->line('actions'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7"><i><?php echo $this->lang->line('loading'); ?>...</i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>