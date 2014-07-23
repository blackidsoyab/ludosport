<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading"><?php echo getRoleName($session->role); ?><small>&nbsp;<?php echo $this->lang->line('control_panel'); ?></small></h1>
<!-- End page heading -->


<!-- BEGIN GIRD -->
<div class="alert alert-primary alert-block square"><?php echo $this->lang->line('numbers'); ?></div>
<div class="col-md-3">
    <div class="the-box no-border bg-success tiles-information">
        <i class="fa fa-users icon-bg"></i>
        <div class="tiles-inner text-center">
            <p><?php echo $this->lang->line('clan'); ?></p>
            <h1 class="bolded">
                <?php if (hasPermission('clans', 'viewClan')) { ?>
                    <a href="<?php echo base_url() . 'clan' ?>"  title="<?php echo $this->lang->line('list'), ' ', $this->lang->line('clan'); ?>"><?php echo @$total_classes; ?></a>
                    <?php
                } else {
                    echo @$total_classes;
                }
                ?>
            </h1> 
            <?php if (hasPermission('clans', 'addClan')) { ?>
                <a href="<?php echo base_url() . 'clan/add' ?>" class="link" title="<?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?>"><?php echo $this->lang->line('add'), ' ', $this->lang->line('clan'); ?></a>
            <?php
            } else {
                echo '&nbsp;';
            }
            ?>
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
            <?php
            } else {
                echo '&nbsp;';
            }
            ?>
        </div><!-- /.tiles-inner -->
    </div>							
</div>
</div>