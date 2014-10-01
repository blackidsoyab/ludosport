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

        $('input[name="has_point"]').on('ifChecked', function(event){
            $('#ratting_points').show();
        });

        $('input[name="has_point"]').on('ifUnchecked', function(event){
            $('#ratting_points').hide();
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('eventcategory'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'eventcategory/add'; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('eventcategory'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('has_rating'); ?></label>
            <div class="col-lg-8">
                <div class="checkbox padding-left-killer">
                    <label>
                        <input type="checkbox" value="1" class="i-grey-flat" name="has_point">
                    </label>
                </div>
            </div>
        </div>

        <div id="ratting_points" style="display:none">
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('xpr'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="xpr" class="form-control" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('war'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="war" class="form-control" value="0"/>
                </div>
            </div>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('sty'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="sty" class="form-control" value="0"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('save'); ?>"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'eventcategory' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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