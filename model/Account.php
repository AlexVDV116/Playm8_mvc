<?php

require_once 'model/userProfile.php';
require_once 'model/Role.php';
require_once 'model/Permission.php';

class Account
{

    private string $accountID;
    private string $email;
    private string $password;
    private bool $enabled;
    private bool $isLoggedIn;
    private array $roles;
    private userProfile $userProfile;

    function __construct($email, $password, $enabled, $isLoggedIn)
    {
        $this->accountID = uniqid("AID");
        $this->email = $email;
        $this->password = $password;
        $this->enabled = $enabled;
        $this->roles = array();
        $this->isLoggedIn = $isLoggedIn;
    }

    public function createUserProfile($firstName, $location, $phoneNumber, $dateOfBirth)
    {
        $userProfileID = "UP" . substr($this->accountID, 3);
        $this->userProfile = new userProfile($userProfileID, $firstName, $location, $phoneNumber, $dateOfBirth);
    }

    public function getAccountID(): string
    {
        return $this->accountID;
    }

    public function logIn(): void
    {
        $this->isLoggedIn = true;
    }

    public function logOut(): void
    {
        $this->isLoggedIn = false;
    }

    public function addRole(Role $role): void
    {
        array_push($this->roles, $role);
    }

    public function deleteRole(Role $role): void
    {
        unset($this->roles[array_search($role, $this->roles)]);
    }

    public function getRole(): array
    {
        return $this->roles;
    }

    public function hasPermission(Permission $permission): bool
    {
        foreach ($this->roles as $role) {
            if ($role->hasPermission($permission)) {
                return true;
            }
        }
        return false;
    }
}
