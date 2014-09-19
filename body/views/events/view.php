<?php $session = $this->session->userdata('user_session'); ?>
<div class="row">
    <div class="col-lg-6 col-xs-6">
        <h1 class="page-heading h1"><?php echo $this->lang->line('manage'), ' ', $this->lang->line('event'); ?></h1>    
    </div>

    <div class="col-lg-6 col-xs-6">
        <?php if (hasPermission('events', 'addEvent')) { ?>
            <a href="<?php echo base_url() . 'event/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?></a>
        <?php } ?>
    </div>
</div>


<div class="row">
    <?php foreach ($events_for_all as $event_all) { ?>
    <div class="col-sm-4">
        <div class="the-box no-border full store-item text-center">
            <img src="<?php echo IMG_URL .'event_images/300X200/' . $event_all->image; ?>" class="item-image" alt="Image">
            <div class="the-box margin-killer no-border ">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="text-danger bolded"><strong><?php echo ucfirst($event_all->{$session->language.'_name'}), ' at ', getLocationName($event_all->city_id, 'City'); ?></strong></p>
                        <p>
                        <?php
                            echo date('d-m-Y', strtotime($event_all->date_from)), ' : ' , date('d-m-Y', strtotime($event_all->date_to));
                        ?>
                        </p>
                    </div>
                </div>
                <a href="<?php echo base_url() .'event/view/'. $event_all->id ; ?>" class="btn btn-primary btn-block"><i class="fa fa-heart-o"></i><?php echo $this->lang->line('view'); ?></a>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php if($events_for_school != false) { ?>
        <?php foreach ($events_for_school as $event_school) { ?>
            <div class="col-sm-4">
                <div class="the-box no-border full store-item text-center">
                    <img src="<?php echo IMG_URL .'event_images/300X200/' . $event_school->image; ?>" class="item-image" alt="Image">
                    <div class="the-box margin-killer no-border ">
                        <div class="row">
                            <div class="col-xs-12">
                                <p class="text-danger bolded"><strong><?php echo ucfirst($event_school->{$session->language.'_name'}), ' at ', getLocationName($event_school->city_id, 'City'); ?></strong></p>
                                <p>
                                <?php
                                    echo date('d-m-Y', strtotime($event_school->date_from)), ' : ' , date('d-m-Y', strtotime($event_school->date_to));
                                ?>
                                </p>
                            </div>
                        </div>
                        <a href="<?php echo base_url() .'event/view/'. $event_school->id ; ?>" class="btn btn-primary btn-block"><i class="fa fa-heart-o"></i><?php echo $this->lang->line('view'); ?></a>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>