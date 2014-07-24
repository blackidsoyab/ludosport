<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
            rules: {
                method: {
                    remote: {
                        url: "<?php echo base_url() . 'permission/check/' . $permission->id; ?>",
                        type: "post",
                        data: {
                            controller: function() {
                                return $( "#controller" ).val();
                            },
                            method: function() {
                                return $( "#method" ).val();
                            }
                        }
                    }
                }
            },
            messages: {
                method: {
                    remote: '* Permission Already exits'
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
        
        $('#controller').change(function() {
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>permission/getmethod/' + $('#controller').val() +'/'+ '<?php echo isset($permission->method) ? $permission->method : 0; ?>',
                success: function(data)
                {
                    console.log(data);
                    $('#method').empty();
                    $('#method').append(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown)
                {
                    alert('error');
                }
            });
        });
        
        $('#is_menu').click(function(){
            $("#menu_title").toggle(this.checked);
        });
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('edit'), ' ', $this->lang->line('permission'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'permission/edit/' . $permission->id; ?>">
        <?php
        foreach ($this->config->item('custom_languages') as $key => $value) {
            $temp = $key . '_perm_name';
            ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Permission Name in <?php echo ucwords($value); ?>" value="<?php echo $permission->$temp; ?>"/>
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('controller'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <select id="controller" name="controller" class="form-control required">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('controller'); ?></option>
                    <?php
                    foreach ($all_controllers as $k => $v) {
                        echo '<optgroup label="' . ucwords(str_replace('_', ' ', $k)) . '">';
                        foreach ($v as $controller) {
                            ?>
                            <option value="<?php echo $controller; ?>" <?php echo ($controller == @$permission->controller) ? 'selected="selected"' : '' ?>><?php echo ucwords(str_replace('_', ' ', $controller)); ?></option>
                            <?php
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('method'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-lg-5">
                <select id="method" name="method" class="form-control required">
                    <?php foreach ($all_methods as $method) { ?>
                        <option value="<?php echo $method; ?>" <?php echo ($method == @$permission->method) ? 'selected="selected"' : '' ?>><?php echo $method; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('parent'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-5">
                <select name="parent_id" class="form-control">
                    <option value="0"><?php echo $this->lang->line('no'), ' ', $this->lang->line('parent'); ?></option>
                    <?php loopMenuArray($menu_tree, 0, @$permission->parent_id); ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-lg-3 control-label">
                <?php echo $this->lang->line('is') . ' ' . $this->lang->line('menu'); ?>
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-lg-5">
                <label class="checkbox-inline" for="is_menu">
                    <input type="checkbox" name="is_menu" id="is_menu" value="1" <?php echo (@$permission->is_menu == '1') ? 'checked' : ''; ?>>
                </label>
            </div>
        </div>

        <div id="menu_title" style="display:<?php echo (@$permission->is_menu == '1') ? 'block' : 'none'; ?>">
            <?php
            foreach ($this->config->item('custom_languages') as $key => $value) {
                $temp = $key . '_menu_title';
                ?>
                <div class="form-group">
                    <label for="question" class="col-lg-3 control-label">
                        <?php echo ucwords($value), ' ', $this->lang->line('menu'), ' ', $this->lang->line('name'); ?>
                        <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                    </label>
                    <div class="col-lg-5">
                        <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('menu'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo @$permission->$temp; ?>"/>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="form-group">
            <label class="col-lg-3 control-label">&nbsp;</label>
            <div class="col-lg-5">
                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('update'); ?>"><?php echo $this->lang->line('update'); ?></button>
                <a href="<?php echo base_url() . 'permission' ?>" class="btn btn-default" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('cancel'); ?>"><?php echo $this->lang->line('cancel'); ?></a>
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