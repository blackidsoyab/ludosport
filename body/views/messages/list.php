<script type="text/javascript" >
    $(document).ready(function() {
        loadDatatable();

        
        $('#delete_messages_button').click(function(e){
            var count = $('a.list-group-item input[name="message_id[]"]:checked').length;
            if(count > 0){
                $.ajax( {
                    url : '<?php echo base_url() . 'message/delete'; ?>',
                    type: "POST",
                    data :  $('a.list-group-item input[name="message_id[]"]:checked').serializeArray(),
                    success:function(data, textStatus, jqXHR) {
                        loadDatatable();
                    }
                });
            }else{
                e.preventDefault();    
            }
        });
        
        $('#list_data_filter').parent().prev().remove();
        $('#list_data_filter').parent().removeClass('col-sm-6').addClass('col-sm-12');
        $('#list_data_filter').find('label').addClass('form-group has-feedback no-label');
        $('#list_data_filter').find(':input').attr("placeholder", "<?php echo $this->lang->line('search'), ' ', $this->lang->line('message'), ' in ', ucwords($message_box); ?>");
        $('#list_data_filter').find('label').append('<span class="fa fa-search form-control-feedback"></span>');
    });
    
    function loadDatatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        dTable=$('#list_data').dataTable({
             "bProcessing": true,
            "bServerSide" : true,
            "bLengthChange": false,
            "bInfo": false,
            'iDisplayLength': <?php $lengths = explode(',', $this->config->item('data_table_length')); echo $lengths[0]; ?>,
            "oLanguage": { "sSearch": "" },
            "aoColumns": [ {"bSortable": false, "sClass": ""} ],
            "sAjaxSource": "<?php echo base_url() . "message/getjson/" . $message_box; ?>",
            "fnDrawCallback": function ( oSettings ) {
                $(oSettings.nTHead).hide();
            },
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });
    }
</script>

<style>
    table.dataTable tbody > tr > td {
        padding-left: 0px !important; 
        padding-right: 0px !important;
    }
</style>

<div class="table-responsive list-group success square no-side-border">
    <table id="list_data" style="width: 100%">
        <thead>
            <tr>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $this->lang->line('loading'); ?> ...</td>
            </tr>
        </tbody>
    </table>
</div>