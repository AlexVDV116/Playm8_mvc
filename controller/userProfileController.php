<?php

// Controller class for the userProfile that handles user input
// Connects to the database trough an instance of the userProfileDAO class

require_once '../framework/Controller.php';
require_once '../dao/userProfileDAO.php';
require_once '../model/userProfile.php';

class userProfileController extends Controller
{
    private string $accountID;
    private string $userProfileID;
    private string $firstName;
    private string $lastName;
    private string $city;
    private string $country;
    private string $phoneNumber;
    private string $dateOfBirth;
    private string $age;
    private string $aboutMeTitle;
    private string $aboutMeText;

    public function __construct($accountID, $userProfileID, $firstName, $lastName, $city, $country, $phoneNumber, $dateOfBirth, $aboutMeTitle, $aboutMeText)
    {
        $this->accountID = $accountID;
        $this->userProfileID = $userProfileID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->city = $city;
        $this->country = $country;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
        $this->aboutMeTitle = $aboutMeTitle;
        $this->aboutMeText = $aboutMeText;
    }

    public function run(): void
    {
        if ($this->hasEmptyInput() == true) {
            // echo "Alle velden zijn verplicht.";
            header("location: ../view/editUserProfile.php?error=emptyinput");
            exit();
        }
        if ($this->calculateAge($this->dateOfBirth) < 18) {
            // echo "Je moet ouder dan 18 jaar zijn om een profiel aan te kunnen maken.";
            header("location: ../view/editUserProfile.php?error=notoflegalage");
            exit();
        }
        if ($this->getMessageLength($this->aboutMeTitle) < 1 || $this->getMessageLength($this->aboutMeTitle) > 250) {
            // echo "Uw bericht moet tussen de 1 tot 250 karakters bevatten!";
            header("location: ../view/editUserProfile.php?error=titlelength");
            exit();
        }
        if ($this->getMessageLength($this->aboutMeText) < 20 || $this->getMessageLength($this->aboutMeText) > 250) {
            // echo "Uw bericht moet tussen de 20 tot 250 karakters bevatten!";
            header("location: ../view/editUserProfile.php?error=textlength");
            exit();
        }

        // Assocaitive array containing the userProfile data
        $data = array(
            "accountID" => $this->accountID,
            "userProfileID" => $this->userProfileID,
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "city" => $this->city,
            "country" => $this->country,
            "phoneNumber" => $this->phoneNumber,

            // Reformat date of birth to match SQL date format YYYY-mm-dd
            "dateOfBirth" => date("Y-m-d", strtotime($this->dateOfBirth)),
            "age" => $this->calculateAge($this->dateOfBirth),
            "aboutMeTitle" => $this->aboutMeTitle,
            "aboutMeText" => $this->aboutMeText
        );

        $userProfile = new userProfile($data);
        $userProfileDAO = new userProfileDAO;

        if ($userProfileDAO->checkRecordExists($this->userProfileID) == true) {
            $userProfileDAO->updateUserProfileInfo($userProfile);
        } else {
            $userProfileDAO->setUserProfileInfo($userProfile);
        };

        // Redirect user back to his profile page
        header("location: ../view/userProfilePage.php");
        exit();
    }

    // Method that checks if for any empty inputs: returns true if empty inputs found
    private function hasEmptyInput(): bool
    {
        $result = null;
        if (empty($this->aboutMeTitle) || empty($this->aboutMeText)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function calculateAge($dateOfBirth): string
    {
        $today = date("Y-m-d");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));
        return $diff->format('%y');
    }

    // Method that uses the strlen() method to return the bytes in a string (including whitespace and special characters)
    private function getMessageLength($message): int
    {
        return strlen($message);
    }
}
