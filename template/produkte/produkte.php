<?php include_once(__DIR__ . '/../header.php'); ?>
	<main>
		<div class="container produkte">
			<div class="row">
				<?php foreach($products as $product) : ?>
					<div class="col s12 m6 l4">
						<div class="card grey darken-3">
							<div class="card-image">
								<img src="<?php echo $product->custom_value1; ?>" alt="T-Shirt - Vintage" class="materialboxed" />
							</div>

							<div class="card-content">
								<div class="row">
									<div class="col s12 center">
										<h5><?php echo htmlentities($product->product_key); ?></h5>
										<div class="divider"></div>
									</div>
								</div>

								<div class="row">
									<div class="col s12 center">
										<h5><?php echo str_replace('.', ',', number_format(($product->cost - 4.5), 2)); ?>&nbsp;€<h5>
									</div>
								</div>

								<div class="row mb-0">
									<div class="col s12 center">
										<a class="btn color-2 waves-effect waves-light modal-trigger" href="#buy-now-modal-<?php echo $product->id; ?>">Bestellen</a>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div id="buy-now-modal-<?php echo $product->id; ?>" class="buy-now-modal modal modal-fixed-footer grey darken-3">
						<form action="api/produkt/kaufen" method="post">
							<input type="hidden" name="product_id" value="<?php echo $product->id; ?>" />

							<div class="modal-content grey darken-3">
								<h4 class="center"><?php echo htmlentities($product->product_key); ?></h4>
								<div class="divider"></div>

								<div class="row">
									<div class="col s12 m6 center">
										<div class="row">
											<div class="col s12 mt-2">
												<h4><?php echo str_replace('.', ',', number_format($product->cost, 2)); ?>&nbsp;€<h4>
												<h6>inkl. 4,50&nbsp;€ Versandkosten</h6>
											</div>

											<div class="col s12 mt-2">
												<small>Keine Mehrwertsteuer, da Kleinunternehmer nach §19 (1) UStG.</small>
											</div>

											<div class="col s10 m12 offset-s1">
												<img src="<?php echo $product->custom_value1; ?>" alt="T-Shirt - Vintage" />
											</div>
										</div>
									</div>

									<div class="col s12 m6">
										<div class="row">
											<div class="input-field col s12">
												<select name="notes" class="browser-default" required>
													<option value="" disabled selected>Größe auswählen</option>
													<option value="S">S</option>
													<option value="M">M</option>
													<option value="L">L</option>
													<option value="XL">XL</option>
													<option value="XXL">XXL</option>
												</select>
											</div>

											<div class="input-field col s12 m6">
												<input type="text" name="first_name" value="" placeholder="Vorname" required />
												<label for="first_name">Vorname:</label>
											</div>

											<div class="input-field col s12 m6">
												<input type="text" name="last_name" value="" placeholder="Nachname" required />
												<label for="last_name">Nachname:</label>
											</div>

											<div class="input-field col s12 m6">
												<input type="email" name="email" value="" placeholder="E-Mail" required />
												<label for="email">E-Mail:</label>
											</div>

											<div class="input-field col s12 m6">
												<input type="text" name="address1" value="" placeholder="Adresse" required />
												<label for="address1">Straße & Nr.:</label>
											</div>

											<div class="input-field col s12 m5">
												<input type="text" name="postal_code" value="" placeholder="PLZ" required />
												<label for="postal_code">PLZ:</label>
											</div>

											<div class="input-field col s12 m7">
												<input type="text" name="city" value="" placeholder="Stadt" required />
												<label for="city">Stadt:</label>
											</div>

											<div class="input-field col s12 mt-0">
												<select name="country_code" class="browser-default" required>
													<option value="DE">Deutschland</option>
												</select>
											</div>

											<div class="col s12">
												<label>
													<input type="checkbox" name="agb_accepted" class="filled-in" required />
													<span>Ich akzeptiere die <a href="agb" target="_blank">Allgemeinen Geschäftsbedingungen</a> und <a href="widerrufsbelehrung" target="_blank">Widerrufsbestimmungen</a> und bestätige diese gelesen zu haben.</span>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="buy-now-loader grey darken-3 p-5 hide">
								<div>
									<div class="row">
										<div class="col s12">
											Bestellung wird bearbeitet
										</div>
									</div>

									<div class="row">
										<div class="col s12 p-3 center">
											<div class="preloader-wrapper big active">
												<div class="spinner-layer spinner-green-only">
													<div class="circle-clipper left">
														<div class="circle"></div>
													</div>
													<div class="gap-patch">
														<div class="circle"></div>
													</div>
													<div class="circle-clipper right">
														<div class="circle"></div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col s12">
											Bitte warte einen Moment
										</div>
									</div>
								</div>
							</div>

							<div class="modal-footer grey darken-3">
								<input type="submit" name="submit" value="Jetzt Kaufen" class="btn color-2 right" />
								<a href="#!" class="modal-close waves-effect waves-red btn color-1 white-text left">Abbrechen</a>
							</div>
						</form>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</main>
<?php include_once(__DIR__ . '/../footer.php'); ?>
