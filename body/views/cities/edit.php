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
<h1 class="page-heading">Add New City</h1>
<div class="the-box">

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'city/edit/' . $city->id; ?>">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Select State
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <select id="state_id" name="state_id" class="form-control required">
                    <option value="">Select State</option>
                    <?php foreach ($states as $state) { ?>
                        <option value="<?php echo $state->id; ?>" <?php echo ($state->id == @$city->state_id) ? 'selected="selected"' : ''; ?>><?php echo $state->en_name ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                City Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="en_name"  class="form-control required" placeholder="City Name in English" value="<?php echo @$city->en_name; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                City Name
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="it_name"  class="form-control" placeholder="City Name in Itlian" value="<?php echo @$city->it_name; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url() . 'city' ?>" class="btn btn-default">Cancel</a>
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