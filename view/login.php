<?php
// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// Setting the ROOT directory for this file so the relative paths used in included pages will still work
$ROOT = '../';

include_once '../header.php';
require_once 'framework/View.php';

class login extends View
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

                                        <h2 class="text-center mb-5">Inloggen</h2>

                                        <form action="../includes/login.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label for="form_email" class="form-label">E-mailadres</label>
                                                    <input id="form_email" type="email" name="email" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Voer een geldig e-mailadres in.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <label for="form_password" class="form-label">Wachtwoord</label>
                                                    <input id="form_password" type="password" name="password" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Dit veld is verplicht.
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                                <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Inloggen</button>
                                            </div>

                                            <div class="forgotpassword mt-5 d-flex justify-content-center">
                                                <a href="../view/forgotPassword.php">Wachtwoord vergeten?</a>
                                            </div>
                                            <?php
                                            if (isset($_GET["error"])) {
                                                if ($_GET["error"] == "none") {
                                                    echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i> Bedankt voor uw registratie.<br> 
                                                    U dient uw email-adres te verifiëren voordat u kunt inloggen.</p>';
                                                } elseif ($_GET["error"] == "emptyinput") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Alle velden zijn verplicht.</p>';
                                                } elseif ($_GET["error"] == "invalidemail") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist email format.</p>';
                                                } elseif ($_GET["error"] == "accountnotfound") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onbekend e-mailadres.</p>';
                                                } elseif ($_GET["error"] == "wrongpassword") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist wachtwoord.</p>';
                                                } elseif ($_GET["error"] == "accountnotactivated") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Inactief Account. Verifieer uw email-adres.</p>';
                                                }
                                            }

                                            if (isset($_GET["activation"])) {
                                                if ($_GET["activation"] == "success") {
                                                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Uw account is successvol geactiveerd.<br> U kunt nu inloggen. </p>';
                                                }
                                            }

                                            if (isset($_GET["reset"])) {
                                                if ($_GET["reset"] == "success") {
                                                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Uw wachtwoord is successvol gereset.<br> U kunt nu inloggen. </p>';
                                                }
                                            }
                                            if (isset($_GET["passwordChange"])) {
                                                if ($_GET["passwordChange"] == "success") {
                                                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Uw wachtwoord is successvol gewijzigd.<br> U kunt nu inloggen met het nieuwe wachtwoord. </p>';
                                                }
                                            }
                                            if (isset($_GET["emailChange"])) {
                                                if ($_GET["emailChange"] == "success") {
                                                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Uw e-mailadres is successvol gewijzigd.<br> U dient uw email-adres te verifiëren voordat u kunt inloggen. </p>';
                                                }
                                            }
                                            ?>
                                        </form>
                                    </div>
                                    <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="../assets/images/login.png" class="form-img img-fluid rounded-4 shadow-sm" alt="Dog image">
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
new login;
include_once '../footer.php';
