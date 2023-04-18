<?php
$ROOT = '../'; // Setting the ROOT directory for this file so the relative paths used in included pages will still work

ini_set('display_errors', 1);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0 clients (IE6 / pre 1997)
header("Expires: 0"); // HTTP 1.0 Proxies

// If a session variable array exists store the contents in the form_data variable
// So we can retain the form values for better user experience
if (isset($_SESSION['contact_form']) && !empty($_SESSION['contact_form'])) {
	$form_data = $_SESSION['contact_form'];
	unset($_SESSION['contact_form']);
}

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

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
							<form action="../includes/contactform.inc.php" method="post" class="needs-validation" novalidate>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_name">Voornaam:</label>
											<input id="form_name" type="text" name="name" class="form-control border-0" placeholder="Voer uw voornaam in" value="<?php if (isset($form_data)) {
																																										echo $form_data['name'];
																																									} ?>" required>
											<div class="invalid-feedback">
												Dit veld is verplicht.
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="form_lastname">Achternaam:</label>
											<input id="form_lastname" type="text" name="lastname" class="form-control border-0" placeholder="Voer uw achternaam in" value="<?php if (isset($form_data)) {
																																												echo $form_data['lastname'];
																																											} ?>" required>
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
											<input id="form_email" type="email" name="email" class="form-control border-0" placeholder="Voer uw e-mailadres in" value="<?php if (isset($form_data)) {
																																											echo $form_data['email'];
																																										} ?>" required>
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
												<option value="Suggestie / Feedback" <?php echo (isset($form_data) && $form_data['need'] == 'Suggestie / Feedback') ? 'selected' : ''; ?>>Suggestie / Feedback</option>
												<option value="Klacht" <?php echo (isset($form_data) && $form_data['need'] == 'Klacht') ? 'selected' : ''; ?>>Klacht</option>
												<option value="Vraag over de applicatie" <?php echo (isset($form_data) && $form_data['need'] == 'Vraag over de applicatie') ? 'selected' : ''; ?>>Vraag over de applicatie</option>
												<option value="Overig" <?php echo (isset($form_data) && $form_data['need'] == 'Overif') ? 'selected' : ''; ?>>Overig</option>
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
											<textarea id="form_message" name="message" class="form-control border-0" placeholder="Schrijf hier uw bericht. (20 -500 karakters)" rows="4" required><?php if (isset($form_data)) {
																																																		echo $form_data['message'];
																																																	} ?></textarea>
											<div class="invalid-feedback">
												Dit veld is verplicht. (20 - 500 karakters)
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
										<button class="btn btn-credits shadow-sm my-2" name="submit" type="submit">Verzenden</button>
									</div>
									<?php
									if (isset($_GET["error"])) {
										if ($_GET["error"] == "none") {
											echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i> Bedankt voor je contactopname. Wij behandelen je bericht zo snel mogelijk. </p>';
											$form_data = null;
										}
										if ($_GET["error"] == "emptyinput") {
											echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Alle velden zijn verplicht.</p>';
										}
										if ($_GET["error"] == "invalidemail") {
											echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist email format.</p>';
										}
										if ($_GET["error"] == "messagelength") {
											echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Uw bericht moet tussen de 20 - 500 karakters bevatten.</p>';
										}
									} ?>
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