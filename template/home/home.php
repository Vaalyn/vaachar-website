<?php include_once(__DIR__ . '/../header.php'); ?>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12">
					<h3 class="center">Dein Partner für alles rund um</h3>
				</div>
			</div>

			<div class="row">
				<div class="col s12 m10 l6 offset-m1">
					<div class="card grey darken-3 hoverable">
						<a href="<?php echo $router->pathFor('dtg-druck'); ?>">
							<div class="card-image">
								<img src="image/dtg/header.jpg">
								<span class="card-title">T-Shirts & Textildruck</span>
							</div>
						</a>
					</div>
				</div>

				<div class="col s12 m10 l6 offset-m1">
					<div class="card grey darken-3 hoverable">
						<a href="<?php echo $router->pathFor('3d-druck'); ?>">
							<div class="card-image">
								<img src="image/3d-druck/header.jpg">
								<span class="card-title">3D - Druck</span>
							</div>
						</a>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col s12 flow-text center mt-4">
					Wir freuen uns darauf von dir zu hören!
				</div>
			</div>
		</div>
	</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
