--
-- Data Manipulations Lanuage voor database `Playm8`
--

USE `playm8`;

-- Disable foreign key checks globally in order to prevent ERROR 1452: Foreign key constraint fail
-- Setting this option for the session does not work
-- SET FOREIGN_KEY_CHECKS=0;
SET GLOBAL FOREIGN_KEY_CHECKS = 0;


-- Insert data into the 'accounts' table

INSERT INTO `accounts` (`accountID`, `username`, `email`, `password`, `isBetaUser`, `userProfileID`, `isActive`, `activation_code`, `activation_expiry`, `activated_at`) VALUES
  (56, 'JohanDeBoer', 'johan21@hotmail.com', '$2y$10$PGp.e8doGD/i3AU1g8GnqeL6TcXwUbEtJ3Bq9QOABItMkj6KtKQEi', 0, 560, 1, "1ddcd20a391af2e8c2a4e4bf69f55fc7", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (57, 'Jan21', 'jan21@hotmail.com', '$2y$10$8GSfjqTJN6kMDlT8ZVbJsex7rWUu0eFP2SGYVhwbBH258w5Y4gTaW', 1, 570, 1, "1137a2c535246a1383926a5d73f20011", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (58, 'Freek', 'Freekie@gmail.com', '$2y$10$uE0GZT5Wd.QrAbSRd5hvXeOqzTKNXtW3HZ/vdIxGpgFHG7/KkqGeu', 0, 580 , 1, "27471a0171af38910d5c8ffa7ed16c0d", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (59, 'Suzanne1995', 'suussje@hotmail.com', '$2y$10$wSRdfnFuxqszyn8aGrB4AunVblTQ/LdWU6yj0YbFkYTb2fQlJil/.', 0, 590, 1, "9fb87917c701231a6ad3cd502c60a56c", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (60, 'pieter', 'pieterjeeeee@gmail.com', '$2y$10$.EGzPDlybCZUAtOAe3/CouXfA5V3NphZBkHPu5H7R.NxAo314AUtW', 1, 600, 1, "914bfd2aa3fb6f355258546bb7dcfcbc", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (61, 'Petertjeeeee', 'petertjeeee@hotmail.com', '$2y$10$Sghx.UpH1fpeMNBbYd9Nbue9ioKZ6QuVzkcpLfX2pedS09UmavN0W', 0, 610, 1, "f297e4b1eacd1ba9c62538a61a8dd557", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (62, 'Marit_123', 'maritdeboer@hotmail.com', '$2y$10$tUXFyfsk/1wp2dmx00og3uoFWjsG8sY7FOu2wSGUrDNE1FATIqW6.', 0, 620, 1, "154542a1e98040b1e68a1750cbf3dec2", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (63, 'donut12', 'poloooo@gmail.com', '$2y$10$Wkg3OKaATFkhIZeRXyLg7eq599HSVcaIUA7WskHoeXcxkjcNRRMN6', 0, 630, 1, "20330503e226d3b4d5f8a3c47b8cabf6", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (64, 'richard21', 'richard@gmail.com', '$2y$10$vN9nq8iah1/jt0oFrtqBo.SoIoP8mooeVqqIOGBvdfziO6eMRJYLS', 0, 640, 1, "a5917f8a32005d757823d547a4b7931e", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (65, 'i<3dogs', 'chihuahua213@gmail.com', '$2y$10$4mij1qqSuR1bLm.OhKYDrO/iFRG882ijwxXAs9PSIhrVvbi7JSTbm', 1, 650, 1, "c92a2bf8590ed7c7839000aa650d6e5f", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (66, 'banaan22', 'banaantjee@gmail.com', '$2y$10$Dtjewcor/Smp7inPNYcewOTMP4x8e/E8LUzg/JakmDT5EEHOb3KlC', 1, 660, 1, "cbaf2cb9e92abef6e732b026b2fc5249", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (67, 'kareldeboer', 'kareltje@email.com', '$2y$10$SD2sAr7W12dvE1saupbKDu5fNZ/I7eg6R6yqvh9KnOtbhITTs9wUW', 0, 670, 1, "537cfeee5d30427b1eaaa9fa10c13242", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (68, 'chrisjjee', 'chrisjee_3213@hotmail.com', '$2y$10$dV48fzD0CYxO80ERMMbAm.RoeYXW0c8TxE5JC6rzWjbC/M/mEBC42', 0, 680, 1, "e39b3258dd906d2ba3ce3e7a44ccfdc8", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (69, 'banaanaa', 'chiquitabanana@hotmail.com', '$2y$10$niMTxstvGyYBjZZQ/6hK8ei4P4FltVlt8zAT2Ts8XaZGyXoaA45mC', 0, 690, 1, "49274824b95409a8ab8bb15338a19fbf", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (70, 'connor', 'connorh@gmail.com', '$2y$10$YCHr7ZA8iHic1zdwLdd5zu1JSxG/Msa139I5QNvTwQb3Qcm09T0qG', 0, 700, 1, "4ddcbec25b77c4d537c35707b66e3bc0", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  (71, 'falcooo1991', 'falcoo_1991@email.com', '$2y$10$I/ZQpbJ3eCgehf6D1lRNj.uus3t.rXK16QTcSoQdOXOigLTDfEZMK', 0, 710, 1, "a5e8544e3b197e63b9ec74c9481fb058", "2023-04-24 15:41:16", "2023-04-23 11:16:21");

-- Insert data into the 'userProfiles' table

INSERT INTO `userProfiles`(`userProfileID`, `firstName`, `lastName`, `phoneNumber`, `dateOfBirth`, `age`) VALUES
 ('560','Johan','Vink','+31654738829','1991-02-19','31'),
 ('570','Jan','Dijkstra','+31688372293','1992-03-11','30'),
 ('580','Freek','De Jong','+31687653367','1988-07-21','35'),
 ('590','Suzanne','Hoogland','+31678937784','1981-02-10','42'),
 ('600','Pieter','Janssen','+31688926535','1994-03-28','29'),
 ('610','Peter','De Groot','+31689487763','1999-01-01','24'),
 ('620','Marit','De Boer','+31623787732','1990-07-21','33'),
 ('630','Chris','Peeters','+31646893684','1971-12-30','42'),
 ('640','Richard','Klomp','+31674637728','1960-05-23','63'),
 ('650','Paula','Hendriks','+31689367746','1999-03-21','24'),
 ('660','Sjaak','Dekker','+31678364473','1992-05-02','30'),
 ('670','Jessica','Smit','+31626839946','1996-02-01','26'),
 ('680','Maurice','Vos','+31682736647','1998-09-09','25'),
 ('690','Michelle','Van Meer','+31672635544','2001-07-10','22'),
 ('700','Danielle','Verhoeven','+31634255362','1955-11-16','68'),
 ('710','Connor','Haas','+31616782266','1997-04-16','25');

-- Insert data into the 'likes' table

INSERT INTO `likes` (`liker`, `liked`) VALUES
  (630, 690),
  (630, 640),
  (630, 600),
  (630, 590),
  (710, 620),
  (710, 600),
  (710, 650),
  (710, 700),
  (700, 650),
  (700, 620),
  (700, 600),
  (580, 700),
  (580, 680),
  (580, 640),
  (670, 610),
  (670, 630),
  (670, 590),
  (620, 580),
  (620, 650),
  (620, 590),
  (680, 700),
  (680, 610),
  (680, 710),
  (690, 630),
  (690, 640),
  (690, 590),
  (690, 610),
  (650, 700),
  (650, 610),
  (650, 710),
  (650, 640),
  (610, 630),
  (610, 680),
  (610, 660),
  (600, 670),
  (600, 710),
  (600, 690),
  (640, 630),
  (640, 670),
  (640, 700),
  (660, 590),
  (660, 670),
  (660, 690),
  (590, 710),
  (590, 660),
  (590, 670),
  (590, 710);

-- Insert data into the 'matches' table

INSERT INTO `matches` (`userProfileID_A`, `userProfileID_B`) VALUES
  (630, 690),
  (630, 640),
  (710, 600),
  (710, 650),
  (700, 650),
  (670, 590),
  (680, 610),
  (660, 590);

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
  ('56','01'),
  ('57','01'),
  ('58','01'),
  ('59','01'),
  ('60','01'),
  ('61','01'),
  ('62','01'),
  ('63','01'),
  ('64','01'),
  ('65','01'), 
  ('66','01'),
  ('67','01'),
  ('68','01'),
  ('69','01'),
  ('70','02'),
  ('71','03');

-- Enable Foreign Key Checks Globally
SET GLOBAL FOREIGN_KEY_CHECKS=1;
