<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading h1"><?php echo $this->lang->line('timeline'); ?></h1>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="tags-cloud">
            <?php foreach ($timeline_years as $timeline_year) { ?>
                <a href="<?php echo base_url(). 'timeline/' . $timeline_year->year; ?>"><span class="label label-warning"><?php echo $timeline_year->year; ?></span></a>
            <?php } ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <ul class="timeline">
            <li class="centering-line"></li>
            <div id="timeline-data">
            </div>
        </ul>

        <div align="center">
            <button class="btn btn-primary btn-perspective text-center load_more" >Click here / Scroll down to load more <i class="padding-killer fa fa-long-arrow-down text-white"></i></button>
        </div>

        <div class="animation_image" style="display:none" align="center">
            <i class="fa fa-cog fa-spin fa-2x text-white padding-killer"></i>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var track_load = 0;
        var loading  = false;
        var total_groups = <?php echo $per_page; ?>;

        $('#timeline-data').load("<?php echo base_url() . 'history/load_more_timeline/' . $session->id .'/'.$year .'/'; ?>" + track_load , function() {track_load++;
            PositionFooter();
        });

        $(window).scroll(function() {
            if($(window).scrollTop() + $(window).height() == $(document).height()){
                if(track_load <= total_groups && loading==false){
                    loading = true;
                    $('.animation_image').show();
                    $.post('<?php echo base_url() . "history/load_more_timeline/" . $session->id .'/'.$year ."/"; ?>' + track_load , function(data){
                        $("#timeline-data").append(data);
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

         $('.load_more').click(function(){
            if(track_load <= total_groups && loading==false){
                loading = true;
                $('.animation_image').show();
                $.post('<?php echo base_url() . "history/load_more_timeline/" . $session->id .'/'.$year ."/"; ?>' + track_load , function(data){
                    $("#timeline-data").append(data);
                    $('.animation_image').hide();
                    track_load++;
                    loading = false; 
                }).fail(function(xhr, ajaxOptions, thrownError) {
                    $('.animation_image').hide();
                    loading = false;
                });
            }
        });
    });
</script>