<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\roleDAO;

// adminEditAccount class that has a form so that an admin can edit a user account

class adminAddAccount extends View
{

    public function show()
    {
?>

        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-10 col-xl-10">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa">Voeg account toe</h4>
                                    <p>Voeg hier een nieuw account toe</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminAddAccount.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <label for="form_username" class="form-label">Gebruikersnaam</label>
                                                <input id="form_username" type="text" name="username" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <label for="form_email" class="form-label">E-mailadres</label>
                                                <input id="form_email" type="email" name="email" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Voer een geldig e-mailadres in.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_password" class="form-label">Wachtwoord</label>
                                            <input id="form_password" type="password" name="password" class="form-control" placeholder="Voer wachtwoord in">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_passwordrepeat" class="form-label">Herhaal wachtwoord</label>
                                            <input id="form_passwordrepeat" type="password" name="passwordrepeat" class="form-control" placeholder="Herhaal wachtwoord">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-users"></i>
                                            <label class="form-label">Wijs rol(len) toe:</label><br>
                                            <?php
                                            // For each role in the roles table echo a input type checkbox
                                            $roleDAO = new roleDAO();
                                            $roleDAO->startList();

                                            // While we have another object in our query
                                            while ($roleDAO->hasNext()) {
                                                // Fetch the next object and return the current object
                                                $role = $roleDAO->getNext();

                                                // If role is set echo the input checkbox as checked
                                                // Else echo the checkbox without the checked attribute 
                                            ?>
                                                <input type="checkbox" id=<?= "role" . $role->get("roleID") ?> name="selectedRoles[]">
                                                <label for=<?= "role" . $role->get("roleID") ?>><?= $role->get("roleID") . " - " . $role->get("roleName") ?></label><br>

                                            <?php
                                            }
                                            ?>

                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_adminPassword" class="form-label">Administrator wachtwoord</label>
                                            <input id="form_adminPassword" type="password" name="adminPassword" class="form-control" placeholder="Voer administrator wachtwoord in" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="d-flex justify-content-end mt-3">
                                            <a href="../index.php" class="btn btn-cancel shadow-sm mx-3">Annuleer</a>
                                            <button class="btn btn-credits shadow-sm" name="submit" type="submit">Opslaan</button>
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
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Het wachtwoord moet uit ten minste 8 tekens (maximaal 32) en ten minste één cijfer, één letter en één speciaal karakter bestaan.</p>';
                                        }
                                        if ($_GET["error"] == "wrongpassword") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>Onjuist wachtwoord.</p>';
                                        }
                                    }
                                    if (isset($_GET["usernameChange"])) {
                                        if ($_GET["usernameChange"] == "success") {
                                            echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Gebruikersnaam is successvol gewijzigd.</p>';
                                        }
                                    }
                                    if (isset($_GET["emailChange"])) {
                                        if ($_GET["emailChange"] == "success") {
                                            echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> E-mailadres is successvol gewijzigd.</p>';
                                        }
                                    }
                                    if (isset($_GET["passwordChange"])) {
                                        if ($_GET["passwordChange"] == "success") {
                                            echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Wachtwoord is successvol gewijzigd.</p>';
                                        }
                                    }
                                    if (isset($_GET["confirm"])) {
                                        if ($_GET["confirm"] == "fail") {
                                            echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuiste bevestiging, account niet verwijderd.</p>';
                                        }
                                    }
                                    ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
}
new adminAddAccount();
