<?php include_once(__DIR__ . '/../header.php'); ?>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12 m8 l4 offset-m2">
					<div class="card grey darken-3">
						<a href="<?php echo $router->pathFor('dtg-druck'); ?>">
							<div class="card-image">
								<img src="https://image.shutterstock.com/z/stock-photo-innovation-shirt-and-textile-printer-machine-380440246.jpg">
								<span class="card-title center">T-Shirts & Mehr</span>
							</div>
						</a>
					</div>
				</div>

				<div class="col s12 m8 l4 offset-m2">
					<div class="card grey darken-3">
						<a href="<?php echo $router->pathFor('3d-druck'); ?>">
							<div class="card-image">
								<img src="https://image.shutterstock.com/z/stock-vector-white-d-printer-with-filament-spool-d-printer-printed-vase-maker-hold-tablet-in-hand-mobile-1029948412.jpg">
								<span class="card-title center">3D - Druck</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
