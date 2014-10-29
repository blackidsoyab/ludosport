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
                url: '<?php echo base_url(); ?>evolutionclan/getclasses/' + $('#school_id').val(),
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

        $('#declare_result').on('shown.bs.modal', function(e){
            $('#declare_result_form').submit(function(e) {
                $('.animation_image').show();
                $('.form-group').hide();
                $('.message').hide();
                var post_data = {
                    'student_id' : $('input[name="student_id"]').val(),
                    'evolutionclan_id' : $('input[name="evolutionclan_id"]').val(),
                    'result' : $('input[name="result"]:checked').val(),
                };
                $.ajax({
                    type: "POST",
                    url: '<?php echo  base_url(). "evolutionclan/result"; ?>',
                    data: post_data,
                    dataType : 'JSON',
                    success: function(data) {
                        $('.form-group').hide();
                        $('.animation_image').hide();
                        $('.message').show();
                        $('.message').addClass(data.class);
                        $('.message').html(data.msg);

                        setTimeout(function() {
                            $('#declare_result').modal('hide');
                            $('.message').removeClass(data.class);
                            loadDatable();
                        }, 2500);
                    }   
                });
                e.preventDefault();
            });
        });

        $('#declare_result').on('hidden.bs.modal', function(){
            $('input[name="student_id"]').val(0);
            $('input[name="evolutionclan_id"]').val(0);
            $('.form-group').show();
            $('.animation_image').hide();
            $('.message').hide();
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
            "aoColumns": [
                {"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": ""},{"sClass": "text-center"}
            ],
            "sAjaxSource": "<?php echo base_url() . 'evolutionclan/studentjson/'; ?>" + $('#academy_id').val() + '/' + $('#school_id').val() + '/' + $('#clan_id').val(),
            "fnInitComplete": function (oSettings, json) {
                PositionFooter();     
            },
            "fnDrawCallback": function( oSettings ) {
                $('a[data-toggle~="modal"]').on('click', function(e) {
                    var target_modal = $(e.currentTarget).data('target');
                    var modal = $(target_modal);
                    modal.on('show.bs.modal', function () {
                        $('input[name="student_id"]').val($(e.currentTarget).data('studentid'));
                        $('input[name="evolutionclan_id"]').val($(e.currentTarget).data('evolutionclanid'));
                        $.getJSON(e.currentTarget.href).success(function(data) {
                            if(data.status == true){
                                $('.modal-title').html('<?php echo $this->lang->line("title_declare_result_of_evolution_clan"); ?>' + ' : ' + data.evolutionclan_name);
                                $('.student-name').html(data.student_name + ' : ');
                            } else{
                                $('#declare_result').modal('hide');
                            }
                        });   
                    }).modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    return false;
                });
            }
        });  
    }
</script>
<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading h1"><?php echo $this->lang->line('list'), ' ', $this->lang->line('student'); ?></h1>    

<div class="the-box">
    <h4 class="small-title"><?php echo $this->lang->line('filter'); ?>: <p class="pull-right"><a href="<?php echo base_url() . 'clan/studentlist'; ?>" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('reset'), ' ', $this->lang->line('filter'); ?>"><?php echo $this->lang->line('reset'), ' ', $this->lang->line('filter'); ?></a></p></h4>
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
                    <th><?php echo $this->lang->line('student'), ' ', $this->lang->line('name'); ?></th>
                    <th width="175"><?php echo $this->lang->line('clan'), ' ', $this->lang->line('name'); ?></th>
                    <th width="150"><?php echo $this->lang->line('school'), ' ', $this->lang->line('name'); ?></th>
                    <th width="150"><?php echo $this->lang->line('academy'), ' ', $this->lang->line('name'); ?></th>
                    <th width="100"><?php echo $this->lang->line('status'); ?></th>
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

<div class="modal fade" id="declare_result" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-no-shadow modal-no-border">
            <div class="modal-header">
                <h4 class="modal-title"></h4>
            </div>

            <form id="declare_result_form" method="post" class="form-horizontal" action="<?php echo  base_url(). "evolutionclan/result"; ?>">
                <input type="hidden" name="student_id" value="0">
                <input type="hidden" name="evolutionclan_id" value="0">

                <div class="form-group">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                        <label class="radio-inline student-name"></label>
                        <label class="radio-inline" for="radios-0">
                            <input type="radio" name="result" id="radios-0" class="i-grey-square" value="P">
                            <span class="pad-lt-10"><?php echo $this->lang->line('evolution_clan_pass'); ?></span>
                        </label>

                        <label class="radio-inline" for="radios-1">
                            <input type="radio" name="result" id="radios-1" class="i-grey-square" value="F" checked="checked">
                            <span class="pad-lt-10"><?php echo $this->lang->line('evolution_clan_fail'); ?></span>
                        </label>
                    </div>
                </div>

                <div class="alert message mar-10" style="display:none;">
                </div>
                <div class="animation_image" style="display:none" align="center">
                    <i class="fa fa-cog fa-spin fa-2x"></i>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>