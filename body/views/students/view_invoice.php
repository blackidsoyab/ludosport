<h1 class="page-heading"><?php echo $this->lang->line('invoice'); ?></h1>

<div class="the-box full invoice">
	<div class="the-box no-border bg-dark" style="vertical-align: text-middle;">
		<div class="row">
			<div class="col-sm-6">
				<img src="<?php echo IMG_URL . $this->config->item('main_logo'); ?>" alt="<?php echo $this->config->item('app_name'); ?>" class="logo-invoice">
			</div>
		</div>
	</div>
	<div class="the-box no-border padding-bottom-killer">
		<div class="row">
			<div class="col-sm-6">
				<h1><?php echo $this->lang->line('invoice'); ?></h1>
			</div>

			<div class="col-sm-6 text-right">
				<p><?php echo  ucwords($this->lang->line('date')) ,': ', date('j<\s\u\p>S</\s\u\p> F Y', strtotime($payment_details->timestamp)); ?></p>
			</div>
		</div>
		
		<div class="table-responsive">
			<table class="table table-th-block table-striped table-dark">
				<thead>
					<tr>
						<th><?php echo $this->lang->line('description'); ?></th>
						<th style="width: 100px;"><?php echo $this->lang->line('amount'); ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<p><strong><?php echo getClanName($payment_details->description); ?></strong></p>
						</td>
						<td class="text-right"><strong><i class="fa fa-dollar"></i>&nbsp;<?php echo $payment_details->amount; ?></strong></td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="success">
						<td class="text-right"><?php echo $this->lang->line('total'); ?></td>
						<td class="text-right"><strong><i class="fa fa-dollar"></i>&nbsp;<?php echo $payment_details->amount; ?></strong></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>