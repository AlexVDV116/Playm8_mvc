--
-- Data Definition Lanuage voor database `Playm8`
--

DROP DATABASE IF EXISTS `playm8`;
CREATE DATABASE IF NOT EXISTS `playm8`; 

USE `playm8`;

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` varchar(255) NOT NULL,
  `username` tinytext NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` tinytext NOT NULL,
  `isBetaUser` tinyint(1) NOT NULL DEFAULT 0,
  `userProfileID` varchar(255) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 0,
  `activationCode` varchar(255) NOT NULL,
  `activationExpiry` datetime NOT NULL,
  `activatedAt` datetime DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `accountsRoles` (
  `accountID` varchar(255) NOT NULL,
  `roleID` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `likes` (
  `liker` varchar(255) NOT NULL,
  `liked` varchar(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS `matches` (
  `userProfileID_A` varchar(255) NOT NULL,
  `userProfileID_B` varchar(255) NOT NULL
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
  `userProfileID` varchar(255) NOT NULL,
  `firstName` tinytext NOT NULL,
  `lastName` tinytext NOT NULL,
  `phoneNumber` tinytext NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` smallint(6) NOT NULL
);

CREATE TABLE IF NOT EXISTS `passwordReset` (
  `passwordResetID` int(11) NOT NULL,
  `passwordResetEmail` varchar(255) NOT NULL,
  `passwordResetSelector` tinytext NOT NULL,
  `passwordResetToken` longtext NOT NULL,
  `passwordResetExpires` datetime NOT NULL
);

--
-- Setting Primary Keys
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`accountID`),
  ADD KEY `userProfileID` (`userProfileID`),
  ADD KEY `email` (`email`);

ALTER TABLE `accountsRoles`
  ADD PRIMARY KEY (`accountID`,`roleID`),
  ADD KEY `roleID` (`roleID`);

ALTER TABLE `likes`
  ADD KEY `liker` (`liker`),
  ADD KEY `liked` (`liked`);

ALTER TABLE `matches` 
  ADD KEY `userProfileID_A` (`userProfileID_A`),
  ADD KEY `userProfileID_B` (`userProfileID_B`);

ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permissionID`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleID`);

ALTER TABLE `rolesPermissions`
  ADD PRIMARY KEY (`roleID`,`permissionID`),
  ADD KEY `rolespermissions_ibfk_2` (`permissionID`);

ALTER TABLE `userProfiles`
  ADD PRIMARY KEY (`userProfileID`);

ALTER TABLE `passwordReset`
ADD PRIMARY KEY (`passwordResetEmail`);

ALTER TABLE `passwordReset`
  ADD KEY `passwordResetID` (`passwordResetID`),
  MODIFY `passwordResetID` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- Setting Foreign Keys
--
ALTER TABLE `accounts` 
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`userProfileID`) REFERENCES `userProfiles`(`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `accountsRoles`
  ADD CONSTRAINT `accountsroles_ibfk_1` FOREIGN KEY (`accountID`) REFERENCES `accounts` (`accountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accountsroles_ibfk_2` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`liked`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`liker`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`userProfileID_A`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`userProfileID_B`) REFERENCES `userProfiles` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `rolesPermissions`
  ADD CONSTRAINT `rolespermissions_ibfk_1` FOREIGN KEY (`roleID`) REFERENCES `roles` (`roleID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rolespermissions_ibfk_2` FOREIGN KEY (`permissionID`) REFERENCES `permissions` (`permissionID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `userProfiles`
  ADD CONSTRAINT `userprofiles_ibfk_1` FOREIGN KEY (`userProfileID`) REFERENCES `accounts` (`userProfileID`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `passwordReset`
  ADD CONSTRAINT `passwordreset_ibfk_1` FOREIGN KEY (`passwordResetEmail`) REFERENCES `accounts` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
    IN `accountID` varchar(255),
    IN `username` TINYTEXT, 
    IN `email` TINYTEXT, 
    IN `password` TINYTEXT,
    IN `activationCode` TINYTEXT,
    IN `activationExpiry` TINYTEXT)
INSERT INTO `accounts` (
    accountID, username, email, password, activationCode, activationExpiry)
     VALUES (accountID, username, email, password, activationCode, activationExpiry)$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateAccount`(
    IN `username` TINYTEXT, 
    IN `email` TINYTEXT, 
    IN `isEnabled` TINYINT, 
    IN `isBetaUser` TINYINT, 
    IN `accountID` varchar(255))
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

DELIMITER $$
CREATE PROCEDURE `disableAccount`(
    IN `accountID` varchar(255))
UPDATE `accounts` 
SET isEnabled = 0
WHERE accounts.accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `enableAccount`(
    IN `accountID` varchar(255))
UPDATE `accounts` 
SET isEnabled = 1
WHERE accounts.accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `foundMatch` BEFORE INSERT ON `likes`
  FOR EACH ROW 
  BEGIN
    IF EXISTS( SELECT * FROM likes WHERE NEW.liker = likes.liked AND NEW.liked = likes.liker ) THEN 
        INSERT INTO matches (userProfileID_A, userProfileID_B) VALUES (NEW.liker, NEW.liked);
    END IF;
  END
DELIMITER ;
