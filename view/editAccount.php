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
use DAO\accountDAO;
use Controller\translatorController;

// Used to translate the header on this page
$translator = new translatorController;
// Use the getLanguageFile method of the languageSelector and require the correct language file
require $ROOT . $translator->getLanguageFile();

// Check if user is logged in if false redirect to index page else continue
if ($_SESSION["auth"] == false) {
    header("location: ../index.php");
    exit();
};

// editAccount class that has a form where the user can edit its own account details
class editAccount extends View
{

    public function show()
    {
        $ROOT = '../';

        // Used to translate page content
        $translator = new translatorController;
        // Use the getLanguageFile method of the languageSelector and require the correct language file
        require $ROOT . $translator->getLanguageFile();

        $header = new header();

        if ($_SESSION["auth_user"]["accountID"]) {
            $accountEmail = $_SESSION["auth_user"]["email"];
            $accountDAO = new AccountDAO();
            $account = $accountDAO->get($accountEmail);
        }
?>
        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-9 col-xl-7">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa"><?= $translator->__('Wijzig account') ?></h4>
                                    <p><?= $translator->__('Wijzig hier je gebruikersnaam, email en wachtwoord.') ?></p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/editAccount.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <label for="form_newUsername" class="form-label"><?= $translator->__('Gebruikersnaam') ?>:</label>
                                                <input id="form_newUsername" type="text" name="newUsername" class="form-control" value="<?php if (isset($account)) {
                                                                                                                                            echo $account->get("username");
                                                                                                                                        } ?>" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <label for="form_newEmail" class="form-label"><?= $translator->__('E-mailadres') ?>:</label>
                                                <input id="form_newEmail" type="email" name="newEmail" class="form-control" value="<?php if (isset($account)) {
                                                                                                                                        echo $account->get("email");
                                                                                                                                    } ?>" required>
                                                <div class="invalid-feedback">
                                                    Voer een geldig e-mailadres in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_newPassword" class="form-label"><?= $translator->__('Nieuw wachtwoord') ?>:</label>
                                            <input id="form_newPassword" type="password" name="newPassword" class="form-control" placeholder="<?= $translator->__('Voer nieuw wachtwoord in') ?>">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_newPasswordrepeat" class="form-label"><?= $translator->__('Herhaal nieuw wachtwoord') ?>:</label>
                                            <input id="form_newPasswordrepeat" type="password" name="newPasswordrepeat" class="form-control" placeholder="<?= $translator->__('Herhaal nieuw wachtwoord') ?>">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_currentPasswordrepeat" class="form-label"><?= $translator->__('Huidig wachtwoord') ?>:</label>
                                            <input id="form_currentPasswordrepeat" type="password" name="currentPassword" class="form-control" placeholder="<?= $translator->__('Voer huidig wachtwoord in') ?>" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="../index.php" class="btn btn-cancel shadow-sm mx-3"><?= $translator->__('Annuleer') ?></a>
                                            <button class="btn btn-credits shadow-sm" name="submit" type="submit"><?= $translator->__('Opslaan') ?></button>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_GET["error"])) {
                                        if ($_GET["error"] == "emptyinput") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Alle velden zijn verplicht.</p>';
                                        }
                                        if ($_GET["error"] == "invalidemail") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist email format.</p>';
                                        }
                                        if ($_GET["error"] == "emailalreadyexists") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Email bestaat al in ons bestand.</p>';
                                        }
                                        if ($_GET["error"] == "passwordmatch") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Wachtwoorden komen niet overeen.</p>';
                                        }
                                        if ($_GET["error"] == "passwordstrength") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Uw wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.</p>';
                                        }
                                        if ($_GET["error"] == "wrongpassword") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>Onjuist wachtwoord.</p>';
                                        }
                                    }
                                    if (isset($_GET["usernameChange"])) {
                                        if ($_GET["usernameChange"] == "success") {
                                            echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Uw gebruikersnaam is successvol gewijzigd.</p>';
                                        }
                                    }
                                    if (isset($_GET["confirm"])) {
                                        if ($_GET["confirm"] == "fail") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuiste bevestiging, account niet verwijderd.</p>';
                                        }
                                    }
                                    ?>
                                </form>
                                <div class="row mt-5">
                                    <div class="d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                            <?= $translator->__('Verwijder account') ?>
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5"><?= $translator->__('Bevestig verwijderen van account') ?></h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                $randomNumber = rand(10000, 99999);
                                                echo "<div class='d-flex justify-content-center'>";
                                                echo "<h5>" . $randomNumber . "</h5></div>";
                                                $_SESSION["randomNumbers"] = $randomNumber;
                                                ?>
                                                <form action="../includes/deleteAccount.inc.php" method="post" class="needs-validation" novalidate>
                                                    <input id="form_userConfirmNumbers" type="text" name="userConfirmNumbers" class="form-control border-1" placeholder="<?= $translator->__('Voer de 5 cijfers in ter bevestiging') ?>" maxlength="5" required>
                                                    <div class="row">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn btn-cancel shadow-sm mt-3" data-bs-dismiss="modal"><?= $translator->__('Annuleer') ?></button>
                                                            <button type="submit" name="submit" class="btn btn-credits shadow-sm mt-3"><?= $translator->__('Bevestig') ?></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
new editAccount();
// Include the footer
$footer = new footer();
