<script>
$(document).ready(function() {
    var track_load = 0;
    var loading  = false;
    var total_groups = <?php echo $per_page; ?>;

    $('#results').load("<?php echo base_url() . 'load_more_notification/'; ?>" + track_load , function() {track_load++;});

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() == $(document).height())
        {
            if(track_load <= total_groups && loading==false)
            {
                PositionFooter();
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo base_url() . 'load_more_notification/'; ?>' + track_load , function(data){
                    $("#results").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false; 
                }).fail(function(xhr, ajaxOptions, thrownError) {
                    $('.animation_image').hide();
                    loading = false;
                });
            
            }
        }
    });
});
</script>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-heading h1"><?php echo $this->lang->line('view_all'), ' ', $this->lang->line('notifications'); ?></h1>  
    </div>
</div>

<div class="row">
    <div  id="results"></div>
    <div class="animation_image" style="display:none" align="center">
        <i class="fa fa-cog fa-spin fa-3x text-primary"></i>
    </div>
</div>