<?php

require_once 'framework/Model.php';

class Account extends Model
{

    protected $account_id = '';
    protected $account_username = '';
    protected $account_email = '';
    protected $account_password = '';
    protected $account_enabled = '';
    protected $account_roles = [];
    protected $account_userProfile = '';

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

    public function getEnabled(): string
    {
        if ($this->account_enabled === 1) {
            return "Yes";
        } else {
            return "No";
        }
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
