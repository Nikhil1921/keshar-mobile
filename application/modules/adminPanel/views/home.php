<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<div class="row">
	<?php if(isset($sells)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('sales'),
		'<div class="info-box mb-3">
			<span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Sales</span>
				<span class="info-box-number">'.$sells.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
	<?php if(isset($sell_price)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('sales'),
		'<div class="info-box mb-3">
			<span class="info-box-icon bg-success elevation-1"><i class="fas fa-rupee-sign"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total Sales</span>
				<span class="info-box-number"><i class="fas fa-rupee-sign"></i> '.$sell_price.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
    <?php if(isset($purchases)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('purchases'),
		'<div class="info-box mb-3">
			<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-cart"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total purchases</span>
				<span class="info-box-number">'.$purchases.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
    <?php if(isset($purchase_price)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('purchases'),
		'<div class="info-box mb-3">
			<span class="info-box-icon bg-warning elevation-1"><i class="fas fa-rupee-sign"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total purchases</span>
				<span class="info-box-number"><i class="fas fa-rupee-sign"></i> '.$purchase_price.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
    <?php if(isset($brands)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('brands'),
		'<div class="info-box">
			<span class="info-box-icon bg-info elevation-1"><i class="fas fa-envelope"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total brands</span>
				<span class="info-box-number">'.$brands.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
    <?php if(isset($models)): ?>
	<div class="col-12 col-sm-6 col-md-3">
		<?= anchor(admin('models'),
		'<div class="info-box mb-3">
			<span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>
			<div class="info-box-content">
				<span class="info-box-text">Total models</span>
				<span class="info-box-number">'.$models.'</span>
			</div>
		</div>', 'class="text-dark"') ?>
	</div>
    <?php endif ?>
</div>