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

    <form id="add" method="post" class="form-horizontal" action="<?php echo base_url() . 'states/edit/' . @$states->id; ?>">
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

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                State Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="en_name"  class="form-control required" placeholder="State Name in English" value="<?php echo @$states->en_name; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                State Name
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="it_name"  class="form-control" placeholder="State Name in Itlian" value="<?php echo @$states->it_name; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="<?php echo base_url() . 'states' ?>" class="btn btn-default">Cancel</a>
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