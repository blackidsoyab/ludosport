<?php $session = $this->session->userdata('user_session'); ?>
<script>
    //<![CDATA[
    $(document).ready(function() {
        $(".ludosport-class :radio").hide().click(function(e){
            e.stopPropagation();
        });

        $("#step_2").hide();
        $("#step_3").hide();
        
        $(".ludosport-class div.clan").click(function(e){
            PositionFooter();
            $(this).closest(".ludosport-class").find("div.the-box").removeClass("bg-primary");
            $(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
            
            val = $(".ludosport-class div.clan").find("div.bg-primary").attr("data-clan");
            $.ajax({
                type: 'GET',
                url: '<?php echo base_url(); ?>getclandates/' + val,
                success: function(data)
                {
                    $("#step_2").show();
                    PositionFooter();
                    $('#clan_dates').empty();
                    $('#clan_dates').html(data);
                    PositionFooter();

                    $(".ludosport-class-date :radio").hide().click(function(e){
                        e.stopPropagation();
                    });
        
                    $(".ludosport-class-date div.clan-date").click(function(e){
                        $(this).closest(".ludosport-class-date").find("div.the-box").removeClass("bg-primary");
                        $(this).find("div.the-box").addClass("bg-primary").find(":radio").click();
                        $("#step_3").show();
                        PositionFooter();
                    });
                }
            });
        });
        
        $('#step_3').click(function(e) {
            e.preventDefault(); // prevent the link's default behaviour
            $('#trial_clan_selection').submit(); // trigget the submit handler
        });

        <?php if($change_only_date) { ?>
            $('.ludosport-class div.clan').trigger('click');
        <?php } ?>
        
    });
    //]]>
</script>
<h1 class="page-heading"><?php echo $session->role_name; ?></h1>
<?php if(isset($already_applied)) { ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-<?php echo $type;?> fade in alert-dismissable">
                    <p class="text-center">
                        <?php echo $already_applied; ?>
                    </p>
            </div>
        </div>
    </div>   
<?php } ?>

<?php if (isset($clans) && is_object($clans)) { ?>
    <form id="trial_clan_selection" action="<?php echo base_url() . 'pending_student/save_trial_lesson'; ?>" method="post">
        <input type="hidden" value="<?php echo $session->id ?>" name="student_id" />
        <div class="panel panel-primary" id="step_1">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-university"></i> Select Clan</h3>
                <div class="right-content">
                    <?php echo $this->lang->line('your_location'), ' : ', $city_name, ', ', $state_name, ', ', $country_name; ?>
                </div>
            </div>

            <div class="panel-body ludosport-class">
            <?php foreach ($clans as $clan) {  ?>
                    <div class="col-lg-4 col-xs-4 clan">
                        <div class="the-box rounded text-center" data-clan="<?php echo $clan->id; ?>">
                            <input type="radio" value="<?php echo $clan->id; ?>" name="clan_id" />
                            <h4 class="light"><?php echo $clan->{$session->language . '_class_name'}; ?></h4>
                        </div>
                    </div> 
                <?php } ?>
            </div>

        </div>
        <div class="panel panel-primary" id="step_2">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> Select Date</h3>
            </div>

            <div class="panel-body ludosport-class-date" id="clan_dates">
            </div>
        </div>

        <div id="step_3">
            <div class="text-center">
                <a class="btn btn-primary NextStep" id="btn-setp-2">Confirm<i class="fa fa-angle-right"></i></a>
            </div>
        </div>
    </form>
<?php } else if(isset($clans)) { ?>
<div class="alert alert-<?php echo $clan_error_type; ?> fade in alert-dismissable">
    <p class="text-center">
        <?php echo $clans; ?>
    </p>
</div>   
<?php } ?>


