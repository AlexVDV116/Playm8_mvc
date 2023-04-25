<?php

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

include_once '../header.php';
require_once 'framework/View.php';

class forgotPassword extends View
{

    public function show()
    {
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
                                            <h3 class="text-center mb-2">Wachtwoord vergeten?</h3>
                                            <p>Je kunt je wachtwoord opnieuw instellen, voer hiervoor je e-mailadres in en volg de daarna de instructies die je via de e-mail krijgt toegestuurd.</p>
                                        </div>

                                        <form action="../includes/forgotpassword.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input id="form_email" type="email" name="email" class="form-control" required>
                                                    <label for="form_email" class="form-label">E-mailadres</label>
                                                    <div class="invalid-feedback">
                                                        Dit veld is verplicht.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                                <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Verstuur</button>
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
new forgotPassword;
include_once '../footer.php';
