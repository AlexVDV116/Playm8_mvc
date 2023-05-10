<?php

// Define the namespace of this class
namespace Controller;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Controller;
use DAO\permissionDAO;
use DAO\roleDAO;
use DAO\accountDAO;

// Controller class that handes the update of the role 
// Connects to the database trough an instance of the roleDAO class

class roleController extends Controller
{
    private ?int $roleID;
    private ?string $roleName;
    private ?string $roleDescription;
    private ?array $selectedPermissions;

    public function __construct($roleID = NULL, $roleName = NULL, $roleDescription = NULL, $selectedPermissions = NULL)
    {
        $this->roleID = $roleID;
        $this->roleName = $roleName;
        $this->roleDescription = $roleDescription;
        $this->selectedPermissions = $selectedPermissions;
    }

    public function run(): void
    {
        // Get the role object from the DB
        $roleDAO = new roleDAO;
        $role = $roleDAO->get($this->roleID);

        // Update the role object with the new values
        $role->roleName = $this->roleName;
        $role->roleDescription = $this->roleDescription;

        // Update the database with the updated role object
        $roleDAO->update($role);

        // Remove all previous set permissions
        $permissionDAO = new permissionDAO;
        $permissionDAO->deletePermissionsFromRole($this->roleID);

        // For each checked permission insert this permission into the rolesPermissions table for this role
        foreach ($this->selectedPermissions as $permission) {
            $permissionDAO->insertPermissionsForRole($this->roleID, $permission);
        }

        header("location: ../view/admin.php?view=adminEditRole&roleID=" . $this->roleID . "&error=none");
        exit();
    }

    public function adminDeleteRole($roleID, $adminEmail, $adminPassword): void
    {
        // Grab the admin account from the DB
        $accountDAO = new AccountDAO;
        $adminAccount = $accountDAO->get($adminEmail);

        // Grab the role from the DB
        $roleDAO = new roleDAO;
        $role = $roleDAO->get($roleID);

        // use PHP built in method to check if the given admin password matches the hashed password stored in the DB (returns bool)
        $checkPwd = password_verify($adminPassword, $adminAccount->getPassword());

        // If the password match
        if ($checkPwd == false) {
            // echo "Onjuist wachtwoord.";
            header("location: ../view/admin.php?view=adminEditRole&roleID=" . $role->getRoleID() . "&error=wrongpassword");
            exit();
        } elseif ($checkPwd == true) {
            $roleDAO->delete($roleID);
            // Redirect user to admin page with success message
            header("location: ../view/admin.php?view=listRolesPermissions&deleteRole=success");
        }
    }
}