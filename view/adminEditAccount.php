<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\accountDAO;
use DAO\roleDAO;

// adminEditAccount class that has a form so that an admin can edit a user account

class adminEditAccount extends View
{

    public function show()
    {
        $accountDAO = new accountDAO;
        $accountDAO->startList();
        if (isset($_GET['account'])) {
            $accountEmail = $_GET["account"];
        }
        $account = $accountDAO->get($accountEmail);
?>

        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-10 col-xl-10">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa">Wijzig Account</h4>
                                    <p>Wijzig hier je gebruikersnaam, email en wachtwoord.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminEditAccount.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                <label for="form_newUsername" class="form-label">Gebruikersnaam</label>
                                                <input id="form_newUsername" type="text" name="newUsername" class="form-control" value="<?php if (isset($account)) {
                                                                                                                                            echo $account->getUsername();
                                                                                                                                        } ?>" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                <label for="form_newEmail" class="form-label">E-mailadres</label>
                                                <input id="form_newEmail" type="email" name="newEmail" class="form-control" value="<?php if (isset($account)) {
                                                                                                                                        echo $account->getEmail();
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
                                            <label for="form_newPassword" class="form-label">Nieuw wachtwoord</label>
                                            <input id="form_newPassword" type="password" name="newPassword" class="form-control" placeholder="Voer nieuw wachtwoord in">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_newPasswordrepeat" class="form-label">Herhaal nieuw wachtwoord</label>
                                            <input id="form_newPasswordrepeat" type="password" name="newPasswordrepeat" class="form-control" placeholder="Herhaal nieuw wachtwoord">
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-lock"></i>
                                            <label for="form_isActive" class="form-label">Status account:</label><br>
                                            <select id="form_isActive" name="isActive" class="form_control" required>
                                                <option value="1" <?php
                                                                    if ($account->getActive() === true) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>-- Actief --</option>
                                                <option value="0" <?php
                                                                    if ($account->getActive() === false) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>-- Inactief --</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <i class="fa-solid fa-users"></i>
                                            <label class="form-label">Toegewezen rol(len):</label><br>
                                            <?php
                                            // For each role in the roles table echo a input type checkbox
                                            // Check the boxes that the user has a role by setting the echoing the checked attribute
                                            $roleDAO = new roleDAO;
                                            // Get the roles the user has set
                                            $rolesSet = $roleDAO->getRolesbyAccountID($account->getAccountID());
                                            $roleDAO->startList();

                                            // While we have another object in our query
                                            while ($roleDAO->hasNext()) {
                                                // Fetch the next object and return the current object
                                                $role = $roleDAO->getNext();

                                                // If role is set echo the input checkbox as checked
                                                // Else echo the checkbox without the checked attribute 
                                            ?>
                                                <input type="checkbox" id=<?= "role" . $role->getRoleID() ?> name="selectedRoles[]" value="<?= $role->getRoleID() ?>" <?php
                                                                                                                                                                        if (in_array($role->getRoleID(), $rolesSet)) {
                                                                                                                                                                            echo "checked";
                                                                                                                                                                        }
                                                                                                                                                                        ?>>
                                                <label for=<?= "role" . $role->getRoleID() ?>><?= $role->getRoleID() . " - " . $role->getRoleName() ?></label><br>

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
                                            <i class="fa-solid fa-user"></i>
                                            <label for="form_isBeta" class="form-label">Beta user:</label><br>
                                            <select id="form_isBeta" name="isBetaUser" class="form_control" required>
                                                <option value="1" <?php
                                                                    if ($account->getBetaUser() === true) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>-- Ja --</option>
                                                <option value="0" <?php
                                                                    if ($account->getBetaUser() === false) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>>-- Nee --</option>
                                            </select>
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

                                    <!-- Grab the current user email and sent it with the form -->
                                    <input type="hidden" id="form_currentUserEmail" name="currentUserEmail" value="<?php if (isset($account)) {
                                                                                                                        echo $account->getEmail();
                                                                                                                    } ?>" required>

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
                                        if ($_GET["error"] == "none") {
                                            echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i>Wijziging toegepast.</p>';
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
                                <div class="row mt-5">
                                    <div class="d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                                            Verwijder account
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5">Bevestig verwijderen van account</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                echo "<div class='d-flex justify-content-center'>";
                                                echo "<p>Voer wachtwoord in ter bevestiging</p></div>";
                                                ?>
                                                <form action="../includes/adminDeleteAccount.inc.php" method="post" class="needs-validation" novalidate>
                                                    <input type="hidden" id="form_userEmail" name="form_userEmail" value="<?php if (isset($account)) {
                                                                                                                                echo $account->getEmail();
                                                                                                                            } ?>" required>
                                                    <input id="form_adminPassword" type="password" name="form_adminPassword" class="form-control border-1" placeholder="Voer admin wachtwoord in" required>
                                                    <div class="row">
                                                        <div class="d-flex justify-content-end">
                                                            <button type="button" class="btn btn-cancel shadow-sm mt-3" data-bs-dismiss="modal">Annuleer</button>
                                                            <button type="submit" name="submit" class="btn btn-credits shadow-sm mt-3">Bevestig</button>
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
new adminEditAccount;
