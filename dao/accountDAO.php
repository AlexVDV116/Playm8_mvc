<?php

require_once '../framework/DAO.php';
require_once '../model/Account.php';

class accountDAO extends DAO
{

    private static $select = 'SELECT * FROM `accounts`';

    public function __construct()
    {
        parent::__construct('Account');
    }

    public function startList(): void
    {
        $sql = self::$select;
        $sql .= ' ORDER BY `accounts`.`account_id`';
        $this->startListSql($sql);
    }

    public function get(?string $account_email)
    {
        if (empty($account_email)) {
            return new Account;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `accounts`.`account_email` = ?';
            return $this->getObjectSql($sql, [$account_email]);
        }
    }

    public function delete(int $account_id): void
    {
        $sql = 'DELETE FROM `accounts` '
            . ' WHERE `accounts_id` = ?';
        $args = [
            $account_id
        ];
        $this->execute($sql, $args);
    }

    public function insert(Account $account): void
    {
        $sql = 'INSERT INTO `accounts` '
            . ' (account_username, account_email, account_password)'
            . ' VALUES (?, ?, ?)';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getPassword()
        ];
        $this->execute($sql, $args);
    }

    public function update(Account $account): void
    {
        $sql = 'UPDATE `accounts` '
            . ' SET account_username = ?, account_email = ?, account_enabled = ?, account_beta_user = ?'
            . ' WHERE account_id = ?';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getEnabled(),
            $account->getBetaUser(),
            $account->getAccountID()
        ];
        $this->execute($sql, $args);
    }

    public function save(Account $account): void
    {
        if (empty($account->getAccountID())) {
            $this->insert($account);
        } else {
            $this->update($account);
        }
    }

    // Check database for already registered email returns true if email already found
    public function knownEmail(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ?");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        // If the statement returns a row from the database the email already exists in the database
        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Check database if account already signed up as beta user
    public function isBeta(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ? AND account_beta_user = 1");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        // If the statement returns a row from the database then the acount is already signed up as a beta user
        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // Check database if account already signed up as beta user
    public function isEnabled(string $account_email): bool
    {
        $stmt = $this->prepare("SELECT * FROM accounts WHERE account_email = ? AND account_enabled = 1");
        $stmt->execute([$account_email]);
        $result = $stmt->fetch();

        // If the statement returns a row from the database then the acount exists and is enabled
        $resultCheck = null;
        if ($result) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }
}
