<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use DAO\permissionDAO;
use DAO\accountDAO;

// Controller class that handes the update of the role 
// Connects to the database trough an instance of the roleDAO class

class permissionController extends Controller
{
    private ?int $permissionID;
    private ?string $permissionName;
    private ?string $permissionDescription;

    public function __construct($permissionID = NULL, $permissionName = NULL, $permissionDescription = NULL)
    {
        $this->permissionID = $permissionID;
        $this->permissionName = $permissionName;
        $this->permissionDescription = $permissionDescription;
    }

    public function run(): void
    {
        // Get the permission object from the DB
        $permissionDAO = new permissionDAO;
        $permission = $permissionDAO->get($this->permissionID);

        // Update the permission object with the new values
        $permission->permissionName = $this->permissionName;
        $permission->permissionDescription = $this->permissionDescription;

        // Update the database with the updated role object
        $permissionDAO->update($permission);

        header("location: ../view/admin.php?view=adminEditPermission&permissionID=" . $this->permissionID . "&error=none");
        exit();
    }

    public function adminDeletePermission($permissionID, $adminEmail, $adminPassword): void
    {
        // Grab the admin account from the DB
        $accountDAO = new AccountDAO;
        $adminAccount = $accountDAO->get($adminEmail);

        // Grab the role from the DB
        $permissionDAO = new permissionDAO;
        $permission = $permissionDAO->get($permissionID);

        // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($adminPassword, $adminAccount->getPassword());

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/admin.php?view=adminEditPermission&permissionID=" . $permission->getPermissionID() . "&error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $permissionDAO->delete($permissionID);
            // Redirect user to admin page with success message
            header("location: ../view/admin.php?view=listRolesPermissions&deletePermission=success");
        }
    }
}
