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
<h1 class="page-heading">Edit State</h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'state/edit/' . @$states->id; ?>">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Select Country
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select id="country_id" name="country_id" class="form-control required">
                    <option value="">Select Country</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->id; ?>" <?php echo ($country->id == @$states->country_id) ? 'selected="selected"' : ''; ?>><?php echo $country->en_name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <?php
        foreach ($this->config->item('custom_languages') as $key => $value) {
            $temp = $key . '_name';
            ?>
            <div class="form-group">
                <label for="question" class="col-md-2 control-label">
                    <?php echo ucwords($value) . ' Name'; ?>
                    <span class="text-danger"><?php echo ($key == 'en') ? '*' : '&nbsp;'; ?></span>
                </label>
                <div class="col-md-4">
                    <input type="text" name="<?php echo $temp; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="Country Name in <?php echo ucwords($value); ?>" value="<?php echo $states->$temp; ?>"/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url() . 'state' ?>" class="btn btn-default">Cancel</a>
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