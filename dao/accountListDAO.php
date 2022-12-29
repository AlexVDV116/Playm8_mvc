<?php

require_once 'framework/DAO.php';
require_once 'model/Account.php';

class accountListDAO extends DAO
{

    private static $select = 'SELECT * FROM `accounts`';

    function __construct()
    {
        parent::__construct('Account');
    }

    function startList(): void
    {
        $sql = self::$select;
        $sql .= ' ORDER BY `accounts`.`account_id`';
        $this->startListSql($sql);
    }

    function get(?string $account_id)
    {
        if (empty($account_id)) {
            return new Account;
        } else {
            $sql = self::$select;
            $sql .= ' WHERE `accounts`.`account_id` = ?';
            return $this->getObjectSql($sql, [$account_id]);
        }
    }

    function delete(int $account_id)
    {
        $sql = 'DELETE FROM `accounts` '
            . ' WHERE `accounts_id` = ?';
        $args = [
            $account_id
        ];
        $this->execute($sql, $args);
    }

    function insert(Account $account)
    {
        $sql = 'INSERT INTO `accounts` '
            . ' (account_id, account_username, account_email, account_enabled)'
            . ' VALUES (?, ?, ?, ?)';
        $args = [
            $account->getAccountID(),
            $account->getName(),
            $account->getEmail(),
            $account->getEnabled()
        ];
        $this->execute($sql, $args);
    }

    function update(Account $account)
    {
        $sql = 'UPDATE `accounts` '
            . ' SET account_username = ?, account_email = ?, account_enabled = ?'
            . ' WHERE account_id = ?';
        $args = [
            $account->getName(),
            $account->getEmail(),
            $account->getEnabled(),
            $account->getAccountID()
        ];
        $this->execute($sql, $args);
    }

    function save(Account $account)
    {
        if (empty($account->getAccountID())) {
            $this->insert($account);
        } else {
            $this->update($account);
        }
    }
}
