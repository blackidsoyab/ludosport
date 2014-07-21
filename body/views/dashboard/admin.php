<h1 class="page-heading"><?php echo $role_name; ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
<div class="alert alert-danger alert-block square"><?php echo $this->lang->line('numbers'); ?></div>

<div class="row">
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('academies'); ?></p>
                <h1 class="bolded"><?php echo @$total_academies; ?></h1> 
                <?php if (hasPermission('academies', 'addAcademy')) { ?>
                    <a href="<?php echo base_url() . 'academy/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?></a>
                <?php } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('schools'); ?></p>
                <h1 class="bolded"><?php echo @$total_schools; ?></h1> 
                <?php if (hasPermission('schools', 'addSchool')) { ?>
                    <a href="<?php echo base_url() . 'school/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?></a>
                <?php } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('instructors'); ?></p>
                <h1 class="bolded"><?php echo @$total_instructors; ?></h1> 
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
                <?php } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('students'); ?></p>
                <h1 class="bolded"><?php echo @$total_students; ?></h1> 
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
                <?php } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
</div>