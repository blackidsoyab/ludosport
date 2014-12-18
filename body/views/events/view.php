<?php $session = $this->session->userdata('user_session'); ?>
<link href="<?php echo PLUGIN_URL; ?>salvattore/salvattore.css" rel="stylesheet" />

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-heading h1 pull-left"><?php echo $this->lang->line('event'); ?></h1>    

        <?php if (hasPermission('events', 'viewEventInvited')) { ?>
            <a href="<?php echo base_url() . 'event/view_inivted' ?>" class="btn btn-primary h1 pull-right mar-lt-10" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('view'), ' ', $this->lang->line('event_inivted'); ?>"><?php echo $this->lang->line('view'), ' ', $this->lang->line('event_inivted'); ?></a>
        <?php } ?>

        <?php if (hasPermission('events', 'addEvent')) { ?>
            <a href="<?php echo base_url() . 'event/add' ?>" class="btn btn-primary h1 pull-right" data-toggle="tooltip" data-original-title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('event'); ?></a>
        <?php } ?>

    </div>
</div>

<?php if($events != false) { ?>
    <div class="mason" data-columns="2">
        <?php foreach ($events as $event) { ?>
        <div class="item">
            <div class="the-box store-item text-center">
                <img src="<?php echo IMG_URL .'event_images/300X200/' . $event->image; ?>" class="item-image" alt="Image">
                <div class="the-box margin-killer no-border ">
                    <div class="row">
                        <div class="col-xs-12">
                            <p class="text-danger bolded"><strong><?php echo ucfirst($event->{$session->language.'_name'}), ' at ', getLocationName($event->city_id, 'City'); ?></strong></p>
                            <p>
                            <?php
                                if(strtotime($event->date_from) == strtotime($event->date_to)){
                                    echo date('d-m-Y', strtotime($event->date_from));
                                } else{
                                    echo  $this->lang->line('event_from_date') ,' ', date('d-m-Y', strtotime($event->date_from)),' ', $this->lang->line('event_to_date'),' ', date('d-m-Y', strtotime($event->date_to));    
                                }
                                
                            ?>
                            </p>
                        </div>
                    </div>
                            
                    <div class="row">
                        <?php 
                            $can_take_attendance = false;
                            if(in_array($event->id, $running_events_ids)){
                                if($session->role > 2){
                                    if(in_array($event->id, $manager_events_ids) && hasPermission('events', 'takeEventAttendance')){
                                        $can_take_attendance = true;
                                    }
                                }else{
                                    $can_take_attendance = true;
                                }
                            }
                        ?>

                        <div class="<?php echo ($can_take_attendance) ? 'col-lg-5 text-left' : 'col-lg-12';?>">
                            <a href="<?php echo base_url() .'event/view/'. $event->id; ?>" class="btn btn-primary <?php echo ($can_take_attendance) ? '' : 'btn-block';?>"><?php echo $this->lang->line('view'); ?></a>
                        </div>

                        <?php if($can_take_attendance){ ?>
                            <div class="col-lg-5 text-right">
                                <a href="<?php echo base_url() .'event/attendance/'. $event->id; ?>" class="btn btn-primary <?php echo ($can_take_attendance) ? '' : 'btn-block';?>"><?php echo $this->lang->line('event_take_attendance'); ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
<?php } ?>

<script src="<?php echo PLUGIN_URL; ?>salvattore/salvattore.min.js"></script>