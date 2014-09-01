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
    <?php foreach ($events as $event) { ?>
    <div class="col-sm-4">
        <div class="the-box no-border full store-item text-center">
            <img src="<?php echo IMG_URL .'event_images/300X200/' . $event->image; ?>" class="item-image" alt="Image">
            <div class="the-box margin-killer no-border ">
                <div class="row">
                    <div class="col-xs-12">
                        <p class="text-danger bolded"><strong><?php echo ucfirst($event->{$session->language.'_name'}), ' at ', getLocationName($event->city_id, 'City'); ?></strong></p>
                        <p>
                        <?php
                            echo date('d-m-Y', strtotime($event->date_from)), ' : ' , date('d-m-Y', strtotime($event->date_to));
                        ?>
                        </p>
                    </div>
                </div>
                <a href="<?php echo base_url() .'event/view/'. $event->id ; ?>" class="btn btn-primary btn-block"><i class="fa fa-heart-o"></i><?php echo $this->lang->line('view'); ?></a>
            </div>
        </div>
    </div>
    <?php } ?>
</div>