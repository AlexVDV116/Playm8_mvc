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
    // Else select all records from accounts table where the email matches the given email
    // Returns an instance of the Account model with the property names set to the data from the selected record
    public function get(?string $userProfileID)
    {
        if (empty($userProfileID)) {
            return new userProfile;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `userProfiles`.`userProfileID` = ?';
            return $this->getObjectSql($sql, [$userProfileID]);
        }
    }
}
