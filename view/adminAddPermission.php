<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;

// adminEditAccount class that has a form so that an admin can edit a user account

class adminAddPermission extends View
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
                                <h2 style="color:#f8f9fa">Voeg permissie toe</h4>
                                    <p>Voeg hier een nieuwe permissie toe.</p>
                            </div>
                            <div class="card-body bg-light p-4 text-black">

                                <form action="../includes/adminAddPermission.inc.php" method="post" class="needs-validation" novalidate>
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-circle-info fa-lg me-3 fa-fw"></i>
                                                <label for="form_permissionName" class="form-label">Naam:</label>
                                                <input id="form_permissionName" type="text" name="permissionName" class="form-control" required>
                                                <div class="invalid-feedback">
                                                    Dit veld is verplicht.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <i class="fas fa-message fa-lg me-3 fa-fw"></i>
                                                <label for="form_permissionDescription" class="form-label">Beschrijving</label>
                                                <textarea id="form_permissionDescription" type="text" name="permissionDescription" class="form-control" rows="3" required></textarea>
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
new adminAddPermission();
