<?php

require_once '../framework/Model.php';


class Account extends Model
{

    public string $account_id = '';
    public string $account_username = '';
    public string $account_email = '';
    public string $account_password = '';
    public ?bool $account_enabled = null;
    public ?bool $acocunt_beta_user = null;
    public array $account_roles = [];
    public ?userProfile $account_userProfile = null;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function createUserProfile($firstName, $lastName, $location, $phoneNumber, $dateOfBirth, $age)
    {
        $userProfileID = "UP" . substr($this->accountID, 3);
        $this->userProfile = new userProfile($userProfileID, $firstName, $lastName, $location, $phoneNumber, $dateOfBirth, $age);
    }

    public function getAccountID(): string
    {
        return $this->account_id;
    }

    public function getName(): string
    {
        return $this->account_username;
    }

    public function getEmail(): string
    {
        return $this->account_email;
    }

    public function getPassword(): string
    {
        return $this->account_password;
    }

    public function getEnabled()
    {
        return $this->account_enabled;
    }

    public function getBetaUser()
    {
        return $this->account_beta_user;
    }

    public function getRoles(): array
    {
        return $this->account_roles;
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
