--
-- Data Control Lanuage voor database `Playm8`
--

USE `playm8`;

GRANT SELECT ON `playm8`.* TO `user_read`@`%`;

GRANT SELECT, INSERT, UPDATE ON `playm8`.* TO `user_write`@`%`;

GRANT DELETE, CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON `playm8`.* TO `admin_ddl`@`%`;

GRANT REFERENCES, LOCK TABLES ON `playm8`.* TO `admin_dcl`@`%` WITH GRANT OPTION;

--
-- Giving users access to stored procedures
--

GRANT EXECUTE ON PROCEDURE `getAllAccountsOrderByAccountID` TO 'user_read'@'%';
GRANT EXECUTE ON PROCEDURE `getAllAccountsOrderByAccountID` TO 'user_write'@'%';

GRANT EXECUTE ON PROCEDURE `insertNewAccount` TO 'user_write'@'%';

GRANT EXECUTE ON PROCEDURE `updateAccount` TO 'user_write'@'%';

GRANT EXECUTE ON PROCEDURE `deleteAccount` TO 'admin_ddl'@'%';
GRANT EXECUTE ON PROCEDURE `enableAccount` TO 'admin_ddl'@'%';
GRANT EXECUTE ON PROCEDURE `disableAccount` TO 'admin_ddl'@'%';

GRANT EXECUTE ON PROCEDURE `getAccountMatchingEmail` TO 'user_read'@'%';
GRANT EXECUTE ON PROCEDURE `getAccountMatchingEmail` TO 'user_write'@'%';

GRANT EXECUTE ON PROCEDURE `logInAccount` TO 'user_read'@'%';
GRANT EXECUTE ON PROCEDURE `logInAccount` TO 'user_write'@'%';
