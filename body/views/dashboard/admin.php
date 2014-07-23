<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
<div class="alert alert-primary alert-block square"><?php echo $this->lang->line('numbers'); ?></div>

<div class="row">
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('academies'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('academies', 'viewAcademy')) { ?>
                        <a href="<?php echo base_url() . 'academy' ?>" class="link" title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('academy'); ?>"><?php echo @$total_academies; ?></a>
                        <?php
                    } else {
                        echo @$total_academies;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('academies', 'addAcademy')) { ?>
                    <a href="<?php echo base_url() . 'academy/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('academy'); ?></a>
                 <?php } else { echo '&nbsp;'; } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('schools'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('schools', 'viewSchool')) { ?>
                        <a href="<?php echo base_url() . 'school' ?>" title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('school'); ?>"><?php echo @$total_schools; ?></a>
                        <?php
                    } else {
                        echo @$total_schools;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('schools', 'addSchool')) { ?>
                    <a href="<?php echo base_url() . 'school/add' ?>" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('school'); ?></a>
                 <?php } else { echo '&nbsp;'; } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('instructors'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('users', 'viewUser')) { ?>
                        <a href="<?php echo base_url() . 'user' ?>"  title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('instructors'); ?>"><?php echo @$total_instructors; ?></a>
                        <?php
                    } else {
                        echo @$total_instructors;
                    }
                    ?>
                </h1> 
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
                 <?php } else { echo '&nbsp;'; } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
    <div class="col-md-3">
        <div class="the-box no-border bg-success tiles-information">
            <i class="fa fa-users icon-bg"></i>
            <div class="tiles-inner text-center">
                <p><?php echo $this->lang->line('students'); ?></p>
                <h1 class="bolded">
                    <?php if (hasPermission('users', 'viewUser')) { ?>
                        <a href="<?php echo base_url() . 'user' ?>"  title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('students'); ?>"><?php echo @$total_students; ?></a>
                        <?php
                    } else {
                        echo @$total_students;
                    }
                    ?>
                </h1>
                <?php if (hasPermission('users', 'addUser')) { ?>
                    <a href="<?php echo base_url() . 'user/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('user'); ?></a>
                 <?php } else { echo '&nbsp;'; } ?>
            </div><!-- /.tiles-inner -->
        </div>							
    </div>
</div>