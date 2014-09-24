<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $("#add").validate();

    $("input[name='oper[xpr]']").click(function(){
        if($('input:radio[name="oper[xpr]"]:checked').val() != "N"){
            $('input[name="score[xpr]"').closest('.form-group').show();
            $('textarea[name="description[xpr]"').closest('.form-group').show();

            if($('input:radio[name="oper[xpr]"]:checked').val() == "D") {
                $('input[name="score[xpr]"').attr('max', '<?php echo $userdetails->xpr; ?>');
            } else {
                $('input[name="score[xpr]"').removeAttr('max');
            }
        }else{
           $('input[name="score[xpr]"]').closest('.form-group').hide();
            $('textarea[name="description[xpr]"').closest('.form-group').hide(); 
        }   
    });

    $("input[name='oper[war]']").click(function(){
        if($('input:radio[name="oper[war]"]:checked').val() != "N"){
            $('input[name="score[war]"').closest('.form-group').show();
            $('textarea[name="description[war]"').closest('.form-group').show();

            if($('input:radio[name="oper[war]"]:checked').val() == "D") {
                $('input[name="score[war]"').attr('max', '<?php echo $userdetails->war; ?>');
            } else {
                $('input[name="score[war]"').removeAttr('max');
            }
        }else{
           $('input[name="score[war]"]').closest('.form-group').hide();
            $('textarea[name="description[war]"').closest('.form-group').hide(); 
        }   
    });

    $("input[name='oper[sty]']").click(function(){
        if($('input:radio[name="oper[sty]"]:checked').val() != "N"){
            $('input[name="score[sty]"').closest('.form-group').show();
            $('textarea[name="description[sty]"').closest('.form-group').show();

            if($('input:radio[name="oper[sty]"]:checked').val() == "D") {
                $('input[name="score[sty]"').attr('max', '<?php echo $userdetails->sty; ?>');
            } else {
                $('input[name="score[sty]"').removeAttr('max');
            }
        }else{
           $('input[name="score[sty]"]').closest('.form-group').hide();
            $('textarea[name="description[sty]"').closest('.form-group').hide(); 
        }   
    });
});
//]]>
</script>

<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('rating'), ' : ', $user->firstname,' ', $user->lastname; ?></h1>

<div class="the-box">
    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'studentrating/edit/' . $user->id; ?>">
        <fieldset>
            <legend><?php echo $this->lang->line('score'), ' ', $this->lang->line('details'); ?></legend>
            <div class="form-group">
                <label class="col-lg-3 control-label">XPR</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $userdetails->xpr; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">WAR</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $userdetails->war; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">STY</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $userdetails->sty; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="col-lg-3 control-label">TOTAL</label>
                <div class="col-lg-5">
                    <input type="text" class="form-control" disabled="disabled" value="<?php echo $userdetails->total_score; ?>">
                </div>
            </div>
        </fieldset>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <legend>XPR</legend>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Opertaion</label>
                    <div class="col-lg-8">
                        <label class="radio" for="radio-0">
                            <input type="radio" id="radio-0" value="N" name="oper[xpr]" checked="checked">
                            <?php echo $this->lang->line('none'); ?>
                        </label>

                        <label class="radio" for="radio-1">
                            <input type="radio" id="radio-1" value="M" name="oper[xpr]">
                            <?php echo $this->lang->line('merit'); ?>
                        </label>

                        <label class="radio" for="radio-2">
                            <input type="radio" id="radio-2" value="D" name="oper[xpr]">
                            <?php echo $this->lang->line('demerit'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label">Score <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="number" name="score[xpr]" class="form-control required" min="0" placeholder="Score">
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label"><?php echo $this->lang->line('reason'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <textarea name="description[xpr]" class="form-control bold-border required"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <legend>WAR</legend>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Opertaion</label>
                    <div class="col-lg-8">
                        <label class="radio" for="radio-3">
                            <input type="radio" id="radio-3" value="N" name="oper[war]" checked="checked">
                            <?php echo $this->lang->line('none'); ?>
                        </label>

                        <label class="radio" for="radio-4">
                            <input type="radio" id="radio-4" value="M" name="oper[war]">
                            <?php echo $this->lang->line('merit'); ?>
                        </label>

                        <label class="radio" for="radio-5">
                            <input type="radio" id="radio-5" value="D" name="oper[war]">
                            <?php echo $this->lang->line('demerit'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label">Score <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="number" name="score[war]" class="form-control required" min="0" placeholder="Score">
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label"><?php echo $this->lang->line('reason'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <textarea name="description[war]" class="form-control bold-border required"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <legend>STY</legend>
                <div class="form-group">
                    <label class="col-lg-4 control-label">Opertaion</label>
                    <div class="col-lg-8">
                        <label class="radio" for="radio-6">
                            <input type="radio" id="radio-6" value="N" name="oper[sty]" checked="checked">
                            <?php echo $this->lang->line('none'); ?>
                        </label>

                        <label class="radio" for="radio-7">
                            <input type="radio" id="radio-7" value="M" name="oper[sty]">
                            <?php echo $this->lang->line('merit'); ?>
                        </label>

                        <label class="radio" for="radio-8">
                            <input type="radio" id="radio-8" value="D" name="oper[sty]">
                            <?php echo $this->lang->line('demerit'); ?>
                        </label>
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label">Score <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="number" name="score[sty]" class="form-control required" min="0" placeholder="Score">
                    </div>
                </div>

                <div class="form-group" style="display:none">
                    <label class="col-lg-4 control-label"><?php echo $this->lang->line('reason'); ?> <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <textarea name="description[sty]" class="form-control bold-border required"></textarea>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                        <a href="<?php echo base_url() . 'studentrating' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="col-lg-12 text-center">
                        <?php echo $this->lang->line('compulsory_note'); ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>