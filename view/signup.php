<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ROOT = '../'; // Setting the ROOT directory for this file so the relative paths used in included pages will still work

header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0 clients (IE6 / pre 1997)
header("Expires: 0"); // HTTP 1.0 Proxies

// If a session variable array exists store the contents in the form_data variable
// So we can retain the form values for better user experience
session_start();
if (isset($_SESSION['signup_form']) && !empty($_SESSION['signup_form'])) {
    $username = $_SESSION['signup_form']['username'];
    $email = $_SESSION['signup_form']['email'];
    unset($_SESSION['your_form']);
}

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

include_once '../header.php';

?>

<section>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card rounded-4">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <h2 class="text-center mb-5">Registreren</h2>

                                <form action="../includes/signup.inc.php" method="post" class="needs-validation mx-1 mx-md-4" novalidate>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input id="username" type="text" name="username" class="form-control" value="<?php if (isset($username)) {
                                                                                                                                echo $username;
                                                                                                                            } ?>" required>
                                            <label for="form_username" class="form-label">Gebruikersnaam</label>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input id="form_email" type="email" name="email" class="form-control" value="<?php if (isset($email)) {
                                                                                                                                echo $email;
                                                                                                                            } ?>" required>
                                            <label for="form_email" class="form-label">E-mailadres</label>
                                            <div class="invalid-feedback">
                                                Voer een geldig e-mailadres in.
                                            </div>
                                        </div>
                                    </div>

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
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input id="form_passwordrepeat" type="password" name="passwordrepeat" class="form-control" required>
                                            <label for="form_passwordrepeat" class="form-label">Herhaal uw wachtwoord</label>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-check d-flex justify-content-center mb-3 form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="privacy-policy" id="privacy-policy" value="agreed" required>
                                        <label class="form-check-label" for="privacy-policy">
                                            Ik ga akkoord met het <a href="./privacy-policy.html" target=”_blank”>privacy beleid</a>.
                                        </label>
                                    </div>

                                    <div class="form-button-row d-flex justify-content-center flex-row mt-3">
                                        <button class="btn btn-credits shadow-sm my-2" type="submit" name="submit">Registreren</button>
                                    </div>
                                    <?php
                                    if (isset($_GET["error"])) {
                                        if ($_GET["error"] == "none") {
                                            echo '<p class="form-success"><i class="fa-regular fa-circle-check"></i> Bedankt voor uw registratie. U kunt nu inloggen.</p>';
                                        }
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
                                    } ?>
                                </form>
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <img src="https://images.unsplash.com/photo-1561037404-61cd46aa615b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2970&q=80" class="form-img img-fluid form-img rounded-4 shadow-sm" alt="Dog image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include_once '../footer.php';
?>