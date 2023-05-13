<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\permissionDAO;
use DAO\roleDAO;

// adminEditAccount class that has a form so that an admin can edit a user account

class adminEditRole extends View
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
                                <h2 style="color:#f8f9fa">Voeg rol toe</h4>
                                    <p>Voeg hier een nieuwe rol toe.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminAddRole.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-circle-info fa-lg me-3 fa-fw"></i>
                                                <label for="form_roleName" class="form-label">Naam:</label>
                                                <input id="form_roleName" type="text" name="roleName" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-message fa-lg me-3 fa-fw"></i>
                                                <label for="form_roleDescription" class="form-label">Beschrijving</label>
                                                <input id="form_roleDescription" type="text" name="roleDescription" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <i class="fa-solid fa-list"></i>
                                            <label class="form-label">Toegewezen permissies:</label><br>
                                            <?php
                                            // For each role in the roles table echo a input type checkbox
                                            $permissionDAO = new permissionDAO;
                                            $permissionDAO->startList();

                                            // While we have another object in our query
                                            while ($permissionDAO->hasNext()) {
                                                // Fetch the next object and return the current object
                                                $permission = $permissionDAO->getNext();

                                                // If role is set echo the input checkbox as checked
                                                // Else echo the checkbox without the checked attribute 
                                            ?>
                                                <input type="checkbox" id=<?= "permission" . $permission->getPermissionID() ?> name="selectedPermissions[]" value="<?= $permission->getPermissionID() ?>">
                                                <label for=<?= "role" . $permission->getPermissionID() ?>><?= $permission->getPermissionID() . " - " . $permission->getPermissionDescription() ?></label><br>

                                            <?php
                                            }
                                            ?>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
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
                                                if ($_GET["error"] == "wrongpassword") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i> Onjuist wachtwoord.</p>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
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
new adminEditRole;
