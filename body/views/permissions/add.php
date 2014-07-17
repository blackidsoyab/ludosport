<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
            rules: {
                method: {
                    remote: {
                        url: "<?php echo base_url() . 'permission/check/0'; ?>",
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
                url: '<?php echo base_url(); ?>permission/getmethod/' + $('#controller').val() +'/0',
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
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $this->lang->line('add'), ' ', $this->lang->line('permission'); ?></h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'permission/add'; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="<?php echo $key . '_perm_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Permission Name in <?php echo ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('controller'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select id="controller" name="controller" class="form-control required">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('controller'); ?></option>
                    <?php
                    foreach ($all_controllers as $k => $v) {
                        echo '<optgroup label="' . ucwords(str_replace('_', ' ', $k)) . '">';
                        foreach ($v as $controller) {
                            ?>
                            <option value="<?php echo $controller; ?>" <?php echo ($controller == @$permission[0]->controllername) ? 'selected="selected"' : '' ?>><?php echo ucwords(str_replace('_', ' ', $controller)); ?></option>
                            <?php
                        }
                        echo '</optgroup>';
                    }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                <?php echo $this->lang->line('select'), ' ', $this->lang->line('method'); ?>
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select id="method" name="method" class="form-control required">
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('method'); ?></option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('save'); ?></button>
                <a href="<?php echo base_url() . 'permission' ?>" class="btn btn-default"><?php echo $this->lang->line('cancel'); ?></a>
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