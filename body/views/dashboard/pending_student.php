<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?></h1>

<div class="alert alert-primary alert-block square">
    <?php echo $this->lang->line('your_location'), ' : ', $city_name, ', ', $state_name, ', ', $country_name; ?>
</div>

<div class="row">
    <h1 class="text-center"><?php echo $this->lang->line('select'), ' ', $this->lang->line('clan'); ?></h1>
    <?php
    if (is_object($clans)) {
        foreach ($clans as $clan) {
            ?>
            <div class="col-lg-4 col-xs-4">
                <div class="the-box rounded text-center">
                    <h4 class="light"><?php echo $clan->{$session->language . '_class_name'}; ?></h4>
                </div>
            </div> 

            <?php
        }
    } else {
        echo $clans;
    }
    ?>
</div>