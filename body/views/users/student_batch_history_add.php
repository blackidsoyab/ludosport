<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#add").validate();
    $('.batch_img').hide();

    $('#batch_selection').change(function(){
        if($('#batch_selection').val() != ""){
            $('.batch_img').show();
            $('.batch_img img').attr('src', '<?php echo IMG_URL ."batches/"; ?>' + $(this).find(':selected').data('batch-image'));
        }else{
            $('.batch_img').hide();
        }
    });

    $('.datepicker').datepicker({
            format: "dd-mm-yyyy",
            startView: 2,
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function (ev) {
            $(this).datepicker('hide');
    });
});
//]]>
</script>

<h1 class="page-heading h1"><?php echo $this->lang->line('add'), ' ', $this->lang->line('batch_history'); ?> : <a href="<?php echo base_url() .'profile/view/' . $user->id; ?>"><?php echo $user->firstname, ' ', $user->lastname; ?></a></h1>

<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'user_student/badge_history/add/' . $user->id; ?>">

        <div class="form-group">
             <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('batch'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required chosen-select" name="batch_id" id="batch_selection">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('batch'); ?></option>
                    <?php foreach ($batches as $batch) { ?>
                        <option value="<?php echo $batch->id; ?>" data-batch-image="<?php echo $batch->image; ?>" <?php echo (in_array($batch->id, $assigned_batches)) ? 'disabled' : ''; ?>><?php echo $batch->{$session->language.'_name'}; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="batch_img">
                <img class="img-circle avatar-60" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('assign_date'); ?> <span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <input type="text" name="date" class="form-control required datepicker" readonly="readonly">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label" for="radios"><?php echo $this->lang->line('affect_score'); ?></label>
            <div class="col-lg-5"> 
                <label class="radio-inline padding-left-killer" for="radios-0">
                    <input type="radio" name="affect_score" id="radios-0" value="Y" class="i-grey-square">
                    <?php echo $this->lang->line('yes'); ?>
                </label> 
                <label class="radio-inline padding-left-killer" for="radios-1">
                    <input type="radio" name="affect_score" id="radios-1" value="N" class="i-grey-square" checked>
                    <?php echo $this->lang->line('no'); ?>
                </label>  
            </div>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'user_student/badge_history/' . $user->id;  ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>