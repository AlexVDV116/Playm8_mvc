<?php

// Define the namespace of this class
namespace View;

/* Echo errors for development purposes */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once $ROOT . 'vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use View\header;
use Controller\translatorController;

// Used to translate the header on this page
$translator = new translatorController;
// Use the getLanguageFile method of the languageSelector and require the correct language file
require $ROOT . $translator->getLanguageFile();

// Contact class that contains the contact form
class contact extends View
{

	public function show()
	{
		global $translator;
		new header();

		// If a session variable array exists store the contents in the form_data variable
		// So we can retain the form values for better user experience
		if (isset($_SESSION['contact_form']) && !empty($_SESSION['contact_form'])) {
			$form_data = $_SESSION['contact_form'];
			unset($_SESSION['contact_form']);
		}

?>

		<section>
			<div class="container">
				<div class=" text-center mt-2 ">
					<h1><?= $translator->__('Contactformulier') ?></h1>
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
													<label for="form_name"><?= $translator->__('Voornaam') ?>:</label>
													<input id="form_name" type="text" name="name" class="form-control border-0" placeholder="<?= $translator->__('Voer uw voornaam in') ?>" value="<?php if (isset($form_data)) {
																																																		echo $form_data['name'];
																																																	} ?>" required>
													<div class="invalid-feedback">
														<?= $translator->__('Dit veld is verplicht') ?>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="form_lastname"><?= $translator->__('Achternaam') ?>:</label>
													<input id="form_lastname" type="text" name="lastname" class="form-control border-0" placeholder="<?= $translator->__('Voer uw achternaam in') ?>" value="<?php if (isset($form_data)) {
																																																					echo $form_data['lastname'];
																																																				} ?>" required>
													<div class="invalid-feedback">
														<?= $translator->__('Dit veld is verplicht') ?>
													</div>
												</div>
											</div>
										</div>

										<div class="row mt-3">
											<div class="col-md-6">
												<div class="form-group">
													<label for="form_email"><?= $translator->__('E-mailadres') ?>:</label>
													<input id="form_email" type="email" name="email" class="form-control border-0" placeholder="<?= $translator->__('Voer uw e-mailadres in') ?>" value="<?php if (isset($form_data)) {
																																																				echo $form_data['email'];
																																																			} ?>" required>
													<div class="invalid-feedback">
														<?= $translator->__('Voer een geldig e-mailadres in') ?>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="form_need"><?= $translator->__('Onderwerp') ?>:</label>
													<select id="form_need" name="need" class="form-control border-0" required>
														<option value="" selected disabled>-- <?= $translator->__('Kies een onderwerp') ?> --</option>
														<option value="Suggestie / Feedback" <?php echo (isset($form_data) && $form_data['need'] == 'Suggestie / Feedback') ? 'selected' : ''; ?>><?= $translator->__('Suggestie / Feedback') ?></option>
														<option value="Klacht" <?php echo (isset($form_data) && $form_data['need'] == 'Klacht') ? 'selected' : ''; ?>><?= $translator->__('Klacht') ?></option>
														<option value="Vraag over de applicatie" <?php echo (isset($form_data) && $form_data['need'] == 'Vraag over de applicatie') ? 'selected' : ''; ?>><?= $translator->__('Vraag over de applicatie') ?></option>
														<option value="Overig" <?php echo (isset($form_data) && $form_data['need'] == 'Overig') ? 'selected' : ''; ?>><?= $translator->__('Overig') ?></option>
													</select>
													<div class="invalid-feedback">
														<?= $translator->__('Kies een onderwerp') ?>
													</div>
												</div>
											</div>
										</div>

										<div class="row mt-3">
											<div class="col-md-12">
												<div class="form-group">
													<label for="form_message"><?= $translator->__('Bericht') ?>:</label>
													<textarea id="form_message" name="message" class="form-control border-0" placeholder="<?= $translator->__('Schrijf hier uw bericht. (20 - 500 karakters)') ?>" rows="4" required><?php if (isset($form_data)) {
																																																											echo $form_data['message'];
																																																										} ?></textarea>
													<div class="invalid-feedback">
														<?= $translator->__('Dit veld is verplicht. (20 - 500 karakters)') ?>
													</div>
												</div>
											</div>

											<div class="form-check form-switch mt-4">
												<input class="form-check-input" type="checkbox" role="switch" name="privacy-policy" id="privacy-policy" value="agreed" required>
												<label class="form-check-label" for="privacy-policy">
													<?= $translator->__('Ik ga akkoord met het ') ?> <a href="./privacyPolicy.php" target=”_blank”><?= $translator->__('privacy beleid.') ?></a>

												</label>
												<div class="invalid-feedback">
													<?= $translator->__('U dient akkoord te gaan met ons privacy beleid.') ?>
												</div>
											</div>

											<div class="form-button-row d-flex flex-row mt-3">
												<button class="btn btn-credits shadow-sm my-2" name="submit" type="submit"><?= $translator->__('Verzenden') ?></button>
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
	}
}
new contact();
// Include the footer
$footer = new footer();
