<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
            rules: {
                en_role_name: {
                    remote: {
                        url: "<?php echo base_url() . 'role/check/' . $role->id; ?>",
                        type: "post",
                        data: {
                            en_role_name: function() {
                                return $( "#en_role_name" ).val();
                            }
                        }
                    }
                }
            },
            messages: {
                en_role_name: {
                    remote: '* Role Already exits'
                }
            },
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
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('role'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'role/edit/' . $role->id; ?>">
        <?php
        foreach ($this->config->item('custom_languages') as $key => $value) {
            $temp = $key . '_role_name';
            ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="<?php echo $temp; ?>" id="<?php echo $temp; ?>" class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Role in <?php echo ucwords($value); ?>" value="<?php echo @$role->$temp; ?>"/>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($aPerms as $k => $v) { ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="radios"><?php echo $v['name']; ?></label>
                <div class="col-md-4"> 
                    <label class="radio-inline" for="radios-0">
                        <input type="radio" name="<?php echo'prem[' . $v['id'] . ']'; ?>" id="<?php echo 'perm_' . $v['id'] . '_1'; ?>" value="1" <?php echo (@$rPerms[$v['key']]['value'] == 1 && @$role->id != '') ? 'checked="checked"' : ''; ?> /><?php echo $this->lang->line('allow'); ?>
                    </label> 
                    <label class="radio-inline" for="radios-0">
                        <input type="radio" name="<?php echo'prem[' . $v['id'] . ']'; ?>" id="<?php echo 'perm_' . $v['id'] . '_0'; ?>" value="0" <?php echo (@$rPerms[$v['key']]['value'] != 1 && @$role->id != '') ? 'checked="checked"' : ''; ?> /><?php echo $this->lang->line('deny'); ?>
                    </label> 
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary" title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'role' ?>" class="btn btn-default" title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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