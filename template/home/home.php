<?php include_once(__DIR__ . '/../header.php'); ?>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12 m8 l6 offset-m2">
					<div class="card grey darken-3">
						<a href="<?php echo $router->pathFor('dtg-druck'); ?>">
							<div class="card-image">
								<img src="image/3d-druck/header.jpeg">
								<span class="card-title center">T-Shirts & Mehr</span>
							</div>
						</a>
					</div>
				</div>

				<div class="col s12 m8 l6 offset-m2">
					<div class="card grey darken-3">
						<a href="<?php echo $router->pathFor('3d-druck'); ?>">
							<div class="card-image">
								<img src="image/3d-druck/header.jpeg">
								<span class="card-title center">3D - Druck</span>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
