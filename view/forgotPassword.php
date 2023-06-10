<?php

// Define the namespace of this class
namespace View;

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

// forgotPassword class that has a form that allows the user to reset his password
class forgotPassword extends View
{

    public function show()
    {
        global $translator;
        new header();
?>

        <section>
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card rounded-4">
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <div class="mx-4 mb-5">
                                            <h3 class="text-center mb-2"><?= $translator->__('Wachtwoord vergeten?') ?></h3>
                                            <p><?= $translator->__('Je kunt je wachtwoord opnieuw instellen, voer hiervoor je e-mailadres in en volg de daarna de instructies die je via de e-mail krijgt toegestuurd.') ?></p>
                                        </div>

                                        <form action="../includes/forgotpassword.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label for="form_email" class="form-label"><?= $translator->__('E-mailadres:') ?></label>
                                                    <input id="form_email" type="email" name="email" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        <?= $translator->__('Dit veld is verplicht.') ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                                <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit"><?= $translator->__('Verstuur verzoek') ?></button>
                                            </div>
                                            <?php
                                            if (isset($_GET["error"])) {
                                                if ($_GET["error"] == "emptyinput") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Dit veld is verplicht.</p>';
                                                } elseif ($_GET["error"] == "invalidemail") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist email format.</p>';
                                                } elseif ($_GET["error"] == "accountnotfound") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onbekend e-mailadres.</p>';
                                                } elseif ($_GET["error"] == "accountnotactivated") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Inactief Account. Verifieer uw email-adres.</p>';
                                                }
                                            }

                                            if (isset($_GET["forgot"])) {
                                                if ($_GET["forgot"] == "success") {
                                                    echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i> Controleer uw email voor verdere instructies.</p>';
                                                }
                                            } ?>
                                        </form>
                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="../assets/images/forgotpassword2.jpg" class="form-img img-fluid rounded-4 shadow-sm" alt="Dog image2" loading="lazy">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php
    }
}
new forgotPassword();
// Include the footer
$footer = new footer();
