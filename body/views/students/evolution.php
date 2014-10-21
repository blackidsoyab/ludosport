<?php $session = $this->session->userdata('user_session'); ?>
<h1 class="page-heading h1"><?php
echo $this->lang->line('evolution'); ?></h1>

<?php
	if(isset($evolution_categories) && count($evolution_categories) > 0) {
		foreach ($evolution_categories as $categories) {
?>
		<div class="the-box">
			<div class="featured-post-wide">
				<img src="<?php echo IMG_URL . 'evolution_images/'. $categories->image; ?>" class="img-responsive" alt="Image">
				<div class="featured-text relative-left">
					<h3><a href="#"><?php echo $categories->{$session->language.'_name'}; ?></a></h3>
					<p><?php echo @$categories->description; ?></p>
				</div>
			</div>

			<?php if(isset($evolution_levels) && count($evolution_levels) > 0) { ?>
				<div class="panel panel-warning">
					<div class="panel-heading">
						<h3 class="panel-title">
							<a class="block-collapse" data-toggle="collapse" href="#panel-collapse-6">
								Course Levels
								<span class="right-content">
									<span class="right-icon"><i class="glyphicon glyphicon-minus icon-collapse"></i></span>
								</span>
							</a>
						</h3>
					</div>

					<div id="panel-collapse-6" class="collapse in" style="height: auto;">
						<div class="panel-body">
							<ul>
								<?php foreach ($evolution_levels as $levels) { ?>
									<li><?php echo $levels->{$session->language.'_name'}; ?></li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
<?php
		} 
	}
?>