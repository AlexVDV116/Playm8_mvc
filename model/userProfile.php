<?php

class userProfile {
    private string $userProfileID;
    private string $firstName;
    private string $location;
    private string $phoneNumber;
    private string $dateOfBirth;

    public function __construct($userProfileID, $firstName, $location, $phoneNumber, $dateOfBirth) 
    {
        $this->userProfileID = $userProfileID;
        $this->firstName = $firstName;
        $this->location = $location;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
    }
}
