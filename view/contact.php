<?php
$ROOT = '../'; // Setting the ROOT directory so the relative path in the included header.php will still work
include_once '../header.php';
?>

<section>
	<div class="container">
		<div class=" text-center mt-2 ">
			<h1>Contactformulier</h1>
		</div>

		<div class="row mt-3">
			<div class="col-lg-7 mx-auto">
				<div class="card mt-2 mx-auto p-4 bg-light">
					<div class="card-body bg-light">

						<div class="container">
							<form class="needs-validation" novalidate>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_name">Voornaam:</label>
											<input id="form_name" type="text" name="naam" class="form-control border-0" placeholder="Voer uw voornaam in" required>
											<div class="invalid-feedback">
												Dit veld is verplicht.
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_lastname">Achternaam:</label>
											<input id="form_lastname" type="text" name="surname" class="form-control border-0" placeholder="Voer uw achternaam in" required>
											<div class="invalid-feedback">
												Dit veld is verplicht.
											</div>
										</div>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_email">E-mailadres:</label>
											<input id="form_email" type="email" name="email" class="form-control border-0" placeholder="Voer uw e-mailadres in" required>
											<div class="invalid-feedback">
												Voer een geldig email-adress in.
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_need">Onderwerp:</label>
											<select id="form_need" name="need" class="form-control border-0" required>
												<option value="" selected disabled>-- Kies een onderwerp --</option>
												<option>Suggestie / Feedback</option>
												<option>Klacht</option>
												<option>Vraag over de applicatie</option>
												<option>Overig</option>
											</select>
											<div class="invalid-feedback">
												Kies een onderwerp.
											</div>
										</div>
									</div>
								</div>

								<div class="row mt-3">
									<div class="col-md-12">
										<div class="form-group">
											<label for="form_message">Bericht:</label>
											<textarea id="form_message" name="message" class="form-control border-0" placeholder="Schrijf hier uw bericht..." rows="4" required></textarea>
											<div class="invalid-feedback">
												Dit veld is verplicht.
											</div>
										</div>
									</div>

									<div class="form-check form-switch mt-4">
										<input class="form-check-input" type="checkbox" role="switch" name="privacy-policy" id="privacy-policy" value="agreed" required>
										<label class="form-check-label" for="privacy-policy">
											Ik ga akkoord met het <a href="./privacy-policy.php" target=”_blank”>privacy
												beleid</a>.
										</label>
										<div class="invalid-feedback">
											U dient akkoord te gaan met ons privacy beleid.
										</div>
									</div>

									<div class="form-button-row d-flex flex-row mt-3">
										<button class="btn btn-credits shadow-sm my-2" type="submit">Verzenden</button>
									</div>
								</div>

							</form>
						</div>

					</div>
				</div>
			</div>
		</div>
</section>

<?php
include_once '../footer.php';
?>