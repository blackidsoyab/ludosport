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
<h1 class="page-heading">Add New Country</h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'country/add'; ?>">
        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    <?php echo ucwords($value) . ' Name'; ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Country Name in <?php echo ucwords($value); ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="<?php echo base_url() . 'country' ?>" class="btn btn-default">Cancel</a>
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