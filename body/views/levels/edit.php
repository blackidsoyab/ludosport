<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#edit").validate({
            errorPlacement: function(error, element) {
                if (element.attr('type') === 'radio' || element.attr('type') === 'checkbox') {
                    error.appendTo(element.parent());
                }
                else {
                    error.insertAfter(element);
                }
            }
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('level'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'level/edit/' . @$level->id; ?>">
        <?php
        foreach ($this->config->item('custom_languages') as $key => $value) {
            $temp = $key . '_level_name';
            ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('level'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $level->$temp; ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('level'), ' ', $this->lang->line('is_basic'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <label class="checkbox-inline" for="checkboxes-0">
                    <input type="checkbox" name="is_basic" id="checkboxes-0" value="1" <?php echo $level->is_basic == '1' ? 'checked' : ''; ?>>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('level'), ' ', $this->lang->line('under_sixteen'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <label class="checkbox-inline" for="checkboxes-1">
                    <input type="checkbox" name="under_sixteen" id="checkboxes-1" value="1" <?php echo $level->under_sixteen == '1' ? 'checked' : ''; ?>>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'level' ?>" class="btn btn-default" title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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