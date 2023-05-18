<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\DAO;
use Model\Role;

ini_set('display_errors', 1);

// Data Abstraction Object for a Role object
// Can access the database create, read, update, or delete data (CRUD) on the roles table

require_once '../framework/DAO.php';
require_once '../model/Role.php';

class roleDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('Model\Role');
    }

    // Select all records from accounts table and order them by accountID
    public function startList(): void
    {
        $sql = 'CALL getAllRolesOrderByRoleID();';
        $this->startListSql($sql);
    }

    // Get role object by roleID
    public function get($roleID): Role
    {
        $sql = 'SELECT * FROM roles WHERE roles.roleID = ?';
        return $this->getObjectSql($sql, [$roleID]);
    }

    // Select all records from accounts table and order them by accountID
    public function getRolesbyAccountID($accountID): array
    {
        $stmt = $this->prepare('CALL getRolesbyAccountID(?);');
        $stmt->execute([$accountID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        $roles = array_column($result, '0');

        return $roles;
    }

    // Select all permissions belonging to a role
    public function getRolePermissions($roleID): array
    {
        $stmt = $this->prepare('CALL getRolePermissions(?);');
        $stmt->execute([$roleID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        $permissions = array_column($result, '0');

        return $permissions;
    }

    // Get role name belonging to role ID
    public function getRoleName($roleID)
    {
        $stmt = $this->prepare('CALL getRoleName(?);');
        $stmt->execute([$roleID]);
        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result[0];
    }

    // Updates the record in the roles table with the data from the role object
    // Prepared statement that uses a stored procedure
    public function update(Role $role): void
    {
        $sql = 'CALL updateRole(?, ?, ?);';
        $args = [
            $role->get("roleName"),
            $role->get("roleDescription"),
            $role->get("roleID")
        ];
        $this->execute($sql, $args);
    }

    // Deletes roles from accountRoles table 
    public function deleteRolesFromAccount($accountID): void
    {
        $stmt = $this->prepare('CALL deleteRolesFromAccount(?);');
        $stmt->execute([$accountID]);
        $stmt->closeCursor();
    }

    // Deletes a the record from the roles table where the roleID matches
    // Prepared statement that uses a stored procedure
    public function delete(string $roleID): void
    {
        $sql = 'CALL deleteRole(?);';
        $args = [
            $roleID
        ];
        $this->execute($sql, $args);
    }

    // Set roles for Account in accountRoles table 
    public function insertRolesForAccount($accountID, $roleID): void
    {
        $stmt = $this->prepare('CALL insertRolesForAccount(?, ?);');
        $stmt->execute([$accountID, $roleID]);
        $stmt->closeCursor();
    }

    // Insert new role object 
    public function insertNewRole($role): void
    {
        $stmt = $this->prepare('CALL insertNewRole(?, ?, ?);');
        $stmt->execute([
            $role->get("roleID"),
            $role->get("roleName"),
            $role->get("roleDescription")
        ]);
        $stmt->closeCursor();
    }

    // Get the highest roleID from the roleID collum
    public function getHighestRoleID(): int
    {
        $stmt = $this->prepare('CALL getHighestRoleID();');
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();

        return $result[0];
    }
}
