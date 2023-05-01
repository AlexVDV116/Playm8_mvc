--
-- Data Manipulations Lanuage voor database `Playm8`
--

USE `playm8`;

-- Disable foreign key checks globally in order to prevent ERROR 1452: Foreign key constraint fail
-- Setting this option for the session does not work
-- SET FOREIGN_KEY_CHECKS=0;
SET GLOBAL FOREIGN_KEY_CHECKS = 0;


-- Insert data into the 'accounts' table

INSERT INTO `accounts` (`accountID`, `username`, `email`, `password`, `isBetaUser`, `userProfileID`, `isActive`, `activationCode`, `activationExpiry`, `activatedAt`) VALUES
  ('AID644e5491179c5', 'JohanDeBoer', 'johan21@hotmail.com', '$2y$10$PGp.e8doGD/i3AU1g8GnqeL6TcXwUbEtJ3Bq9QOABItMkj6KtKQEi', 0, 'UID644e5491179c5', 1, "1ddcd20a391af2e8c2a4e4bf69f55fc7", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c8', 'Jan21', 'jan21@hotmail.com', '$2y$10$8GSfjqTJN6kMDlT8ZVbJsex7rWUu0eFP2SGYVhwbBH258w5Y4gTaW', 1, 'UID644e5491179c8', 1, "1137a2c535246a1383926a5d73f20011", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c9', 'Freek', 'Freekie@gmail.com', '$2y$10$uE0GZT5Wd.QrAbSRd5hvXeOqzTKNXtW3HZ/vdIxGpgFHG7/KkqGeu', 0, 'UID644e5491179c9' , 1, "27471a0171af38910d5c8ffa7ed16c0d", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179ca', 'Suzanne1995', 'suussje@hotmail.com', '$2y$10$wSRdfnFuxqszyn8aGrB4AunVblTQ/LdWU6yj0YbFkYTb2fQlJil/.', 0, 'UID644e5491179ca', 1, "9fb87917c701231a6ad3cd502c60a56c", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b95', 'pieter', 'pieterjeeeee@gmail.com', '$2y$10$.EGzPDlybCZUAtOAe3/CouXfA5V3NphZBkHPu5H7R.NxAo314AUtW', 1, 'UID644e579c94b95', 1, "914bfd2aa3fb6f355258546bb7dcfcbc", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b96', 'Petertjeeeee', 'petertjeeee@hotmail.com', '$2y$10$Sghx.UpH1fpeMNBbYd9Nbue9ioKZ6QuVzkcpLfX2pedS09UmavN0W', 0, 'UID644e579c94b96', 1, "f297e4b1eacd1ba9c62538a61a8dd557", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b97', 'Marit_123', 'maritdeboer@hotmail.com', '$2y$10$tUXFyfsk/1wp2dmx00og3uoFWjsG8sY7FOu2wSGUrDNE1FATIqW6.', 0, 'UID644e579c94b97', 1, "154542a1e98040b1e68a1750cbf3dec2", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b98', 'donut12', 'poloooo@gmail.com', '$2y$10$Wkg3OKaATFkhIZeRXyLg7eq599HSVcaIUA7WskHoeXcxkjcNRRMN6', 0, 'UID644e579c94b98', 1, "20330503e226d3b4d5f8a3c47b8cabf6", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b99', 'richard21', 'richard@gmail.com', '$2y$10$vN9nq8iah1/jt0oFrtqBo.SoIoP8mooeVqqIOGBvdfziO6eMRJYLS', 0, 'UID644e579c94b99', 1, "a5917f8a32005d757823d547a4b7931e", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9a', 'i<3dogs', 'chihuahua213@gmail.com', '$2y$10$4mij1qqSuR1bLm.OhKYDrO/iFRG882ijwxXAs9PSIhrVvbi7JSTbm', 1, 'UID644e579c94b9a', 1, "c92a2bf8590ed7c7839000aa650d6e5f", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9b', 'banaan22', 'banaantjee@gmail.com', '$2y$10$Dtjewcor/Smp7inPNYcewOTMP4x8e/E8LUzg/JakmDT5EEHOb3KlC', 1, 'UID644e579c94b9b', 1, "cbaf2cb9e92abef6e732b026b2fc5249", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9c', 'kareldeboer', 'kareltje@email.com', '$2y$10$SD2sAr7W12dvE1saupbKDu5fNZ/I7eg6R6yqvh9KnOtbhITTs9wUW', 0, 'UID644e579c94b9c', 1, "537cfeee5d30427b1eaaa9fa10c13242", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba0', 'chrisjjee', 'chrisjee_3213@hotmail.com', '$2y$10$dV48fzD0CYxO80ERMMbAm.RoeYXW0c8TxE5JC6rzWjbC/M/mEBC42', 0, 'UID644e579c94ba0', 1, "e39b3258dd906d2ba3ce3e7a44ccfdc8", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba1', 'banaanaa', 'chiquitabanana@hotmail.com', '$2y$10$niMTxstvGyYBjZZQ/6hK8ei4P4FltVlt8zAT2Ts8XaZGyXoaA45mC', 0, 'UID644e579c94ba1', 1, "49274824b95409a8ab8bb15338a19fbf", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba2', 'connor', 'connorh@gmail.com', '$2y$10$YCHr7ZA8iHic1zdwLdd5zu1JSxG/Msa139I5QNvTwQb3Qcm09T0qG', 0, 'UID644e579c94ba2', 1, "4ddcbec25b77c4d537c35707b66e3bc0", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba3', 'falcooo1991', 'falcoo_1991@email.com', '$2y$10$I/ZQpbJ3eCgehf6D1lRNj.uus3t.rXK16QTcSoQdOXOigLTDfEZMK', 0, 'UID644e579c94ba3', 1, "a5e8544e3b197e63b9ec74c9481fb058", "2023-04-24 15:41:16", "2023-04-23 11:16:21");

-- Insert data into the 'userProfiles' table

INSERT INTO `userProfiles`(`userProfileID`, `firstName`, `lastName`, `phoneNumber`, `dateOfBirth`, `age`) VALUES
 ('UID644e5491179c5','Johan','Vink','+31654738829','1991-02-19','31'),
 ('UID644e5491179c8','Jan','Dijkstra','+31688372293','1992-03-11','30'),
 ('UID644e5491179c9','Freek','De Jong','+31687653367','1988-07-21','35'),
 ('UID644e5491179ca','Suzanne','Hoogland','+31678937784','1981-02-10','42'),
 ('UID644e579c94b95','Pieter','Janssen','+31688926535','1994-03-28','29'),
 ('UID644e579c94b96','Peter','De Groot','+31689487763','1999-01-01','24'),
 ('UID644e579c94b97','Marit','De Boer','+31623787732','1990-07-21','33'),
 ('UID644e579c94b98','Chris','Peeters','+31646893684','1971-12-30','42'),
 ('UID644e579c94b99','Richard','Klomp','+31674637728','1960-05-23','63'),
 ('UID644e579c94b9a','Paula','Hendriks','+31689367746','1999-03-21','24'),
 ('UID644e579c94b9b','Sjaak','Dekker','+31678364473','1992-05-02','30'),
 ('UID644e579c94b9c','Jessica','Smit','+31626839946','1996-02-01','26'),
 ('UID644e579c94ba0','Maurice','Vos','+31682736647','1998-09-09','25'),
 ('UID644e579c94ba1','Michelle','Van Meer','+31672635544','2001-07-10','22'),
 ('UID644e579c94ba2','Danielle','Verhoeven','+31634255362','1955-11-16','68'),
 ('UID644e579c94ba3','Connor','Haas','+31616782266','1997-04-16','25');

-- Insert data into the 'likes' table

INSERT INTO `likes` (`liker`, `liked`) VALUES
  ('UID644e579c94b98', 'UID644e579c94ba1'),
  ('UID644e579c94b98', 'UID644e579c94b99'),
  ('UID644e579c94b98', 'UID644e579c94b95'),
  ('UID644e579c94b98', 'UID644e5491179ca'),
  ('UID644e579c94ba3', 'UID644e579c94b97'),
  ('UID644e579c94ba3', 'UID644e579c94b95'),
  ('UID644e579c94ba3', 'UID644e579c94b9a'),
  ('UID644e579c94ba3', 'UID644e579c94ba2'),
  ('UID644e579c94ba2', 'UID644e579c94b9a'),
  ('UID644e579c94ba2', 'UID644e579c94b97'),
  ('UID644e579c94ba2', 'UID644e579c94b95'),
  ('UID644e5491179c9', 'UID644e579c94ba2'),
  ('UID644e5491179c9', 'UID644e579c94ba0'),
  ('UID644e5491179c9', 'UID644e579c94b99'),
  ('UID644e579c94b9c', 'UID644e579c94b96'),
  ('UID644e579c94b9c', 'UID644e579c94b98'),
  ('UID644e579c94b9c', 'UID644e5491179ca'),
  ('UID644e579c94b97', 'UID644e5491179c9'),
  ('UID644e579c94b97', 'UID644e579c94b9a'),
  ('UID644e579c94b97', 'UID644e5491179ca'),
  ('UID644e579c94ba0', 'UID644e579c94ba2'),
  ('UID644e579c94ba0', 'UID644e579c94b96'),
  ('UID644e579c94ba0', 'UID644e579c94ba3'),
  ('UID644e579c94ba1', 'UID644e579c94b98'),
  ('UID644e579c94ba1', 'UID644e579c94b99'),
  ('UID644e579c94ba1', 'UID644e5491179ca'),
  ('UID644e579c94ba1', 'UID644e579c94b96'),
  ('UID644e579c94b9a', 'UID644e579c94ba2'),
  ('UID644e579c94b9a', 'UID644e579c94b96'),
  ('UID644e579c94b9a', 'UID644e579c94ba3'),
  ('UID644e579c94b9a', 'UID644e579c94b99'),
  ('UID644e579c94b96', 'UID644e579c94b98'),
  ('UID644e579c94b96', 'UID644e579c94ba0'),
  ('UID644e579c94b96', 'UID644e579c94b9b'),
  ('UID644e579c94b95', 'UID644e579c94b9c'),
  ('UID644e579c94b95', 'UID644e579c94ba3'),
  ('UID644e579c94b95', 'UID644e579c94ba1'),
  ('UID644e579c94b99', 'UID644e579c94b98'),
  ('UID644e579c94b99', 'UID644e579c94b9c'),
  ('UID644e579c94b99', 'UID644e579c94ba2'),
  ('UID644e579c94b9b', 'UID644e5491179ca'),
  ('UID644e579c94b9b', 'UID644e579c94b9c'),
  ('UID644e579c94b9b', 'UID644e579c94ba1'),
  ('UID644e5491179ca', 'UID644e579c94ba3'),
  ('UID644e5491179ca', 'UID644e579c94b9b'),
  ('UID644e5491179ca', 'UID644e579c94b9c'),
  ('UID644e5491179ca', 'UID644e579c94ba3');

-- Insert data into the 'matches' table

INSERT INTO `matches` (`userProfileID_A`, `userProfileID_B`) VALUES
  ('UID644e579c94b98', 'UID644e579c94ba1'),
  ('UID644e579c94b98', 'UID644e579c94b99'),
  ('UID644e579c94ba3', 'UID644e579c94b95'),
  ('UID644e579c94ba3', 'UID644e579c94b9a'),
  ('UID644e579c94ba2', 'UID644e579c94b9a'),
  ('UID644e579c94b9c', 'UID644e5491179ca'),
  ('UID644e579c94ba0', 'UID644e579c94b96'),
  ('UID644e579c94b9b', 'UID644e5491179ca');

-- Insert data into the 'permissions' table
 
INSERT INTO `permissions` (`permissionID`, `permissionName`, `permissionDescription`) VALUES
  ('01', 'CreateAccount', 'The permission to create an account.'),
  ('02', 'DeleteAccount', 'The permission to delete an account.'),
  ('03', 'DisableEnableAccount', 'The permission to disable or enable an account.'),
  ('04', 'ChangePassword', 'The permission to set the password for an account.'),
  ('05', 'ForceLogout', 'The permission to force an account to log out.'),
  ('06', 'CreatePermission', 'The permission to create a permission.'),
  ('07', 'CreateRole', 'The permission to create a new role.'),
  ('08', 'GivePermission', 'The permission to give permission to a role.'),
  ('09', 'GiveRole', 'The permission to give a role to a user.'),
  ('10', 'EditProfile', 'The permission to edit a user profile.'),
  ('11', 'ResetPassword', 'The permission to reset the password for an account.'),
  ('12', 'DeleteOwnAccount', 'The permission to delete your own account.'),
  ('13', 'EditCompanyPage', 'The permission to edit company page.');;

-- Insert data into the 'roles' table

INSERT INTO `roles`(`roleID`, `roleName`, `roleDescription`) VALUES
  ('01','User','Basic user account'),
  ('02','Moderator','Basic moderator account'),
  ('03','Admin','Basic admin account'),
  ('04','Company','Basic company account');

 -- Insert data into the 'rolesPermissions' table

 INSERT INTO `rolesPermissions`(`roleID`, `permissionID`) VALUES
  ('01','10'),
  ('01','11'),
  ('01','12'),
  ('02','03'),
  ('02','04'),
  ('02','11'),
  ('03','01'),
  ('03','02'),
  ('03','03'),
  ('03','04'),
  ('03','05'),
  ('03','06'),
  ('03','07'),
  ('03','08'),
  ('03','09'),
  ('03','10'),
  ('03','11'),
  ('04','12'),
  ('04','13');

  -- Insert data into the 'accountsRoles' table

INSERT INTO `accountsRoles`(`accountID`, `roleID`) VALUES
  ('AID644e5491179c5','01'),
  ('AID644e5491179c8','01'),
  ('AID644e5491179c9','01'),
  ('AID644e5491179ca','01'),
  ('AID644e579c94b95','01'),
  ('AID644e579c94b96','01'),
  ('AID644e579c94b97','01'),
  ('AID644e579c94b98','01'),
  ('AID644e579c94b99','01'),
  ('AID644e579c94b9a','01'),
  ('AID644e579c94b9b','01'),
  ('AID644e579c94b9c','01'),
  ('AID644e579c94ba0','01'),
  ('AID644e579c94ba1','01'),
  ('AID644e579c94ba2','02'),
  ('AID644e579c94ba3','02'),
  ('AID644e579c94ba3','03');
  

-- Enable Foreign Key Checks Globally
SET GLOBAL FOREIGN_KEY_CHECKS=1;
