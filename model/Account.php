<?php

// Define the namespace of this class
namespace Model;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require '../vendor/autoload.php';

// Import classes this class depends on
use Framework\Model;

// Account class with several methods to get it's own attribute values

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

    public function getUsername(): string
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
