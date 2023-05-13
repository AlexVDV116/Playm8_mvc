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
        $roleDAO = new roleDAO;
        if (isset($_GET['roleID'])) {
            $roleID = $_GET["roleID"];
        }
        $role = $roleDAO->get($roleID);
?>

        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-10 col-xl-10">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa">Wijzig Rol</h4>
                                    <p>Wijzig hier de naam of beschrijving van een rol.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminEditRole.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-circle-info fa-lg me-3 fa-fw"></i>
                                                <label for="form_roleName" class="form-label">Naam:</label>
                                                <input id="form_roleName" type="text" name="roleName" class="form-control" value="<?php if (isset($role)) {
                                                                                                                                        echo $role->getRoleName();
                                                                                                                                    } ?>" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-message fa-lg me-3 fa-fw"></i>
                                                <label for="form_roleDescription" class="form-label">Beschrijving</label>
                                                <input id="form_roleDescription" type="text" name="roleDescription" class="form-control" value="<?php if (isset($role)) {
                                                                                                                                                    echo $role->getRoleDescription();
                                                                                                                                                } ?>" required>
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
                                            // Check the boxes that the user has a role by setting the echoing the checked attribute
                                            $permissionDAO = new permissionDAO;
                                            // Get the roles the user has set
                                            $permissionsSet = $permissionDAO->getPermissionsbyRoleID($role->getRoleID());
                                            $permissionDAO->startList();

                                            // While we have another object in our query
                                            while ($permissionDAO->hasNext()) {
                                                // Fetch the next object and return the current object
                                                $permission = $permissionDAO->getNext();

                                                // If role is set echo the input checkbox as checked
                                                // Else echo the checkbox without the checked attribute 
                                            ?>
                                                <input type="checkbox" id=<?= "permission" . $permission->getPermissionID() ?> name="selectedPermissions[]" value="<?= $permission->getPermissionID() ?>" <?php
                                                                                                                                                                                                            if (in_array($permission->getPermissionID(), $permissionsSet)) {
                                                                                                                                                                                                                echo "checked";
                                                                                                                                                                                                            }
                                                                                                                                                                                                            ?>>
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

                                            <input type="hidden" id="form_roleID" name="roleID" value="<?php if (isset($role)) {
                                                                                                            echo $role->getRoleID();
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
                                                if ($_GET["error"] == "wrongpassword") {
                                                    echo '<p class="form-error"><i class="fa-solid fa-circle-exclamation"></i>Onjuist wachtwoord.</p>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </form>

                                <div class="row mt-2">
                                    <div class="d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#deleteRoleModal">
                                            Verwijder Rol
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5">Bevestig verwijderen van rol</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                echo "<div class='d-flex justify-content-center'>";
                                                echo "<p>Voer wachtwoord in ter bevestiging</p></div>";
                                                ?>
                                                <form action="../includes/adminDeleteRole.inc.php" method="post" class="needs-validation" novalidate>
                                                    <input type="hidden" id="form_roleID" name="roleID" value="<?php if (isset($role)) {
                                                                                                                    echo $role->getRoleID();
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
new adminEditRole;
