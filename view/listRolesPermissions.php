<?php

// Define the namespace of this class
namespace View;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\View;
use DAO\roleDAO;
use DAO\permissionDAO;

// listRolesPermissions class that lists all roles in the roles table and all permissions from the permissions table 
// and allows the administrator to edit them

class listRolesPermissions extends View
{

    public function show()
    {
        $roleDAO = new roleDAO;
        $roleDAO->startList();

        if (isset($_GET["addRole"])) {
            if ($_GET["addRole"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Rol succesvol toegevoegd.</p>';
            }
        }
        if (isset($_GET["editRole"])) {
            if ($_GET["editRole"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Rol succesvol gewijzigd.</p>';
            }
        }
        if (isset($_GET["deleteRole"])) {
            if ($_GET["deleteRole"] == "success") {
                echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Rol succesvol verwijderd.</p>';
            }
        }
?>
        <div class="class-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Rol ID</th>
                        <th>Rol naam</th>
                        <th>Rol beschrijving</th>
                        <th>Permissies</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Save all records to a recordArray

                    $recordArray = [];
                    while ($roleDAO->hasNext()) {
                        $record = $roleDAO->getNext();
                        $recordArray[] = $record;
                    }

                    // Now that we have all records saved in an array we close the connection
                    $roleDAO->closeConnection();

                    // So we can execute another query and get the permissions belonging to this role
                    foreach ($recordArray as $record) {
                        $permission =  $roleDAO->getRolePermissions($record->getRoleID());
                    ?>
                        <tr onclick="">
                            <!-- PHP shorthand to echo the data in the table -->
                            <td><?= $record->getRoleID()  ?></td>
                            <td><?= $record->getRoleName() ?></td>
                            <td><?= $record->getRoleDescription() ?></td>
                            <td><?= implode(", ", $permission); ?></td>
                            <td><?= "<a href ='../view/admin.php?view=adminEditRole&roleID=" . $record->getRoleID() . "'>Wijzig" ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="5"><a href="../view/admin.php?view=adminAddRole" class="no-underline"><i class="fa-solid fa-plus"></i> Voeg een rol toe</a></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php
        $roleDAO->closeConnection();
        $permissionDAO = new permissionDAO;
        $permissionDAO->startList();
        ?>

        <div class="class-responsive mt-5">
            <?php
            if (isset($_GET["addPermission"])) {
                if ($_GET["addPermission"] == "success") {
                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Permissie succesvol toegevoegd.</p>';
                }
            }
            if (isset($_GET["editPermission"])) {
                if ($_GET["editPermission"] == "success") {
                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Permissie succesvol gewijzigd.</p>';
                }
            }
            if (isset($_GET["deletePermission"])) {
                if ($_GET["deletePermission"] == "success") {
                    echo '<p class="form-success"><i class="fa-solid fa-circle-exclamation"></i> Permissie succesvol verwijderd.</p>';
                }
            }
            ?>
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Permissie ID</th>
                        <th>Permissie naam</th>
                        <th>Permissie beschrijving</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // While we have another object in our query
                    while ($permissionDAO->hasNext()) {
                        // Fetch the next object and return the current object
                        $permission = $permissionDAO->getNext();
                    ?>
                        <tr onclick="">
                            <!-- PHP shorthand to echo the data in the table -->
                            <td><?= "# " . $permission->getPermissionID() ?></td>
                            <td><?= $permission->getPermissionName() ?></td>
                            <td><?= $permission->getPermissionDescription() ?></td>
                            <td><?= "<a href ='../view/admin.php?view=adminEditPermission&permissionID=" . $permission->getPermissionID() . "'>Wijzig" ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="4"><a href="../view/admin.php?view=adminAddPermission" class="no-underline"><i class="fa-solid fa-plus"></i> Voeg een permissie toe</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
<?php
    }
}
new listRolesPermissions;
