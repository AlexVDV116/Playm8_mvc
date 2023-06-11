<?php

// Define the namespace of this class
namespace DAO;

// Include the autoload.php file composer automatically generates specifying PSR-4 autoload information set in composer.json
require_once '../vendor/autoload.php';

// Import classes this class depends on
use Framework\DAO;
use Model\userProfile;

ini_set('display_errors', 1);

// Data Abstraction Object for an UserProfile object
// Can access the database create, read, update, or delete data (CRUD) on the userProfiles table

class userProfileDAO extends DAO
{

    private static $select = 'SELECT * FROM `userProfiles`';

    public function __construct()
    {
        parent::__construct('Model\userProfile');
    }

    // Returns a new userProfile object if no email provided
    // Else select all records from userProfile table where the userProfileID matches the given userProfileID
    // Returns an instance of the userProfile model with the property names set to the data from the selected record
    public function get(?string $userProfileID): userProfile
    {
        if (empty($userProfileID)) {
            return new userProfile();
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
            $userProfile->get("userProfileID"),
            $userProfile->get("firstName"),
            $userProfile->get("lastName"),
            $userProfile->get("city"),
            $userProfile->get("country"),
            $userProfile->get("phoneNumber"),
            $userProfile->get("dateOfBirth"),
            $userProfile->get("age"),
            $userProfile->get("aboutMeTitle"),
            $userProfile->get("aboutMeText")
        ]);
        $stmt->closeCursor();
    }

    public function setUserProfileInfo(userProfile $userProfile): void
    {
        $stmt = $this->prepare('CALL insertNewUserProfile(?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?, ?);');

        $stmt->execute([
            $userProfile->get("accountID"),
            $userProfile->get("userProfileID"),
            $userProfile->get("firstName"),
            $userProfile->get("lastName"),
            $userProfile->get("city"),
            $userProfile->get("country"),
            $userProfile->get("phoneNumber"),
            $userProfile->get("dateOfBirth"),
            $userProfile->get("age"),
            $userProfile->get("aboutMeTitle"),
            $userProfile->get("aboutMeText"),
            "default"
        ]);
        $stmt->closeCursor();
    }

    public function checkRecordExists(string $userProfileID): bool
    {
        $stmt = $this->prepare('SELECT * FROM `userProfiles` WHERE `userProfileID` = ?');
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

    public function updateUserProfilePicture(string $fileNameNew, string $userProfileID): void
    {
        $stmt = $this->prepare('CALL updateUserProfilePicture(?, ?);');
        $stmt->execute([$fileNameNew, $userProfileID]);
        $stmt->closeCursor();
    }

    // Deletes a the record from the userProfiles table where the userProfileID matches
    // Prepared statement that uses a stored procedure
    public function deleteUserProfile(string $userProfileID): void
    {
        $sql = 'CALL deleteUserProfile(?);';
        $args = [
            $userProfileID
        ];
        $this->execute($sql, $args);
    }

    // Function that gets all values from the userProfileID collumn in the userProfiles table
    public function getAllUserProfileIDs(): array
    {
        $stmt = $this->prepare('CALL getAllUserProfileIDs();');
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // Function that gets a random user
    public function getRandomuserProfileID($myUserProfileID): mixed
    {
        // Use the getAllUserProfileIDs method to get a result set from the db containing all userProfileID's
        $resultSet = $this->getAllUserProfileIDs();

        // Use the array_column method to return the values from the userProfileID key in the result set
        $allUserProfileIDs = array_column($resultSet, 0);

        // Create a new empty currentProfile array which contains the current profile
        $currentProfile = [];

        // Randomize the order of the allUserProfileIDs array
        shuffle($allUserProfileIDs);

        // Remove the userProfileID of the current user from the allUserProfileIDs array
        if (($key = array_search($myUserProfileID, $allUserProfileIDs)) !== false) {
            unset($allUserProfileIDs[$key]);
        }

        // Get the userProfiles the current user has already likes
        $resultSet2 = $this->getLikes($myUserProfileID);

        // Use the array_column method to return the values from the userProfileID key in the result set
        $likedUserProfiles = array_column($resultSet2, 0);

        // Remove the already liked userProfiles from the allUserProfileIDs array
        foreach ($likedUserProfiles as $likedUserProfile) {
            if (($key = array_search($likedUserProfile, $allUserProfileIDs)) !== false) {
                unset($allUserProfileIDs[$key]);
            }
        }

        // Check if there are any userProfiles left in the allUserProfileIDs array
        if (count($allUserProfileIDs) === 0) {
            return false;
        } else {


            // Pop the last item of the allUserProfileIDs array and push it to the currentProfile array
            array_push($currentProfile, array_pop($allUserProfileIDs));

            // Get the userProfileID from the currentProfile array and get the UserProfile
            $userProfile = $this->get($currentProfile[0]);

            // Remove the userProfileID from the currentProfile array
            array_pop($currentProfile);

            // Return the userprofile
            return $userProfile;
        }
    }

    // Function that adds a record to the likes table with the userProfileIDs of the liker and liked
    public function addLike($liker, $liked): void
    {
        $stmt = $this->prepare('CALL addLike(?, ?);');
        $stmt->execute([$liker, $liked]);
        $stmt->closeCursor();
    }

    public function getLikes($userProfileID): array
    {
        $stmt = $this->prepare('CALL getLikes(?);');
        $stmt->execute([$userProfileID]);
        $result = $stmt->fetchAll();
        $stmt->closeCursor();

        return $result;
    }

    // Function that checks if the liker and liked have a record in the matches table, returns bool
    public function checkMatch($liker, $liked): bool
    {
        $stmt = $this->prepare('CALL checkMatch(?, ?);');
        $stmt->execute([$liker, $liked]);
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
