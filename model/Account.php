<?php
class Account
{

    private string $accountID;
    private string $account_username;
    private string $email;
    private string $password;
    private bool $enabled;
    private array $roles;
    private userProfile $userProfile;

    public function __construct($account_username, $email, $password, $enabled)
    {
        $this->accountID = uniqid("AID");
        $this->account_username = $account_username;
        $this->email = $email;
        $this->password = $password;
        $this->enabled = $enabled;
        $this->roles = array();
    }

    public function createUserProfile($firstName, $lastName, $location, $phoneNumber, $dateOfBirth, $age)
    {
        $userProfileID = "UP" . substr($this->accountID, 3);
        $this->userProfile = new userProfile($userProfileID, $firstName, $lastName, $location, $phoneNumber, $dateOfBirth, $age);
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
