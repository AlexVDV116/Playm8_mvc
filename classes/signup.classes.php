<?php

class Signup extends Dbh
{
    // Check database for already registered email
    protected function setUser($email, $password)
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('INSERT INTO accounts (account_email, account_password) VALUES (? ,?);');

        // Use PHP built in method to generate a password hash
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!$stmt->execute(array($email, $hashedPassword))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }
        $stmt = null;
    }

    // Check database for already registered email
    protected function checkEmail($email)
    {
        // Prepared statement to prevent SQL injection
        $stmt = $this->connect()->prepare('SELECT account_id FROM accounts WHERE account_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit;
        }

        // If the statement returns a row from the database the email already exists in the database
        $resultCheck = null;
        if ($stmt->rowCount() > 0) {
            $resultCheck - false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }
}
