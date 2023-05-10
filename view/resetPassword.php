<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

// Include the header
include_once '../header.php';

// resetPassword class that handles the reset password process
// Contains a form where the user can reset his password

class resetPassword extends View
{

    public function show()
    {

        if ((isset($_GET['selector'])) && (isset($_GET['validator']))) {

            // Grabbing the data
            $selector = $_GET['selector'];
            $validator = $_GET['validator'];

            // Check if the selector and validator contain values, else redirect user to this page with an error message
            // If they are not empty check if all of the characters in the provided variables are hexadecimal 'digits'
            if (empty($selector) || empty($validator)) {
                header("location: ../view/resetPassword.php?reset=fail");
            } else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false) {


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
                                                        <h3 class="text-center mb-2">Reset wachtwoord</h3>
                                                        <p>Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.</p>
                                                    </div>

                                                    <form action="../includes/resetPassword.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>
                                                        <input type="hidden" name="selector" value="<?= $selector ?>">
                                                        <input type="hidden" name="validator" value="<?= $validator ?>">

                                                        <div class="d-flex flex-row align-items-center mb-4">
                                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input id="form_password" type="password" name="password" class="form-control" required>
                                                                <label for="form_password" class="form-label">Wachtwoord</label>
                                                                <div class="invalid-feedback">
                                                                    Dit veld is verplicht.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row align-items-center mb-4">
                                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input id="form_passwordrepeat" type="password" name="passwordrepeat" class="form-control" required>
                                                                <label for="form_passwordrepeat" class="form-label">Herhaal wachtwoord</label>
                                                                <div class="invalid-feedback">
                                                                    Dit veld is verplicht.
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                                            <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Reset wachtwoord</button>
                                                        </div>
                                                        <?php
                                                        if (isset($_GET["error"])) {
                                                            if ($_GET["error"] == "emptyinput") {
                                                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Alle velden zijn verplicht.</p>';
                                                            }
                                                            if ($_GET["error"] == "passwordmatch") {
                                                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Wachtwoorden komen niet overeen.</p>';
                                                            }
                                                            if ($_GET["error"] == "passwordstrength") {
                                                                echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.</p>';
                                                            }
                                                        }

                                                        if (isset($_GET["reset"])) {
                                                            if ($_GET["reset"] == "success") {
                                                                echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i> Controleer uw email voor verdere instructies.</p>';
                                                            } elseif ($_GET["reset"] == "fail") {
                                                                echo '<p class="form-error"><i class="fa-regular fa-circle-check"></i> We kunnen jouw verzoek niet valideren. Probeer opnieuw of neem contact met ons op.</p>';
                                                            }
                                                        }
                                                        ?>
                                                    </form>
                                                </div>
                                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                                    <img src="../assets/images/forgotpassword2.jpg" class="form-img img-fluid rounded-4 shadow-sm" alt="Dog image2">
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
        }
    }
}
new resetPassword;
include_once '../footer.php';
