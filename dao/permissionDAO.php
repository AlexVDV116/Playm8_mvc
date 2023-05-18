<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\DAO;
use Model\Permission;

ini_set('display_errors', 1);

// Data Abstraction Object for a Permission object
// Can access the database create, read, update, or delete data (CRUD) on the permissions table

class permissionDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('Model\Permission');
    }

    // Select all permissions from accounts table and order them by accountID
    public function startList(): void
    {
        $sql = 'CALL getAllPermissionsOrderByPermissionID();';
        $this->startListSql($sql);
    }

    // Get permission object by permissionID
    public function get(int $permissionID): Permission
    {
        $sql = 'SELECT * FROM permissions WHERE permissions.permissionID = ?';
        return $this->getObjectSql($sql, [$permissionID]);
    }

    // Select all records from the rolesPermissions table and order them by permissionID
    public function getPermissionsbyRoleID(int $roleID): array
    {
        $stmt = $this->prepare('CALL getPermissionsbyRoleID(?);');
        $stmt->execute([$roleID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        $roles = array_column($result, '0');

        return $roles;
    }

    // Deletes all permissions from rolesPermissions table with a specific role ID
    public function deleteAllPermissionsFromRole($roleID)
    {
        $stmt = $this->prepare('CALL deleteAllPermissionsFromRole(?);');
        $stmt->execute([$roleID]);
        $stmt->closeCursor();
    }

    // Deletes a the record from the permissions table where the permissionID matches
    public function delete(string $permissionID): void
    {
        $sql = 'CALL deletePermission(?);';
        $args = [
            $permissionID
        ];
        $this->execute($sql, $args);
    }

    // Set permissions for Role in rolesPermissions table 
    public function insertPermissionsForRole(int $roleID, int $permissionID)
    {
        $stmt = $this->prepare('CALL insertPermissionsForRole(?, ?);');
        $stmt->execute([$roleID, $permissionID]);
        $stmt->closeCursor();
    }

    // Updates the record in the permission table with the data from the permission object
    public function update(Permission $permission): void
    {
        $sql = 'CALL updatePermission(?, ?, ?);';
        $args = [
            $permission->get("permissionName"),
            $permission->get("permissionDescription"),
            $permission->get("permissionID")
        ];
        $this->execute($sql, $args);
    }

    // Insert new permission object 
    public function insertNewPermission(Permission $permission): void
    {
        $stmt = $this->prepare('CALL insertNewPermission(?, ?, ?);');
        $stmt->execute([
            $permission->get("permissionID"),
            $permission->get("permissionName"),
            $permission->get("permissionDescription")
        ]);
        $stmt->closeCursor();
    }

    // Get the highest permissionID from the permissionID collum
    public function getHighestPermissionID(): int
    {
        $stmt = $this->prepare('CALL getHighestPermissionID();');
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result[0];
    }
}
