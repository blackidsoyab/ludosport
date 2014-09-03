<script type="text/javascript" >
    $(document).ready(function() {
        loadDatable();
       
        $('#academy_id').change(function(){
            loadDatable();
        });
        
        $('#school_id').change(function(){
            loadDatable();
        });
        
        $('#clan_id').change(function(){
            loadDatable();
        });
        
        $('#academy_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>clan/getschools/' + $('#academy_id').val(),
                success: function(data)
                {
                    $('#school_id').empty();
                    $('#clan_id').empty();
                    $('#school_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
        
        $('#school_id').change(function(){
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>clan/getclasses/' + $('#school_id').val(),
                success: function(data)
                {
                    $('#clan_id').empty();
                    $('#clan_id').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
    });
    
    function loadDatable(){
        if(typeof dTable!='undefined'){dTable.fnDestroy();}
        
        dTable=$('#list_data').dataTable({
            "bProcessing": true,
            'iDisplayLength': 10,
            "bServerSide" : true,
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": ""}
            ],
            "sAjaxSource": "<?php echo base_url() . 'clan/teacherjson/'; ?>" + $('#academy_id').val() + '/' + $('#school_id').val() + '/' + $('#clan_id').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            }
        });  
    }
</script>
<?php $session = $this->session->userdata('user_session'); ?>
<div class="row">
    <div class="col-md-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('list'), ' ', $this->lang->line('teacher'); ?></h1>    
    </div>
</div>


<div class="the-box">
    <h4 class="small-title"><?php echo $this->lang->line('filter'); ?>: <p class="pull-right"><a href="<?php echo base_url() . 'clan/teacherlist'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('reset'), ' ', $this->lang->line('filter'); ?>"><?php echo $this->lang->line('reset'), ' ', $this->lang->line('filter'); ?></a></p></h4>
    <div class="form-horizontal">
        <div class="form-group margin-killer">
            <div class=" col-lg-4">
                <select class="form-control required" name="academy_id" id="academy_id" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('academy'); ?>">
                    <option value="0"><?php echo $this->lang->line('all'), ' ', $this->lang->line('academy'); ?></option>
                    <?php
                    foreach ($all_academies as $academy) {
                        ?>
                        <option value="<?php echo $academy->id; ?>" <?php echo ($academy->id == @$academy_id) ? 'selected' : ''; ?>><?php echo $academy->{$session->language . '_academy_name'}; ?></option>
                    <?php } ?>     
                </select>
            </div>

            <div class=" col-lg-4">
                <select class="form-control required" name="school_id" id="school_id" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('school'); ?>">
                    <option value="0"><?php echo $this->lang->line('all'), ' ', $this->lang->line('school'); ?></option>
                    <?php
                    foreach ($all_schools as $school) {
                        ?>
                        <option value="<?php echo $school->id; ?>" <?php echo ($school->id == @$school_id) ? 'selected' : ''; ?>><?php echo $school->{$session->language . '_school_name'}; ?></option>
                    <?php } ?>     
                </select>
            </div>

            <div class=" col-lg-4">
                <select class="form-control required" name="clan_id" id="clan_id" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('clan'); ?>">
                    <option value="0"><?php echo $this->lang->line('all'), ' ', $this->lang->line('clan'); ?></option>
                    <?php
                    foreach ($all_clans as $clan) {
                        ?>
                        <option value="<?php echo $clan->id; ?>" <?php echo ($clan->id == @$clan_id) ? 'selected' : ''; ?>><?php echo $clan->{$session->language . '_class_name'}; ?></option>
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
                    <th><?php echo $this->lang->line('teacher'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('school'), ' ', $this->lang->line('name'); ?></th>
                    <th><?php echo $this->lang->line('academy'), ' ', $this->lang->line('name'); ?></th>
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