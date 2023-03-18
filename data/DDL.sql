--
-- Data Definition Lanuage voor database `Playm8`
--

DROP DATABASE IF EXISTS `playm8`;
CREATE DATABASE IF NOT EXISTS `playm8`; 

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` int(16) NOT NULL,
  `username` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `isEnabled` tinyint(1) NOT NULL DEFAULT 1,
  `isBetaUser` tinyint(1) NOT NULL DEFAULT 0,
  `userProfileID` int(16) DEFAULT NULL
);


CREATE TABLE IF NOT EXISTS `accountsRoles` (
  `accountID` int(11) NOT NULL,
  `roleID` int(11) NOT NULL
);


CREATE TABLE IF NOT EXISTS `likes` (
  `liker` int(16) NOT NULL,
  `liked` int(16) NOT NULL
);


CREATE TABLE IF NOT EXISTS `permissions` (
  `permissionID` int(16) NOT NULL,
  `permissionName` tinytext NOT NULL,
  `permissionDescription` tinytext NOT NULL
);


CREATE TABLE IF NOT EXISTS `roles` (
  `roleID` int(16) NOT NULL,
  `roleName` tinytext NOT NULL,
  `roleDescription` tinytext NOT NULL
);


CREATE TABLE IF NOT EXISTS `rolesPermissions` (
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL
);


CREATE TABLE IF NOT EXISTS `userProfiles` (
  `userProfileID` int(16) NOT NULL,
  `firstName` tinytext NOT NULL,
  `lastName` tinytext NOT NULL,
  `phoneNumber` tinytext NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` smallint(6) NOT NULL
);

--
-- Setting Primary Keys
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `userProfileID` (`userProfileID`);


ALTER TABLE `accountsRoles`
  ADD PRIMARY KEY (`accountID`,`roleID`),
  ADD KEY `roleID` (`roleID`);


ALTER TABLE `likes`
  ADD KEY `liker` (`liker`),
  ADD KEY `liked` (`liked`);


ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionID`);


ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);


ALTER TABLE `rolesPermissions`
  ADD PRIMARY KEY (`roleID`,`permissionID`),
  ADD KEY `rolespermissions_ibfk_2` (`permissionID`);


ALTER TABLE `userProfiles`
  ADD PRIMARY KEY (`userProfileID`);


ALTER TABLE `accounts`
  MODIFY `accountID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Setting Foreign Keys
--
ALTER TABLE `accountsRoles`
  ADD CONSTRAINT `accountsroles_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountsroles_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`liked`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`liker`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `rolesPermissions`
  ADD CONSTRAINT `rolespermissions_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rolespermissions_ibfk_2` FOREIGN KEY (`permissionID`) REFERENCES `permissions` (`permissionID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `userProfiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`userProfileID`) REFERENCES `accounts` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Creating database users
--

DROP USER IF EXISTS
  'user_read'@'%',
  'user_write'@'%',
  'admin_ddl'@'%',
  'admin_dcl'@'%';

CREATE USER
  'user_read'@'%' IDENTIFIED BY 'M0vuw@u2Z0Tf5S]N',
  'user_write'@'%' IDENTIFIED BY 'p-RCj/_G!7uGjfHN',
  'admin_ddl'@'%' IDENTIFIED BY '6br0IMwuoar_999W',
  'admin_dcl'@'%' IDENTIFIED BY 'eWROy_8C9KavY*rE';

--
-- Creating stored procedures
--

DELIMITER $$
CREATE PROCEDURE `getAllAccountsOrderByAccountID`()
SELECT * FROM accounts ORDER BY accounts.accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `insertNewAccount`(
    IN `username` TINYTEXT, 
    IN `email` TINYTEXT, 
    IN `password` TINYTEXT)
INSERT INTO `accounts` (
    username, email, password)
     VALUES (username, email, password)$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateAccount`(
    IN `username` TINYTEXT, 
    IN `email` TINYTEXT, 
    IN `isEnabled` TINYINT, 
    IN `isBetaUser` TINYINT, 
    IN `accountID` int(16))
UPDATE `accounts` 
SET username = username, email = email, isEnabled = isEnabled, isBetaUser = isBetaUser 
WHERE accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `deleteAccount`(
    IN `account_id` INT(16))
DELETE FROM `accounts` 
WHERE `accounts_id` = account_id$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `getAccountMatchingEmail`(
    IN `email` TINYTEXT)
SELECT * FROM accounts WHERE accounts.email = email$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `logInAccount`(
    IN `email` TINYTEXT, 
    IN `password` TINYTEXT)
SELECT * FROM accounts WHERE accounts.email = email AND accounts.password = password$$
DELIMITER ;