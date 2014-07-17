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
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('state'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'state/add'; ?>">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select id="country_id" name="country_id" class="form-control required">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('country'); ?></option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->id; ?>"><?php echo $country->en_name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                   <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('state'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'state' ?>" class="btn btn-default" title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
            </div>
        </div>
            
        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <?php echo $this->lang->line('compulsory_note'); ?>
            </div>
        </div>
    </form>
</div>