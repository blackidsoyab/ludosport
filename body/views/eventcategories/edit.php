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

        $('input[name="has_point"]').on('ifChecked', function(event){
            $('#ratting_points').show();
        });

        $('input[name="has_point"]').on('ifUnchecked', function(event){
            $('#ratting_points').hide();
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('eventcategory'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'eventcategory/edit/' . @$eventcategory->id; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('eventcategory'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $eventcategory->{$key . '_name'}; ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('is_tournament'); ?></label>
            <div class="col-lg-8">
                <label class="radio-inline padding-left-killer" for="p-radios-0">
                    <input type="radio" id="p-radios-0" value="1" class="radio i-grey-square" name="is_tournament" <?php echo ($eventcategory->is_tournament == 1) ? 'checked="checked"' : ''; ?>/>
                <?php echo $this->lang->line('yes'); ?>
                </label>
                <label class="radio-inline  padding-left-killer" for="a-radios-1">
                    <input type="radio" id="p-radios-1" value="0" class="radio i-grey-square" name="is_tournament"  <?php echo ($eventcategory->is_tournament == 0) ? 'checked="checked"' : ''; ?>/>
                <?php echo $this->lang->line('no'); ?>
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('has_rating'); ?></label>
            <div class="col-lg-8">
                <div class="checkbox padding-left-killer">
                    <label>
                        <input type="checkbox" value="1" class="i-grey-flat" name="has_point" <?php echo ($eventcategory->has_point == 1) ? 'checked' : ''; ?>>
                    </label>
                </div>
            </div>
        </div>

        <div id="ratting_points" style="display: <?php echo ($eventcategory->has_point == 1) ? 'block' : 'none'; ?>">
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('xpr'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="xpr" class="form-control" value="<?php echo $eventcategory->xpr; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('war'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="war" class="form-control" value="<?php echo $eventcategory->war; ?>"/>
                </div>
            </div>

            <div class="form-group">
                <label for="question" class="col-lg-3 control-label"><?php echo $this->lang->line('sty'); ?></label>
                <div class="col-lg-5">
                    <input type="number" min="0" name="sty" class="form-control" value="<?php echo $eventcategory->sty; ?>"/>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
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