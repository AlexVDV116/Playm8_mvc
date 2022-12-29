<?php

class Role
{
    private string $roleName;
    private string $roleDescription;
    private array $permissions;

    public function __construct($roleName, $roleDescription)
    {
        $this->roleName = $roleName;
        $this->roleDescription = $roleDescription;
        $this->permissions = array();
    }

    public function __toString(): string
    {
        return $this->roleName;
    }

    public function addPermission(Permission $permission): void
    {
        $this->permissions[] = $permission;
    }

    public function deletePermission(Permission $permission): void
    {
        unset($this->permissions[array_search($permission, $this->permissions)]);
    }

    public function getPermission(): array
    {
        return $this->permissions;
    }

    public function hasPermission(Permission $permission): bool
    {
        return in_array($permission, $this->permissions);
    }
}
