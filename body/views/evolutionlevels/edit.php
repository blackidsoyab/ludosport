<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
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
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('evolutionlevel'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'evolutionlevel/edit/' . $evolutionlevel->id; ?>">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('select'), ' ', $this->lang->line('evolutioncategory'); ?><span class="text-danger">*</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="evolutioncategory_id">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('evolutioncategory'); ?></option>
                    <?php foreach ($evolution_categories as $category) { ?>
                        <option value="<?php echo $category->id; ?>" <?php echo ($category->id == $evolutionlevel->evolutioncategory_id) ? 'selected' : ''; ?>><?php echo ucwords($category->{$session->language . '_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('event'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $evolutionlevel->{$key . '_name'} ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('apply_after_passing'); ?><span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-5">
                <select class="form-control required" name="on_passing">
                    <option value="0"><?php echo $this->lang->line('basic_evolution_level'); ?></option>
                    <?php foreach ($evolution_levels as $level) { ?>
                        <option value="<?php echo $level->id; ?>" <?php echo ($level->id == $evolutionlevel->on_passing) ? 'selected' : ''; ?>><?php echo ucwords($level->{$session->language . '_name'}); ?></option>
                    <?php } ?>     
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'evolutionlevel' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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