<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $(".ludosport-class :radio").hide().click(function(e){
            e.stopPropagation();
        });
        
        $(".ludosport-class div.clan").click(function(e){
            $(this).closest(".ludosport-class").find("div.the-box").removeClass("bg-primary");
            $(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
        });
        
        $("#btn-setp-1").click(function(e){
            val = $(".ludosport-class div.clan").find("div.bg-primary").attr("data-clan");
            alert(val);
        });
        
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?></h1>
<?php if (is_object($clans)) { ?>
    <div class="panel with-nav-tabs panel-primary">
        <div class="panel-heading">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#step1" data-toggle="tab"><i class="fa fa-university"></i> Select Clan</a></li>
                <li class=""><a href="#step2" data-toggle="tab"><i class="fa fa-calendar"></i> Select Date</a></li>
                <li><a href="#step3" data-toggle="tab"><i class="fa fa-check"></i> Finish</a></li>
            </ul>
            <div class="right-content">
                <?php echo $this->lang->line('your_location'), ' : ', $city_name, ', ', $state_name, ', ', $country_name; ?>
            </div>
        </div>
        <div id="panel-collapse-1" class="collapse in">
            <div class="tab-content">
                <div class="tab-pane fade active in" id="step1">
                    <div class="panel-body ludosport-class">
                        <?php foreach ($clans as $clan) {
                            ?>
                            <div class="col-lg-4 col-xs-4 clan">
                                <div class="the-box rounded text-center" data-clan="<?php echo $clan->id; ?>">
                                    <input type="radio" value="<?php echo $clan->id; ?>" name="clan_id" />
                                    <h4 class="light"><?php echo $clan->{$session->language . '_class_name'}; ?></h4>
                                </div>
                            </div> 
                        <?php } ?>
                    </div><!-- /.panel-body -->
                    <div class="panel-footer text-right">
                        <a class="btn btn-primary NextStep" id="btn-setp-1">Next step <i class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                <div class="tab-pane fade" id="step2">
                    <div class="panel-body">
                        <h4>Example step 2</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                        </p>
                    </div><!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-primary PrevStep"><i class="fa fa-angle-left"></i> Prev step</a>
                            </div><!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right">
                                <a class="btn btn-primary NextStep">Next step <i class="fa fa-angle-right"></i></a>
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.panel-footer -->
                </div>
                <div class="tab-pane fade" id="step3">
                    <div class="panel-body">
                        <h4>Example step 3</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.
                        </p>
                    </div><!-- /.panel-body -->
                    <div class="panel-footer">
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-primary PrevStep"><i class="fa fa-angle-left"></i> Prev step</a>
                            </div><!-- /.col-sm-6 -->
                            <div class="col-sm-6 text-right">
                                <a class="btn btn-primary"><i class="fa fa-check"></i> Finish</a>
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->
                    </div><!-- /.panel-footer -->
                </div>
            </div><!-- /.tab-content -->
        </div><!-- /.collapse in -->
    </div>
    <?php
} else {
    echo $clans;
}
?>


