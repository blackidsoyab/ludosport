<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>tree/js/jquery.tree.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo PLUGIN_URL; ?>tree/css/jquery.tree.css"/>
<style>
    .ui-widget-content {
        border: 0px solid #aaaaaa;
    }
</style>
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
        
        $('#permission_tree div').tree();
        
        $('#permission_tree-checkAll').click(function(){
            $('#permission_tree div').tree('checkAll');
        });

        $('#permission_tree-uncheckAll').click(function(){
            $('#permission_tree div').tree('uncheckAll');
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

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button id="permission_tree-checkAll" type="button" class="btn btn-default">Check all</button>
                <button id="permission_tree-uncheckAll" type="button" class="btn btn-default">Uncheck all</button>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                <?php echo $this->lang->line('permission'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-8">
                <div id="permission_tree">
                    <div>
                        <ul>
                            <?php echo loopPermissionArray(createPermissionArray(), unserialize($role->permission)); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

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