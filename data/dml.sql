--
-- Data Manipulations Lanuage voor database `Playm8`
--

USE `playm8`;

-- Disable foreign key checks globally in order to prevent ERROR 1452: Foreign key constraint fail
-- Setting this option for the session does not work
-- SET FOREIGN_KEY_CHECKS=0;
-- SET GLOBAL FOREIGN_KEY_CHECKS = 0;


-- Insert data into the 'accounts' table

INSERT INTO `accounts` (`accountID`, `username`, `email`, `password`, `isBetaUser`, `userProfileID`, `isActive`, `activationCode`, `activationExpiry`, `activatedAt`) VALUES
  ('AID644e5491179c5', 'JohanDeBoer', 'johan21@hotmail.com', '$2y$10$PGp.e8doGD/i3AU1g8GnqeL6TcXwUbEtJ3Bq9QOABItMkj6KtKQEi', 0, 'UID644e5491179c5', 1, "$2y$10$6CZkHftRMvZONlBSN1XGW.wt7mBRDbyRDBkoqJYMqt/T2ZG6RFhMq", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c8', 'Jan21', 'jan21@hotmail.com', '$2y$10$8GSfjqTJN6kMDlT8ZVbJsex7rWUu0eFP2SGYVhwbBH258w5Y4gTaW', 1, 'UID644e5491179c8', 1, "$2y$10$IhD4b2b0BNXn.Rwv5AU.ZO1oSCj0ZRdNtlJVMP8Iy0Opxyyyl5mwK", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179c9', 'Freek', 'Freekie@gmail.com', '$2y$10$uE0GZT5Wd.QrAbSRd5hvXeOqzTKNXtW3HZ/vdIxGpgFHG7/KkqGeu', 0, 'UID644e5491179c9' , 1, "$2y$10$JZl4r6n9gk7E8Q4URH/AKe94KTvz7iqpzRFCqg8OMDHkJlGuB9TwK", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e5491179ca', 'Suzanne1995', 'suussje@hotmail.com', '$2y$10$wSRdfnFuxqszyn8aGrB4AunVblTQ/LdWU6yj0YbFkYTb2fQlJil/.', 0, 'UID644e5491179ca', 1, "$2y$10$8byqr6MKfi1Lxa6dvVqrNO0TCFKhUk2AboeeEx.gT2CHUhbJGCEoW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b95', 'pieter', 'pieterjeeeee@gmail.com', '$2y$10$.EGzPDlybCZUAtOAe3/CouXfA5V3NphZBkHPu5H7R.NxAo314AUtW', 1, 'UID644e579c94b95', 1, "$2y$10$lSrE1fPry.tViDMu7Ve1pum2kBtLMe3/gdeC39PWGHMOysgfWYh2i", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b96', 'Petertjeeeee', 'petertjeeee@hotmail.com', '$2y$10$Sghx.UpH1fpeMNBbYd9Nbue9ioKZ6QuVzkcpLfX2pedS09UmavN0W', 0, 'UID644e579c94b96', 1, "$2y$10$GU7Vgj6ljTE60tIzxpkgo.1dxkHpvgefGWFap/Ye.llCgGNy4EK2S", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b97', 'Marit_123', 'maritdeboer@hotmail.com', '$2y$10$tUXFyfsk/1wp2dmx00og3uoFWjsG8sY7FOu2wSGUrDNE1FATIqW6.', 0, 'UID644e579c94b97', 1, "$2y$10$JAIQDG9DP0XR1/D6iSbqo.wKXkVCz4mpY3LzwkHAt8/0.AK.eiroC", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b98', 'ChrisPeeters', 'poloooo@gmail.com', '$2y$10$Wkg3OKaATFkhIZeRXyLg7eq599HSVcaIUA7WskHoeXcxkjcNRRMN6', 0, 'UID644e579c94b98', 1, "$2y$10$xDPKxwCNY/nznOT7.gsx5eERC/xmXKgUxfAv2WgAtG6vSv1UU/xy.", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b99', 'richard21', 'richard@gmail.com', '$2y$10$vN9nq8iah1/jt0oFrtqBo.SoIoP8mooeVqqIOGBvdfziO6eMRJYLS', 0, 'UID644e579c94b99', 1, "$2y$10$ycMV6qWzRAv15NerSYD36.uRrov8Cx9nClSO46T5lMJv7dC7uEXCG", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9a', 'paulaa_89', 'chihuahua213@gmail.com', '$2y$10$4mij1qqSuR1bLm.OhKYDrO/iFRG882ijwxXAs9PSIhrVvbi7JSTbm', 1, 'UID644e579c94b9a', 1, "$2y$10$NI1PyEHICwtedW6CFFb8ROej2fDYboGsDgas51SAGRh2ZKT9mngGW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9b', 'sjaakD', 'banaantjee@gmail.com', '$2y$10$Dtjewcor/Smp7inPNYcewOTMP4x8e/E8LUzg/JakmDT5EEHOb3KlC', 1, 'UID644e579c94b9b', 1, "$2y$10$4AnNzxd8MXXsJqIyq5IxrexTUTVvZkmFD/FD3KGUiJknUS1YrposW", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94b9c', 'jessicasmit', 'jess@gmail.com', '$2y$10$SD2sAr7W12dvE1saupbKDu5fNZ/I7eg6R6yqvh9KnOtbhITTs9wUW', 0, 'UID644e579c94b9c', 1, "$2y$10$haNuEOjypCqWw.x7kTDd5OnX2qr7NItiU0Tfs3YdPAPi54q/g0YBi", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba0', 'maurice_vos', 'maurice_3213@hotmail.com', '$2y$10$dV48fzD0CYxO80ERMMbAm.RoeYXW0c8TxE5JC6rzWjbC/M/mEBC42', 0, 'UID644e579c94ba0', 1, "$2y$10$t1jPI905mc34ImEgVdKemOwDd2mN0qKGGu8zxIZKWc9nySgqqe2w6", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba1', 'michelle_1996', 'chiquitabanana@hotmail.com', '$2y$10$niMTxstvGyYBjZZQ/6hK8ei4P4FltVlt8zAT2Ts8XaZGyXoaA45mC', 0, 'UID644e579c94ba1', 1, "$2y$10$/6ogbuuLxH/wASmAEHbkGOFyPAMX.K7KQ9oc9mYCdefhw0kRgnm4W", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba2', 'connor', 'connorh@gmail.com', '$2y$10$YCHr7ZA8iHic1zdwLdd5zu1JSxG/Msa139I5QNvTwQb3Qcm09T0qG', 0, 'UID644e579c94ba2', 1, "$2y$10$oVOodTV6.UzmZzt4cHJ5SurCApL2PuLyazg4InlVg8Sfow8qnjoEC", "2023-04-24 15:41:16", "2023-04-23 11:16:21"),
  ('AID644e579c94ba3', 'falcooo1991', 'falcoo_1991@email.com', '$2y$10$I/ZQpbJ3eCgehf6D1lRNj.uus3t.rXK16QTcSoQdOXOigLTDfEZMK', 0, NULL, 1, "$2y$10$.0YmIpOMccc3GXlb/Nt.5.hnDFmz.0BrxbHBdvSzJ2Nd3HlAvPlp6", "2023-04-24 15:41:16", "2023-04-23 11:16:21");

-- Insert data into the 'userProfiles' table

INSERT INTO `userProfiles`(`userProfileID`, `firstName`, `lastName`, `city`, `country`, `phoneNumber`, `dateOfBirth`, `age`,`aboutMeTitle`,`aboutMeText`,`userProfilePicture`) VALUES
 ('UID644e5491179c5','Johan','Vink','Amsterdam','The Netherlands','+31654738829','1991-02-19','31','Over mij:','Hallo, ik ben een jonge professional die onlangs naar een nieuwe stad is verhuisd en op zoek is naar een harige vriend om me gezelschap te houden tijdens mijn dagelijkse wandelingen.','default'),
 ('UID644e5491179c8','Jan','Dijkstra','Breda','The Netherlands','+31688372293','1992-03-11','30','Over mij:','Hey daar, ik ben een gepensioneerde senior die dol is op tijd doorbrengen met mijn hond en op zoek is naar andere hondenbezitters om mee te socialiseren.','default'),
 ('UID644e5491179c9','Freek','De Jong','Eindhoven','The Netherlands','+31687653367','1988-07-21','35','Over mij:','Groetjes! Ik ben een alleenstaande ouder en zou graag een hondenbezitter in de buurt vinden om de verantwoordelijkheid voor het uitlaten te delen.','default'),
 ('UID644e5491179ca','Suzanne','Hoogland','Amstelveen','The Netherlands','+31678937784','1981-02-10','42','Over mij:','Hoi, ik ben een student die zijn gezinshond mist en graag tijd wil doorbrengen met een vriendelijke hond in mijn vrije tijd.','default'),
 ('UID644e579c94b95','Pieter','Janssen','Groningen','The Netherlands','+31688926535','1994-03-28','29','Over mij:','Hallo! Ik ben een drukke werkende ouder die zijn hond de aandacht wil geven die hij verdient en graag iemand zou vinden om te helpen met hondenoppas.','default'),
 ('UID644e579c94b96','Peter','De Groot','Utrecht','The Netherlands','+31689487763','1999-01-01','24','Over mij:','Hey, ik ben een fitnessliefhebber die graag zijn hond meeneemt op wandelingen en iemand zoekt om ons te vergezellen op onze avonturen.','default'),
 ('UID644e579c94b97','Marit','De Boer','Maastricht','The Netherlands','+31623787732','1990-07-21','33','Over mij:','Hoi daar! Ik ben een hondenliefhebber die onlangs zijn harige vriend heeft verloren en graag een andere hond zou vinden om voor te zorgen en lief te hebben.','default'),
 ('UID644e579c94b98','Chris','Peeters','Zwolle','The Netherlands','+31646893684','1971-12-30','42','Over mij:','Groetjes, ik ben een huisdiereneigenaar die thuis werkt en op zoek is naar andere hondenbezitters in de buurt om ervaringen uit te wisselen en mogelijk speelafspraakjes te maken.','default'),
 ('UID644e579c94b99','Richard','Klomp','Den Bosch','The Netherlands','+31674637728','1960-05-23','63','Over mij:','Hallo, ik ben een gepassioneerde hondenfokker die op zoek is naar andere hondenliefhebbers om mee te netwerken en informatie uit te wisselen.','default'),
 ('UID644e579c94b9a','Paula','Hendriks','Rotterdam','The Netherlands','+31689367746','1999-03-21','24','Over mij:','Hey daar, ik ben een reiziger die zijn hond graag meeneemt op avonturen en op zoek is naar anderen om mee te reizen.','default'),
 ('UID644e579c94b9b','Sjaak','Dekker','Den Haag','The Netherlands','+31678364473','1992-05-02','30','Over mij:','Hoi, ik ben een gepassioneerde hondenfotograaf die graag met andere hondenbezitters zou willen samenwerken om fotos te maken van onze viervoeters.','default'),
 ('UID644e579c94b9c','Jessica','Smit','Nijmegen','The Netherlands','+31626839946','1996-02-01','26','Over mij:','Hallo! Ik ben een hondenopvoeder die graag hondenbezitters zou willen helpen met het trainen van hun viervoeters.','default'),
 ('UID644e579c94ba0','Maurice','Vos','Almere','The Netherlands','+31682736647','1998-09-09','25','Over mij:','Hey, ik ben een natuurliefhebber die zijn hond graag meeneemt op wandelingen in de natuur en op zoek is naar anderen om mee te gaan.','default'),
 ('UID644e579c94ba1','Michelle','Van Meer','Tilburg','The Netherlands','+31672635544','2001-07-10','22','Over mij:','Hoi, ik ben een hondenliefhebber die graag nieuwe mensen ontmoet en andere honden en hun eigenaren wil leren kennen.','default'),
 ('UID644e579c94ba2','Connor','Haas','Delft','The Netherlands','+31616782266','1997-04-16','25','Over mij:','Hallo, ik ben een hondenredder die graag andere hondenbezitters zou willen helpen bij het redden en verzorgen van verlaten of mishandelde honden.','default');

-- Insert data into the 'likes' table

/* Disabling default inserts into likes table testing like functionality

INSERT INTO `likes` (`liker`, `liked`) VALUES
  ('UID644e579c94b98', 'UID644e579c94ba1'),
  ('UID644e579c94b98', 'UID644e579c94b99'),
  ('UID644e579c94b98', 'UID644e579c94b95'),
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
  ('UID644e579c94ba1', 'UID644e579c94b98'),
  ('UID644e579c94ba1', 'UID644e579c94b99'),
  ('UID644e579c94ba1', 'UID644e5491179ca'),
  ('UID644e579c94ba1', 'UID644e579c94b96'),
  ('UID644e579c94b9a', 'UID644e579c94ba2'),
  ('UID644e579c94b9a', 'UID644e579c94b96'),
  ('UID644e579c94b9a', 'UID644e579c94b99'),
  ('UID644e579c94b96', 'UID644e579c94b98'),
  ('UID644e579c94b96', 'UID644e579c94ba0'),
  ('UID644e579c94b96', 'UID644e579c94b9b'),
  ('UID644e579c94b95', 'UID644e579c94b9c'),
  ('UID644e579c94b95', 'UID644e579c94ba1'),
  ('UID644e579c94b99', 'UID644e579c94b98'),
  ('UID644e579c94b99', 'UID644e579c94b9c'),
  ('UID644e579c94b99', 'UID644e579c94ba2'),
  ('UID644e579c94b9b', 'UID644e5491179ca'),
  ('UID644e579c94b9b', 'UID644e579c94b9c'),
  ('UID644e579c94b9b', 'UID644e579c94ba1'),
  ('UID644e5491179ca', 'UID644e579c94b9b'),
  ('UID644e5491179ca', 'UID644e579c94b9c');

  */

-- Insert data into the 'matches' table

/* Disabling default inserts into matches testing matching functionality

INSERT INTO `matches` (`userProfileID_A`, `userProfileID_B`) VALUES
('UID644e579c94ba2', 'UID644e579c94b9a'),
('UID644e579c94ba1', 'UID644e579c94b98'),
('UID644e579c94ba0', 'UID644e579c94b96'),
('UID644e579c94b9c', 'UID644e5491179ca'),
('UID644e579c94b9b', 'UID644e5491179ca'),
('UID644e579c94b9a', 'UID644e579c94ba2'),
('UID644e579c94b99', 'UID644e579c94b98'),
('UID644e579c94b98', 'UID644e579c94ba1'),
('UID644e579c94b98', 'UID644e579c94b99'),
('UID644e579c94b96', 'UID644e579c94ba0'),
('UID644e5491179ca', 'UID644e579c94b9b'),
('UID644e5491179ca', 'UID644e579c94b9c');
*/

-- Insert data into the 'permissions' table
 
INSERT INTO `permissions` (`permissionID`, `permissionName`, `permissionDescription`) VALUES
  ('01', 'CreateAccount', 'De permissie om een account te kunnen creëren.'),
  ('02', 'DeleteAccount', 'De permissie om een account te kunnen verwijderen.'),
  ('03', 'DisableEnableAccount', 'De permissie om een account te kunnen aanzetten of uitzetten.'),
  ('04', 'ChangePassword', 'De permissie om het wachtwoord van een account te kunnen wijzigen.'),
  ('05', 'ForceLogout', 'De permissie om een account geforceerd uit te kunnen loggen.'),
  ('06', 'CreatePermission', 'De permissie om een permissie te kunnen creëren.'),
  ('07', 'CreateRole', 'De permissie om een rol te kunnen creëren'),
  ('08', 'GivePermission', 'De permissie om een permissie toe te kunnen wijzen.'),
  ('09', 'GiveRole', 'De permissie om een rol toe te kunnen wijzen.'),
  ('10', 'EditProfile', 'De permissie om een profiel te kunnen wijzigen.'),
  ('11', 'ResetPassword', 'De permissie om het wachtwoord van een account te kunnen wijzigen.');

-- Insert data into the 'roles' table

INSERT INTO `roles`(`roleID`, `roleName`, `roleDescription`) VALUES
  ('01','User','Basis gebruikers account'),
  ('02','Moderator','Basis moderator account'),
  ('03','Admin','Basis admin account');

 -- Insert data into the 'rolesPermissions' table

 INSERT INTO `rolesPermissions`(`roleID`, `permissionID`) VALUES
  ('01','10'),
  ('01','11'),
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
  ('03','11');

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
-- SET GLOBAL FOREIGN_KEY_CHECKS=1;
