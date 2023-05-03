<?php

ini_set('display_errors', 1);

// Data Abstraction Object for an UserProfile object
// Can access the database create, read, update, or delete data (CRUD)

require_once '../framework/DAO.php';
require_once '../model/userProfile.php';

class userProfileDAO extends DAO
{

    private static $select = 'SELECT * FROM `userProfiles`';

    public function __construct()
    {
        parent::__construct('userProfile');
    }

    // Returns a new userProfile object if no email provided
    // Else select all records from userProfile table where the userProfileID matches the given userProfileID
    // Returns an instance of the userProfile model with the property names set to the data from the selected record
    public function get(?string $userProfileID): userProfile
    {
        if (empty($userProfileID)) {
            return new userProfile;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `userProfiles`.`userProfileID` = ?';
            return $this->getObjectSql($sql, [$userProfileID]);
        }
    }

    public function updateUserProfileInfo(userProfile $userProfile): void
    {
        $stmt = $this->prepare('CALL updateUserProfile(?, ?, ?, ?, ?, ?, ?, ? ,?, ?);');
        $stmt->execute([
            $userProfile->getUserProfileID(),
            $userProfile->getFirstName(),
            $userProfile->getLastName(),
            $userProfile->getCity(),
            $userProfile->getCountry(),
            $userProfile->getPhoneNumber(),
            $userProfile->getDateOfBirth(),
            $userProfile->getAge(),
            $userProfile->getAboutMeTitle(),
            $userProfile->getAboutMeText()
        ]);
        $stmt->closeCursor();
    }

    public function setUserProfileInfo(userProfile $userProfile): void
    {
        $stmt = $this->prepare('CALL insertNewUserProfile(?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?);');

        $stmt->execute([
            $userProfile->getAccountID(),
            $userProfile->getUserProfileID(),
            $userProfile->getFirstName(),
            $userProfile->getLastName(),
            $userProfile->getCity(),
            $userProfile->getCountry(),
            $userProfile->getPhoneNumber(),
            $userProfile->getDateOfBirth(),
            $userProfile->getAge(),
            $userProfile->getAboutMeTitle(),
            $userProfile->getAboutMeText()
        ]);
        $stmt->closeCursor();
    }

    public function checkRecordExists($userProfileID): bool
    {
        $stmt = $this->prepare('SELECT * FROM `UserProfiles` WHERE `userProfileID` = ?');
        $stmt->execute([$userProfileID]);
        $result = $stmt->fetch();
        $stmt->closeCursor();

        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }
}
