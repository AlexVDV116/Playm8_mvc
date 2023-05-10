<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\permissionDAO;

// adminEditAccount class that has a form so that an admin can edit a user account

class adminEditPermission extends View
{

    public function show()
    {
        $permissionDAO = new permissionDAO;
        if (isset($_GET['permissionID'])) {
            $permissionID = $_GET["permissionID"];
        }
        $permission = $permissionDAO->get($permissionID);
?>

        <div class="container py-5">
            <div class="row">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col col-lg-10 col-xl-10">

                        <div class="card shadow">
                            <div class="rounded-top text-white d-flex flex-column align-items-center justify-content-center banner-top">
                                <h2 style="color:#f8f9fa">Wijzig Permissie</h4>
                                    <p>Wijzig hier de naam of beschrijving van een permissie.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminEditPermission.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-circle-info fa-lg me-3 fa-fw"></i>
                                                <label for="form_permissionName" class="form-label">Naam:</label>
                                                <input id="form_permissionName" type="text" name="permissionName" class="form-control" value="<?php if (isset($permission)) {
                                                                                                                                                    echo $permission->getPermissionName();
                                                                                                                                                } ?>" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-message fa-lg me-3 fa-fw"></i>
                                                <label for="form_permissionDescription" class="form-label">Beschrijving</label>
                                                <textarea id="form_permissionDescription" type="text" name="permissionDescription" class="form-control" rows="3" required><?php if (isset($permission)) {
                                                                                                                                                                                echo $permission->getPermissionDescription();
                                                                                                                                                                            } ?></textarea>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                            <label for="form_adminPassword" class="form-label">Administrator wachtwoord</label>
                                            <input id="form_adminPassword" type="password" name="adminPassword" class="form-control" placeholder="Voer huidig wachtwoord in" required>
                                            <div class="invalid-feedback">
                                                Dit veld is verplicht.
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" id="form_permissionID" name="permissionID" value="<?php if (isset($permission)) {
                                                                                                                echo $permission->getPermissionID();
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
                                    }
                                    ?>
                                </form>


                                <div class="row mt-2">
                                    <div class="d-flex justify-content-start">
                                        <!-- Button trigger modal -->
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#deletePermissionModal">
                                            Verwijder Permissie
                                        </a>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="deletePermissionModal" tabindex="-1" aria-labelledby="deletePermissionModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fs-5">Bevestig verwijderen van permissie</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                echo "<div class='d-flex justify-content-center'>";
                                                echo "<p>Voer wachtwoord in ter bevestiging</p></div>";
                                                ?>
                                                <form action="../includes/adminDeletePermission.inc.php" method="post" class="needs-validation" novalidate>
                                                    <input type="hidden" id="form_permissionID" name="permissionID" value="<?php if (isset($permission)) {
                                                                                                                                echo $permission->getPermissionID();
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
new adminEditPermission;
