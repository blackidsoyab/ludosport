<?php $session = $this->session->userdata('user_session'); ?>

<h1 class="page-heading"><?php echo $this->lang->line('view'), ' ', $this->lang->line('batch'); ?></h1>
<div class="the-box">

    <form id="edit" method="post" class="form-horizontal" action="<?php echo base_url() . 'batch/edit/' . $batch->id; ?>" enctype="multipart/form-data">

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('type'); ?> </label>
            <div class="col-lg-5">
                <select class="form-control required" name="type" disabled>
                    <option value=""><?php echo $this->lang->line('select'), ' ', $this->lang->line('type'); ?></option> 
                    <option value="D" <?php echo ($batch->type == 'D') ? 'selected' : '' ?>><?php echo $this->lang->line('degree'); ?></option>
                    <option value="H" <?php echo ($batch->type == 'H') ? 'selected' : '' ?>><?php echo $this->lang->line('honor'); ?></option>
                    <option value="M" <?php echo ($batch->type == 'M') ? 'selected' : '' ?>><?php echo $this->lang->line('master'); ?></option>
                    <option value="Q" <?php echo ($batch->type == 'Q') ? 'selected' : '' ?>><?php echo $this->lang->line('qualification'); ?></option>
                    <option value="S" <?php echo ($batch->type == 'S') ? 'selected' : '' ?>><?php echo $this->lang->line('security'); ?></option> 
                </select>
            </div>
        </div>

        <?php foreach ($this->config->item('custom_languages') as $key => $value) { ?>
            <div class="form-group">
                <label for="question" class="col-lg-3 control-label">
                    <?php echo ucwords($value), ' ', $this->lang->line('name'); ?>
                </label>
                <div class="col-lg-5">
                    <input type="text" name="<?php echo $key . '_name'; ?>"  class="<?php echo ($key == 'en') ? 'form-control required' : 'form-control'; ?>" placeholder="<?php echo $this->lang->line('batch'), ' ', $this->lang->line('name'), ' ', ucwords($value); ?>" value="<?php echo $batch->{$key . '_name'}; ?>" disabled/>
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('who_can_assign'); ?> </label>
            <div class="col-lg-8">
                <?php foreach ($roles as $role) { ?>
                    <span class="checkbox pull-left padding-left-killer pad-rt-10">
                        <label>
                            <input type="checkbox" value="<?php echo $role->id; ?>" class="required i-grey-flat" name="assign_role[]" <?php echo (in_array($role->id, explode(',', $batch->assign_role))) ? 'checked' : ''; ?>  disabled>
                            <?php echo $role->{$session->language.'_role_name'}; ?>
                        </label>
                    </span>
                <?php } ?>
            </div>
        </div>

        <?php if (!is_null($batch->image)) { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <img src="<?php echo IMG_URL . 'batches/' . $batch->image; ?>" class="img-batch" alt="Batch">
                </div>
            </div>
        <?php } ?>

        <?php if (!is_null($batch->cover_image) && $batch->cover_image != 'no_cover.jpg') { ?>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?php echo $this->lang->line('current'), ' ', $this->lang->line('cover_image'); ?>&nbsp;<span class="text-danger">&nbsp;</span></label>
                <div class="col-lg-5">
                    <img src="<?php echo IMG_URL . 'batches/cover_image/' . $batch->cover_image; ?>" class="img-batch-cover" alt="Batch Cover">
                </div>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="col-lg-3 control-label"><?php echo $this->lang->line('description'); ?> <span class="text-danger">&nbsp;</span></label>
            <div class="col-lg-8">
                <textarea  class="form-control summernote-sm" name="description" disabled><?php echo $batch->description; ?></textarea>
            </div>
        </div>

</div>