<script>
    //<![CDATA[
    $(document).ready(function() {
        $("#add").validate({
            rules: {
                en_role_name: {
                    remote: {
                        url: "<?php echo base_url() . 'role/check/0'; ?>",
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
<h1 class="page-heading">Add New Role</h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'role/add'; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    <?php echo ucwords($value) . ' Name'; ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" id="<?php echo $key . '_role_name'; ?>" name="<?php echo $key . '_role_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Role Name in <?php echo ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <?php foreach ($aPerms as $k => $v) { ?>
            <div class="form-group">
                <label class="col-md-2 control-label" for="radios"><?php echo $v['name']; ?></label>
                <div class="col-md-4"> 
                    <label class="radio-inline" for="radios-0">
                        <input type="radio" name="<?php echo'prem[' . $v['id'] . ']'; ?>" id="<?php echo 'perm_' . $v['id'] . '_1'; ?>" value="1" />Allow
                    </label> 
                    <label class="radio-inline" for="radios-0">
                        <input type="radio" name="<?php echo'prem[' . $v['id'] . ']'; ?>" id="<?php echo 'perm_' . $v['id'] . '_0'; ?>" value="0" checked="checked"/>Deny
                    </label> 
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url() . 'role' ?>" class="btn btn-default">Cancel</a>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                Fields marked with  <span class="text-danger">*</span>  are mandatory.
            </div>
        </div>
    </form>
</div>