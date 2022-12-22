<?php

class Permission
{
    private string $permissionName;
    private string $permissionDescription;

    public function __construct($permissionName, $permissionDescription)
    {
        $this->permissionName = $permissionName;
        $this->permissionDescription = $permissionDescription;
    }
}
