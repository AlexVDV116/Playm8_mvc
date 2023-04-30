<?php

// Account class with several methods to get it's own attributes

require_once '../framework/Model.php';

class Account extends Model
{

    public string $accountID;
    public string $username;
    public string $email;
    public string $password;
    public bool $isBetaUser;
    public bool $isActive;
    public string $activationCode;
    public string $activationExpiry;
    public ?string $activatedAtt;
    public array $roles;
    public ?string $userProfileID;
    public ?userProfile $userProfile;

    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public function getAccountID(): string
    {
        return $this->accountID;
    }

    public function getName(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getEnabled(): bool
    {
        return $this->isActive;
    }

    public function getBetaUser(): bool
    {
        return $this->isBetaUser;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function addRole(Role $role): void
    {
        array_push($this->roles, $role);
    }

    public function deleteRole(Role $role): void
    {
        unset($this->roles[array_search($role, $this->roles)]);
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

    public function createUserProfile($data)
    {
        $userProfileID = "UP" . substr($this->accountID, 3);
        $this->userProfile = new userProfile($data);
    }

    public function getUserProfileID(): string
    {
        return $this->userProfileID;
    }

    public function getUserProfile(): userProfile
    {
        $userProfileDAO = new userProfileDAO;
        return $userProfileDAO->get($this->userProfileID)
    }

    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    public function getExpiryDate(): string
    {
        return $this->activationExpiry;
    }
}
