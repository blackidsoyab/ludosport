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
    });
    //]]>
</script>
<h1 class="page-heading">Edit Country</h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'country/edit/' . @$country->id; ?>">
        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Country Name
                <span class="text-danger">*</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="en_name"  class="form-control required" placeholder="Country Name in English" value="<?php echo @$country->en_name; ?>"/>
            </div>
        </div>

        <div class="form-group">
            <label for="question" class="col-md-2 control-label">
                Country Name
                <span class="text-danger">&nbsp;</span>
            </label>
            <div class="col-md-4">
                <input type="text" name="it_name"  class="form-control" placeholder="Country Name in Itlian" value="<?php echo @$country->it_name; ?>" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">&nbsp;</label>
            <div class="col-md-8">
                <button type="submit" class="btn btn-primary">Update</button>
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