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
  ('AID644e5491179c5', 'JohanDeBoer', 'johan21@hotmail.com', '$2y$10$PGp.e8doGD/i3AU1g8GnqeL6TcXwUbEtJ3Bq9QOABItMkj6KtKQEi', 0, 'UID644e5491179c5', 1, "$2y$10$6CZkHftRMvZONlBSN1XGW.wt7mBRDbyRDBkoqJYMqt/T2ZG6RFhMq", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c8', 'Jan21', 'jan21@hotmail.com', '$2y$10$8GSfjqTJN6kMDlT8ZVbJsex7rWUu0eFP2SGYVhwbBH258w5Y4gTaW', 1, 'UID644e5491179c8', 1, "$2y$10$IhD4b2b0BNXn.Rwv5AU.ZO1oSCj0ZRdNtlJVMP8Iy0Opxyyyl5mwK", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c9', 'Freek', 'Freekie@gmail.com', '$2y$10$uE0GZT5Wd.QrAbSRd5hvXeOqzTKNXtW3HZ/vdIxGpgFHG7/KkqGeu', 0, 'UID644e5491179c9' , 1, "$2y$10$JZl4r6n9gk7E8Q4URH/AKe94KTvz7iqpzRFCqg8OMDHkJlGuB9TwK", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179ca', 'Suzanne1995', 'suussje@hotmail.com', '$2y$10$wSRdfnFuxqszyn8aGrB4AunVblTQ/LdWU6yj0YbFkYTb2fQlJil/.', 0, 'UID644e5491179ca', 1, "$2y$10$8byqr6MKfi1Lxa6dvVqrNO0TCFKhUk2AboeeEx.gT2CHUhbJGCEoW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b95', 'pieter', 'pieterjeeeee@gmail.com', '$2y$10$.EGzPDlybCZUAtOAe3/CouXfA5V3NphZBkHPu5H7R.NxAo314AUtW', 1, 'UID644e579c94b95', 1, "$2y$10$lSrE1fPry.tViDMu7Ve1pum2kBtLMe3/gdeC39PWGHMOysgfWYh2i", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b96', 'Petertjeeeee', 'petertjeeee@hotmail.com', '$2y$10$Sghx.UpH1fpeMNBbYd9Nbue9ioKZ6QuVzkcpLfX2pedS09UmavN0W', 0, 'UID644e579c94b96', 1, "$2y$10$GU7Vgj6ljTE60tIzxpkgo.1dxkHpvgefGWFap/Ye.llCgGNy4EK2S", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b97', 'Marit_123', 'maritdeboer@hotmail.com', '$2y$10$tUXFyfsk/1wp2dmx00og3uoFWjsG8sY7FOu2wSGUrDNE1FATIqW6.', 0, 'UID644e579c94b97', 1, "$2y$10$JAIQDG9DP0XR1/D6iSbqo.wKXkVCz4mpY3LzwkHAt8/0.AK.eiroC", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b98', 'donut12', 'poloooo@gmail.com', '$2y$10$Wkg3OKaATFkhIZeRXyLg7eq599HSVcaIUA7WskHoeXcxkjcNRRMN6', 0, 'UID644e579c94b98', 1, "$2y$10$xDPKxwCNY/nznOT7.gsx5eERC/xmXKgUxfAv2WgAtG6vSv1UU/xy.", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b99', 'richard21', 'richard@gmail.com', '$2y$10$vN9nq8iah1/jt0oFrtqBo.SoIoP8mooeVqqIOGBvdfziO6eMRJYLS', 0, 'UID644e579c94b99', 1, "$2y$10$ycMV6qWzRAv15NerSYD36.uRrov8Cx9nClSO46T5lMJv7dC7uEXCG", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9a', 'i<3dogs', 'chihuahua213@gmail.com', '$2y$10$4mij1qqSuR1bLm.OhKYDrO/iFRG882ijwxXAs9PSIhrVvbi7JSTbm', 1, 'UID644e579c94b9a', 1, "$2y$10$NI1PyEHICwtedW6CFFb8ROej2fDYboGsDgas51SAGRh2ZKT9mngGW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9b', 'banaan22', 'banaantjee@gmail.com', '$2y$10$Dtjewcor/Smp7inPNYcewOTMP4x8e/E8LUzg/JakmDT5EEHOb3KlC', 1, 'UID644e579c94b9b', 1, "$2y$10$4AnNzxd8MXXsJqIyq5IxrexTUTVvZkmFD/FD3KGUiJknUS1YrposW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9c', 'kareldeboer', 'kareltje@email.com', '$2y$10$SD2sAr7W12dvE1saupbKDu5fNZ/I7eg6R6yqvh9KnOtbhITTs9wUW', 0, 'UID644e579c94b9c', 1, "$2y$10$haNuEOjypCqWw.x7kTDd5OnX2qr7NItiU0Tfs3YdPAPi54q/g0YBi", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba0', 'chrisjjee', 'chrisjee_3213@hotmail.com', '$2y$10$dV48fzD0CYxO80ERMMbAm.RoeYXW0c8TxE5JC6rzWjbC/M/mEBC42', 0, 'UID644e579c94ba0', 1, "$2y$10$t1jPI905mc34ImEgVdKemOwDd2mN0qKGGu8zxIZKWc9nySgqqe2w6", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba1', 'banaanaa', 'chiquitabanana@hotmail.com', '$2y$10$niMTxstvGyYBjZZQ/6hK8ei4P4FltVlt8zAT2Ts8XaZGyXoaA45mC', 0, 'UID644e579c94ba1', 1, "$2y$10$/6ogbuuLxH/wASmAEHbkGOFyPAMX.K7KQ9oc9mYCdefhw0kRgnm4W", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba2', 'connor', 'connorh@gmail.com', '$2y$10$YCHr7ZA8iHic1zdwLdd5zu1JSxG/Msa139I5QNvTwQb3Qcm09T0qG', 0, 'UID644e579c94ba2', 1, "$2y$10$oVOodTV6.UzmZzt4cHJ5SurCApL2PuLyazg4InlVg8Sfow8qnjoEC", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba3', 'falcooo1991', 'falcoo_1991@email.com', '$2y$10$I/ZQpbJ3eCgehf6D1lRNj.uus3t.rXK16QTcSoQdOXOigLTDfEZMK', 0, 'UID644e579c94ba3', 1, "$2y$10$.0YmIpOMccc3GXlb/Nt.5.hnDFmz.0BrxbHBdvSzJ2Nd3HlAvPlp6", "2023-04-24 15:41:16", "2023-04-23 11:16:21");

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
