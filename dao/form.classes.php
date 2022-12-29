<?php

// This class interacts with the database to check if the given credentials match the ones in the database
// It uses prepared statements to prevent SQL injection
// After checking if the password hash and email match it logs in the user and starts a session
class Form extends Dbh
{
    // Check database if given user credentials match database  
    protected function signUpBetaUser($name, $email): void
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('INSERT INTO betaAccounts (betaAccount_name, betaAccount_email) VALUES (?, ?);');

        // Exectute prepared statement with the hashed password
        if (!$stmt->execute(array($name, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }
        $stmt = null;
    }

    protected function checkEmail($email): bool
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('SELECT betaAccount_id FROM betaAccounts WHERE betaAccount_email = ?;');

        // Exectute prepared statement if
        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }

        // If the statement returns a row from the database the email already exists in the database
        $resultCheck = null;
        if ($stmt->rowCount() > 0) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }
}
