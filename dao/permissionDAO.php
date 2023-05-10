<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

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
    public function get($permissionID): Permission
    {
        $sql = 'SELECT * FROM permissions WHERE permissions.permissionID = ?';
        return $this->getObjectSql($sql, [$permissionID]);
    }

    // Select all records from the rolesPermissions table and order them by permissionID
    public function getPermissionsbyRoleID($roleID): array
    {
        $stmt = $this->prepare('CALL getPermissionsbyRoleID(?);');
        $stmt->execute([$roleID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        $roles = array_column($result, '0');

        return $roles;
    }

    // Deletes permissions from rolesPermissions table 
    public function deletePermissionsFromRole($roleID)
    {
        $stmt = $this->prepare('CALL deletePermissionsFromRole(?);');
        $stmt->execute([$roleID]);
        $stmt->closeCursor();
    }

    // Deletes a the record from the permissions table where the permissionID matches
    // Prepared statement that uses a stored procedure
    public function delete(string $permissionID): void
    {
        $sql = 'CALL deletePermission(?);';
        $args = [
            $permissionID
        ];
        $this->execute($sql, $args);
    }

    // Set permissions for Role in rolesPermissions table 
    public function insertPermissionsForRole($roleID, $permissionID)
    {
        $stmt = $this->prepare('CALL insertPermissionsForRole(?, ?);');
        $stmt->execute([$roleID, $permissionID]);
        $stmt->closeCursor();
    }

    // Updates the record in the permission table with the data from the permission object
    // Prepared statement that uses a stored procedure
    public function update(Permission $permission): void
    {
        $sql = 'CALL updatePermission(?, ?, ?);';
        $args = [
            $permission->getPermissionName(),
            $permission->getPermissionDescription(),
            $permission->getPermissionID()
        ];
        $this->execute($sql, $args);
    }
}
