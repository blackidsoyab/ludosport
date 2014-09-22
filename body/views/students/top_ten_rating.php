<?php $session = $this->session->userdata('user_session'); ?>
<script type="text/javascript">
    $(document).ready(function(){
        if ($('#store-item-carousel-1').length > 0){
            $("#store-item-carousel-1").owlCarousel({
                autoPlay: 2000,
                items : 4,
                lazyLoad : true,
                autoHeight : true,
                stopOnHover : true
            });
        }
    });
</script>
<h1 class="page-heading h1"><?php echo $this->lang->line('top_10_rating'); ?></h1>

<div class="the-box">
	<div class="row">
		<div class="col-sm-6">
			<div class="panel with-nav-tabs panel-warning">
				<div class="panel-heading">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-xp" data-toggle="tab"><?php echo $this->lang->line('xpr'); ?></a></li>
						<li><a href="#tab-war" data-toggle="tab"><?php echo $this->lang->line('war'); ?></a></li>
						<li><a href="#tab-style" data-toggle="tab"><?php echo $this->lang->line('sty'); ?></a></li>

					</ul>
				</div>
				<div class="collapse in">
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-xp">
								<?php if($top_ten_xpr != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th width="55%"><?php echo $this->lang->line('name'); ?></th>
												<th width="15%"><?php echo $this->lang->line('score'); ?></th>
												<th width="15%"><?php echo $this->lang->line('academy'); ?></th>
												<th width="15%"><?php echo $this->lang->line('school'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_xpr as $xpr) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($xpr->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$xpr->xpr,', WAR:',$xpr->war,', STY:',$xpr->sty; ?>"><?php echo $xpr->total_score; ?></span></td>
												<td><?php echo @$xpr->academy; ?></td>
												<td><?php echo @$xpr->school; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>

							<div class="tab-pane fade" id="tab-war">
								<?php if($top_ten_war != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th width="55%"><?php echo $this->lang->line('name'); ?></th>
												<th width="15%"><?php echo $this->lang->line('score'); ?></th>
												<th width="15%"><?php echo $this->lang->line('academy'); ?></th>
												<th width="15%"><?php echo $this->lang->line('school'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_war as $war) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($war->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$war->xpr,', WAR:',$war->war,', STY:',$war->sty; ?>"><?php echo $war->total_score; ?></span></td>
												<td><?php echo @$war->academy; ?></td>
												<td><?php echo @$war->school; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>

							<div class="tab-pane fade" id="tab-style">
								<?php if($top_ten_sty != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th width="55%"><?php echo $this->lang->line('name'); ?></th>
												<th width="15%"><?php echo $this->lang->line('score'); ?></th>
												<th width="15%"><?php echo $this->lang->line('academy'); ?></th>
												<th width="15%"><?php echo $this->lang->line('school'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_sty as $sty) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($sty->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$sty->xpr,', WAR:',$sty->war,', STY:',$sty->sty; ?>"><?php echo $sty->total_score; ?></span></td>
												<td><?php echo @$sty->academy; ?></td>
												<td><?php echo @$sty->school; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="panel-footer"><?php echo $this->lang->line('see_all'); ?></div>
				</div>
			</div>
		</div>

		<div class="col-sm-6">
			<div class="panel with-nav-tabs panel-warning">
				<div class="panel-heading">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab-my-academy" data-toggle="tab"><?php echo $this->lang->line('my_academy'); ?></a></li>
						<li><a href="#tab-my-school" data-toggle="tab"><?php echo $this->lang->line('my_school'); ?></a></li>
						<li><a href="#tab-my-clan" data-toggle="tab"><?php echo $this->lang->line('my_clan'); ?></a></li>

					</ul>
				</div>
				<div class="collapse in">
					<div class="panel-body">
						<div class="tab-content">
							<div class="tab-pane fade in active" id="tab-my-academy">
								<?php if($top_ten_academy != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th width="15%"><?php echo $this->lang->line('score'); ?></th>
												<th width="15%"><?php echo $this->lang->line('school'); ?></th>
												<th width="15%"><?php echo $this->lang->line('clan'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_academy as $academy) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($academy->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$academy->xpr,', WAR:',$academy->war,', STY:',$academy->sty; ?>"><?php echo $academy->total_score; ?></span></td>
												<td><?php echo @$academy->school; ?></td>
												<td><?php echo @$academy->clan; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>

							<div class="tab-pane fade" id="tab-my-school">
								<?php if($top_ten_school != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th width="20%"><?php echo $this->lang->line('score'); ?></th>
												<th width="20%"><?php echo $this->lang->line('clan'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_school as $school) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($school->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$school->xpr,', WAR:',$school->war,', STY:',$school->sty; ?>"><?php echo $school->total_score; ?></span></td>
												<td><?php echo @$school->clan; ?></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>

							<div class="tab-pane fade" id="tab-my-clan">
								<?php if($top_ten_clan != false) { ?>
									<table class="table table-th-block margin-bottom-killer">
										<thead>
											<tr>
												<th width="5%"><?php echo $this->lang->line('no'); ?></th>
												<th><?php echo $this->lang->line('name'); ?></th>
												<th width="15%"><?php echo $this->lang->line('score'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php 
												$count = 0;
												foreach ($top_ten_clan as $clan) {
											?>
											<tr>
												<td><?php echo ++$count; ?></td>
												<td><?php echo ucwords($clan->name); ?></td>
												<td><span  data-toggle="tooltip" data-original-title="<?php echo 'XPR:',$clan->xpr,', WAR:',$clan->war,', STY:',$clan->sty; ?>"><?php echo $clan->total_score; ?></span></td>
											</tr>
											<?php } ?>
										</tbody>
									</table>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="panel-footer"><?php echo $this->lang->line('see_all'); ?></div>
				</div>
			</div>
		</div>
	
		<?php if($top_ten_users != false){ ?>
            <div class="col-lg-12">
                <div class="the-box no-border">
                    <h4 class="small-heading more-margin-bottom text-black text-center"><?php echo $this->lang->line('the_best'),' ',count($top_ten_users)?></h4>
                    <div id="store-item-carousel-1" class="owl-carousel shop-carousel owl-theme">
                    <?php 
                        $count = 0;
                        foreach ($top_ten_users as $ten_users) { 
                    ?>
                        <div class="item">
                            <div class="media">
                                <a class="pull-left" href="#fakelink">
                                    <img class="lazyOwl media-object sm img-circle" src="<?php echo IMG_URL . 'user_avtar/100X100/' . $ten_users->avtar; ?>" alt="Image">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading nowrap overflow-hidden overflow-text-dot">
                                        <a href="<?php echo base_url() .'profile/view/' . $ten_users->id; ?>" data-toggle="tooltip" data-original-title="<?php echo $ten_users->name; ?>"><?php echo $ten_users->name; ?></a>
                                    </h4>
                                    <p class="price text-danger"><strong><?php echo ++$count; ?></strong></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
    	<?php } ?>
   	</div>
</div>