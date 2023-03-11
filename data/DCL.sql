--
-- Data Control Lanuage voor database `Playm8`
--

GRANT SELECT ON `playm8`.* TO `user_read`@`%`;

GRANT SELECT, INSERT, UPDATE ON `playm8`.* TO `user_write`@`%`;

GRANT CREATE, DROP, INDEX, ALTER, CREATE TEMPORARY TABLES, EXECUTE, CREATE VIEW, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EVENT, TRIGGER ON `playm8`.* TO `admin_ddl`@`%`;

GRANT REFERENCES, LOCK TABLES ON `playm8`.* TO `admin_dcl`@`%` WITH GRANT OPTION;
