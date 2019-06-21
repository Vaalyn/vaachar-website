<?php include_once(__DIR__ . '/../header.php'); ?>
	<main>
		<div class="container">
			<div class="row">
				<div class="col s12 m10 l8 offset-m1 offset-l2">
					<?php if (!empty($flashMessages)) : ?>
						<div class="card grey darken-3">
							<div class="card-content white-text">
								<?php foreach ($flashMessages as $flashTitle => $flashMessageArray) : ?>
									<h3 class="card-title center"><?php echo htmlentities($flashTitle); ?></h3>
									<div class="divider"></div>

									<ul class="center">
										<?php foreach ($flashMessageArray as $flashMessage) : ?>
											<li><?php echo htmlentities($flashMessage); ?></li>
										<?php endforeach; ?>
									</ul>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

					<div class="card grey darken-3">
						<div class="card-content">
							<div class="row">
								<div class="col s12">
									<h3 class="card-title center"><?php echo htmlentities($pageTitle); ?></h3>
									<div class="divider"></div>
								</div>
							</div>

							<form action="api/kontakt" method="post">
								<div class="row">
									<div class="col s12 m6 input-field">
										<input type="email" id="email" name="email" placeholder="Deine E-Mail Adresse" value="<?php echo htmlentities($email); ?>" required>
										<label for="email">E-Mail</label>
									</div>

									<div class="col s12 m6 input-field">
										<input type="text" id="name" name="name" placeholder="Dein Name" value="<?php echo htmlentities($name); ?>" required>
										<label for="name">Name</label>
									</div>
								</div>

								<div class="row">
									<div class="col s12 input-field">
										<textarea id="message" name="message" class="materialize-textarea" required><?php echo htmlentities($message); ?></textarea>
										<label for="message">Deine Nachricht</label>
									</div>
								</div>

								<div class="row">
									<div class="col s12 center input-field">
										<img src="<?php echo $captchaImage; ?>" alt="Captcha Bild" />
									</div>

									<div class="col s12 m8 l6 offset-m2 offset-l3 input-field">
										<input type="text" id="captcha" name="captcha" placeholder="Captcha" required>
										<label for="captcha">Captcha</label>
									</div>
								</div>

								<div class="row">
									<div class="col s12 center">
										<button class="btn color-2 waves-effect waves-light" type="submit" name="action">Nachricht senden
											<i class="material-icons right">send</i>
										</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
