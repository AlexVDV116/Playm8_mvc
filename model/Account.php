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
    public ?string $userProfileID;

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

    public function getActive(): bool
    {
        return $this->isActive;
    }

    public function getBetaUser(): bool
    {
        return $this->isBetaUser;
    }

    public function getUserProfileID()
    {
        return $this->userProfileID;
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
