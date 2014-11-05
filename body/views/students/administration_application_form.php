<?php $session = $this->session->userdata('user_session'); ?>
<link href="<?php echo PLUGIN_URL; ?>salvattore/salvattore.css" rel="stylesheet" />

<h1 class="page-heading h1"><?php echo $this->lang->line('application_form'); ?></h1>

<?php foreach ($application_forms_type_2 as $type_2) { ?>
	<?php if(${'application_forms_' . $type_2['id']} != false){ ?>
			<h4 class="text-white padding-killer"><?php echo $type_2[$session->language.'_name']; ?></h4>
			<hr class="margin-top-killer" />
			<?php $count = 1; ?>
			<?php foreach (${'application_forms_' . $type_2['id']} as $form) { ?>
				<?php echo ($count == 1) ? '<div class="row">' : ''; ?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
					<div class="the-box padding-top-killer padding-top-killer">
						<img src="<?php echo IMG_URL .'solution_courses/' . $form->image; ?>" class="img-responsive solution-course-img" />
	        			<p class="text-center bolded"><strong><?php echo $form->{$session->language.'_name'}; ?></strong></p>
	        			<p class="text-justify"><?php echo $form->description; ?></p>
        				<div class="row">
	        				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	        					<a href="<?php echo base_url() .'moduli/'. $form->type_1 .'/'. $form->type_2 .'/'. $form->form; ?>" class="btn btn-block btn-primary"><?php echo $this->lang->line('application_form'); ?></a>
	        				</div>
        					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
	        					<button class="btn btn-block btn-primary"><?php echo 'Cost $'. floatval($form->price); ?></button>	
	        				</div>	        				
	        			</div>
        			</div>
				</div>
				<?php echo ($count == 3 || $count == count(${'application_forms_' . $type_2['id']})) ? '</div>' : ''; ?>
				<?php ($count == 3) ? $count = 1 : $count++; ?>
			<?php } ?>
	<?php } ?>
<?php } ?>



<script src="<?php echo PLUGIN_URL; ?>salvattore/salvattore.min.js"></script>
