--
-- Data Definition Lanuage voor database `Playm8`
--

DROP DATABASE IF EXISTS `playm8`;
CREATE DATABASE IF NOT EXISTS `playm8`; 

USE `playm8`;

CREATE TABLE IF NOT EXISTS `accounts` (
  `accountID` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `isBetaUser` tinyint(1) NOT NULL DEFAULT 0,
  `userProfileID` varchar(500) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT 0,
  `activationCode` varchar(500) NOT NULL,
  `activationExpiry` datetime NOT NULL,
  `activatedAt` datetime DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS `accountsRoles` (
  `accountID` varchar(500) NOT NULL,
  `roleID` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `likes` (
  `liker` varchar(500) NOT NULL,
  `liked` varchar(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS `matches` (
  `userProfileID_A` varchar(500) NOT NULL,
  `userProfileID_B` varchar(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS `permissions` (
  `permissionID` int(16) NOT NULL,
  `permissionName` varchar(500) NOT NULL,
  `permissionDescription` varchar(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS `roles` (
  `roleID` int(16) NOT NULL,
  `roleName` varchar(500) NOT NULL,
  `roleDescription` varchar(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS `rolesPermissions` (
  `roleID` int(11) NOT NULL,
  `permissionID` int(11) NOT NULL
);

CREATE TABLE IF NOT EXISTS `userProfiles` (
  `userProfileID` varchar(500) NOT NULL,
  `firstName` varchar(500) NOT NULL,
  `lastName` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `country` varchar(500) NOT NULL,
  `phoneNumber` varchar(500) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `age` smallint(6) NOT NULL,
  `aboutMeTitle` varchar(500) NOT NULL,
  `aboutMeText` varchar(10000) NOT NULL,
  `userProfilePicture` varchar(500) NOT NULL
);

CREATE TABLE IF NOT EXISTS `passwordReset` (
  `passwordResetID` int(11) NOT NULL,
  `passwordResetEmail` varchar(500) NOT NULL,
  `passwordResetSelector` varchar(500) NOT NULL,
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
    IN `accountID` varchar(500),
    IN `username` varchar(500), 
    IN `email` varchar(500), 
    IN `password` varchar(500),
    IN `activationCode` varchar(500),
    IN `activationExpiry` varchar(500))
INSERT INTO `accounts` (
    accountID, username, email, password, activationCode, activationExpiry)
     VALUES (accountID, username, email, password, activationCode, activationExpiry)$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateAccount`(
  IN `username` varchar(500), 
  IN `email` varchar(500), 
  IN `password` varchar(500), 
  IN `isActive` TINYINT(1), 
  IN `activationCode` varchar(500), 
  IN `activationExpiry` varchar(500), 
  IN `accountID` varchar(500))
UPDATE `accounts` 
SET username = username, email = email, password = password, isActive = isActive, activationCode = activationCode, activationExpiry = activationExpiry
WHERE accounts.accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `deleteAccount`(
    IN `accountID` varchar(500))
DELETE FROM `accounts` 
WHERE accounts.accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `getAccountMatchingEmail`(
    IN `email` varchar(500))
SELECT * FROM accounts WHERE accounts.email = email$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `logInAccount`(
    IN `email` varchar(500), 
    IN `password` varchar(500))
SELECT * FROM accounts WHERE accounts.email = email AND accounts.password = password$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `disableAccount`(
    IN `accountID` varchar(500))
UPDATE `accounts` 
SET isEnabled = 0
WHERE accounts.accountID = accountID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `enableAccount`(
    IN `accountID` varchar(500))
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

DELIMITER $$
CREATE PROCEDURE `insertNewUserProfile`(
  IN `accountID` varchar(500), 
  IN `userProfileID` varchar(500), 
  IN `firstName` varchar(500), 
  IN `lastName` varchar(500), 
  IN `city` varchar(500), 
  IN `country` varchar(500), 
  IN `phoneNumber` varchar(500), 
  IN `dateOfBirth` DATE, 
  IN `age` INT, 
  IN `aboutMeTitle` varchar(500), 
  IN `aboutMeText` varchar(10000),
  IN `userProfilePicture` varchar(500))
BEGIN
  INSERT INTO `userProfiles` (`userProfileID`, `firstName`, `lastName`, `city`, `country`, `phoneNumber`, `dateOfBirth`, `age`, `aboutMeTitle`, `aboutMeText`, `userProfilePicture`) 
    VALUES (userProfileID, firstName, lastName, city, country, phoneNumber, dateOfBirth, age, aboutMeTitle, aboutMeText, userProfilePicture);
      UPDATE `accounts` SET accounts.userProfileID = userProfileID WHERE accounts.accountID = accountID;
END$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateUserProfile`(
  IN `userProfileID` varchar(500), 
  IN `firstName` varchar(500), 
  IN `lastName` varchar(500), 
  IN `city` varchar(500), 
  IN `country` varchar(500), 
  IN `phoneNumber` varchar(500), 
  IN `dateOfBirth` DATE, 
  IN `age` INT, 
  IN `aboutMeTitle` varchar(500), 
  IN `aboutMeText` varchar(10000))
UPDATE `userProfiles` 
SET userProfiles.firstName = firstName, userProfiles.lastName = lastName, userProfiles.city = city, userProfiles.country = country, userProfiles.phoneNumber = phoneNumber, userProfiles.dateOfBirth = dateOfBirth, userProfiles.age = age, userProfiles.aboutMeTitle = aboutMeTitle, userProfiles.aboutMeText = aboutMeText
WHERE userProfiles.userProfileID = userProfileID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `updateUserProfilePicture`(
  IN `userProfilePicture` varchar(500), 
  IN `userProfileID` varchar(500))
UPDATE userProfiles SET userProfiles.userProfilePicture = userProfilePicture WHERE userProfiles.userProfileID = userProfileID$$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE `deleteUserProfile`(
  IN `userProfileID` varchar(500))
BEGIN
  UPDATE `accounts` SET accounts.userProfileID = NULL WHERE accounts.userProfileID = userProfileID;
    DELETE FROM `userProfiles` WHERE userProfiles.userProfileID = userProfileID;
END$$
DELIMITER ;