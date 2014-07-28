<script>
    $(document).ready(function() {
        var track_load = 0; //total loaded record group(s)
        var loading  = false; //to prevents multipal ajax loads
        var total_groups = <?php echo $per_page; ?>; //total record group(s)
    
        $('#results').load("<?php echo base_url() . 'load_more_notification/'; ?>" + track_load , function() {track_load++;}); //load first group
    
        $(window).scroll(function() { //detect page scroll
        
            if($(window).scrollTop() + $(window).height() == $(document).height())  //user scrolled to bottom of the page?
            {
            
                if(track_load <= total_groups && loading==false) //there's more data to load
                {
                    loading = true; //prevent further ajax loading
                    $('.animation_image').show(); //show loading image
                
                    //load data from the server using a HTTP POST request
                    $.post('<?php echo base_url() . 'load_more_notification/'; ?>' + track_load , function(data){
                                    
                        $("#results").append(data); //append received data into the element

                        //hide loading image
                        $('.animation_image').hide(); //hide loading image once data is received
                    
                        track_load++; //loaded group increment
                        loading = false; 
                
                    }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
                    
                        alert(thrownError); //alert with HTTP error
                        $('.animation_image').hide(); //hide loading image
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