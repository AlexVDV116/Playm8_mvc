--
-- Data Manipulations Lanuage voor database `Playm8`
--

INSERT INTO `accounts` (`accountID`, `username`, `email`, `password`, `isEnabled`, `isBetaUser`, `userProfileID`) VALUES
(1, 'Admin', 'admin@email.com', '$2y$10$P6zQFs2FIgopK1QImllqWeINrzHfxzulGeFR.DaTJzlFQi.JNbXki', 1, 1, 0),
(2, 'AlexVDV116', 'alexemail@hotmail.com', '$2y$10$/ishZ2nbQxODPAE.r8s5Y.sGErC2wn.02QRPExN2Gila4nN3ypCEu', 1, 1, 0),
(49, 'Piet', 'piet@email.com', '$2y$10$dsXB90MqB3rCYVPmGm8i9eklqvR2t.X.qOeGOuqj7CVgwFawHkcJq', 1, 0, 0),
(50, 'Christina', 'christina@email.com', '$2y$10$G4YDSl0e43ziR5NkKXlWVeOiOLJoaNXF.MEmoukDm1bbfMz0oqh/G', 1, 0, NULL),
(51, 'Frank', 'frankie@email.com', '$2y$10$shhj8UumMUsw6jdd5.G19.6KE5kmKVOT/WUvzKM4qOqqP84UNS8xi', 1, 0, NULL);
