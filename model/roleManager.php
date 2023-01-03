<?php

// roleManager class

require_once '../framework/Model.php';

class roleManager
{
    public function giveRole(Account $account, Role $role): void
    {
        $account->addRole($role);
    }

    public function removeRole(Account $account, Role $role): void
    {
        $account->deleteRole($role);
    }

    public function getRoles(Account $account): array
    {
        return $account->getRole();
    }

    public function givePermission(Role $role, Permission $permission): void
    {
        $role->addPermission($permission);
    }

    public function removePermission(Role $role, Permission $permission): void
    {
        $role->deletePermission($permission);
    }

    public function getPermissions(Role $role): array
    {
        return $role->getPermission();
    }

    public function hasPermissions(Account $account, Permission $permission)
    {
        return $account->hasPermission($permission);
    }
}
