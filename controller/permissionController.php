<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use Model\Permission;
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
        return;
    }

    public function adminAddPermission($adminEmail, $adminPassword): void
    {
        // Grab the admin account from the DB
        $accountDAO = new AccountDAO();
        $adminAccount = $accountDAO->get($adminEmail);

        // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($adminPassword, $adminAccount->get("password"));

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/admin.php?view=adminAddPermission&error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Create a new permission object with the permissionName and permissionDescription
            $permission = new Permission();
            $permissionDAO = new permissionDAO();

            $permission->permissionID = $permissionDAO->getHighestPermissionID() + 1;
            $permission->permissionName = $this->permissionName;
            $permission->permissionDescription = $this->permissionDescription;

            // Insert this permission into the DB
            $permissionDAO->insertNewPermission($permission);

            // Redirect user to admin page with success message
            header("location: ../view/admin.php?view=listRolesPermissions&addPermission=success");
        }
    }

    public function adminEditPermission($permissionID, $adminEmail, $adminPassword): void
    {
        // Grab the admin account from the DB
        $accountDAO = new AccountDAO();
        $adminAccount = $accountDAO->get($adminEmail);

        // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($adminPassword, $adminAccount->get("password"));

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/admin.php?view=adminEditPermission&permissionID=" . $permissionID . "&error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            // Get the permission object from the DB
            $permissionDAO = new permissionDAO();
            $permission = $permissionDAO->get($this->permissionID);

            // Update the permission object with the new values
            $permission->permissionName = $this->permissionName;
            $permission->permissionDescription = $this->permissionDescription;

            // Update the database with the updated role object
            $permissionDAO->update($permission);

            header("location: ../view/admin.php?view=listRolesPermissions&editPermission=success");
            exit();
        }
    }

    public function adminDeletePermission($permissionID, $adminEmail, $adminPassword): void
    {
        // Grab the admin account from the DB
        $accountDAO = new AccountDAO();
        $adminAccount = $accountDAO->get($adminEmail);

        // Grab the permission from the DB
        $permissionDAO = new permissionDAO();
        $permission = $permissionDAO->get($permissionID);

        // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($adminPassword, $adminAccount->get("password"));

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/admin.php?view=adminEditPermission&permissionID=" . $permission->get("permissionID") . "&error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $permissionDAO->delete($permissionID);
            // Redirect user to admin page with success message
            header("location: ../view/admin.php?view=listRolesPermissions&deletePermission=success");
        }
    }
}
